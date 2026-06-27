<?php

namespace App\Controllers;

use App\Models\ProdutoModel;
use App\Models\VendaModel;
use App\Models\VendaItemModel;

class Loja extends BaseController
{
    protected ProdutoModel $produtos;

    public function __construct()
    {
        $this->produtos = new ProdutoModel();
    }

    // Landing page + catálogo
    public function index(): string
    {
        return view('loja/index', [
            'title'    => 'Início',
            'produtos' => $this->produtos->orderBy('id', 'ASC')->findAll(),
        ]);
    }

    // Página de detalhes do produto
    public function produto(int $id): string
    {
        $produto = $this->produtos->find($id);

        if (! $produto) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $relacionados = $this->produtos
            ->where('id !=', $id)
            ->orderBy('RAND()')
            ->findAll(3);

        return view('loja/produto', [
            'title'        => $produto['nome'],
            'produto'      => $produto,
            'relacionados' => $relacionados,
        ]);
    }

    // Adiciona item ao carrinho (sessão)
    public function adicionar()
    {
        $id  = (int) $this->request->getPost('produto_id');
        $qtd = max(1, (int) $this->request->getPost('quantidade'));

        $produto = $this->produtos->find($id);
        if (! $produto) {
            return redirect()->to('/')->with('erro', 'Produto não encontrado.');
        }

        $carrinho = session('carrinho') ?? [];
        $atual    = $carrinho[$id]['quantidade'] ?? 0;
        $novaQtd  = $atual + $qtd;

        if ($novaQtd > (int) $produto['estoque']) {
            return redirect()->back()->with('erro', "Estoque insuficiente para \"{$produto['nome']}\". Disponível: {$produto['estoque']}.");
        }

        $carrinho[$id] = [
            'id'         => (int) $produto['id'],
            'nome'       => $produto['nome'],
            'preco'      => (float) $produto['preco'],
            'imagem'     => $produto['imagem'],
            'quantidade' => $novaQtd,
        ];

        session()->set('carrinho', $carrinho);

        return redirect()->to('carrinho')->with('sucesso', 'Produto adicionado ao carrinho.');
    }

    // Atualiza quantidades do carrinho
    public function atualizarCarrinho()
    {
        $quantidades = (array) $this->request->getPost('quantidade');
        $carrinho    = session('carrinho') ?? [];

        foreach ($quantidades as $id => $qtd) {
            $id  = (int) $id;
            $qtd = (int) $qtd;

            if (! isset($carrinho[$id])) {
                continue;
            }

            if ($qtd <= 0) {
                unset($carrinho[$id]);
                continue;
            }

            $produto = $this->produtos->find($id);
            if ($produto) {
                $carrinho[$id]['quantidade'] = min($qtd, (int) $produto['estoque']);
            }
        }

        session()->set('carrinho', $carrinho);

        return redirect()->to('carrinho')->with('sucesso', 'Carrinho atualizado.');
    }

    // Remove item do carrinho
    public function remover(int $id)
    {
        $carrinho = session('carrinho') ?? [];
        unset($carrinho[$id]);
        session()->set('carrinho', $carrinho);

        return redirect()->to('carrinho')->with('sucesso', 'Item removido do carrinho.');
    }

    public function carrinho(): string
    {
        $carrinho = session('carrinho') ?? [];
        $total    = 0;
        foreach ($carrinho as $item) {
            $total += $item['preco'] * $item['quantidade'];
        }

        return view('loja/carrinho', [
            'title'    => 'Carrinho',
            'carrinho' => $carrinho,
            'total'    => $total,
        ]);
    }

    public function checkout()
    {
        $carrinho = session('carrinho') ?? [];

        if (empty($carrinho)) {
            return redirect()->to('carrinho')->with('erro', 'Seu carrinho está vazio.');
        }

        $total = 0;
        foreach ($carrinho as $item) {
            $total += $item['preco'] * $item['quantidade'];
        }

        return view('loja/checkout', [
            'title'    => 'Finalizar Compra',
            'carrinho' => $carrinho,
            'total'    => $total,
        ]);
    }

    // Finaliza a compra: registra a venda e baixa o estoque
    public function finalizar()
    {
        $cliente  = trim((string) $this->request->getPost('cliente'));
        $carrinho = session('carrinho') ?? [];

        if ($cliente === '') {
            return redirect()->back()->withInput()->with('erro', 'Informe seu nome para concluir a compra.');
        }

        if (empty($carrinho)) {
            return redirect()->to('carrinho')->with('erro', 'Seu carrinho está vazio.');
        }

        // Revalida estoque e calcula total
        $itensVenda = [];
        $total      = 0;

        foreach ($carrinho as $item) {
            $produto = $this->produtos->find($item['id']);
            if (! $produto) {
                continue;
            }

            $qtd = (int) $item['quantidade'];
            if ($qtd > (int) $produto['estoque']) {
                return redirect()->to('carrinho')->with(
                    'erro',
                    "Estoque insuficiente para \"{$produto['nome']}\". Disponível: {$produto['estoque']}."
                );
            }

            $subtotal = $qtd * (float) $produto['preco'];
            $total   += $subtotal;

            $itensVenda[] = [
                'produto'  => $produto,
                'qtd'      => $qtd,
                'subtotal' => $subtotal,
            ];
        }

        if (empty($itensVenda)) {
            return redirect()->to('carrinho')->with('erro', 'Não há itens válidos no carrinho.');
        }

        $vendaModel = new VendaModel();
        $itemModel  = new VendaItemModel();

        $db = \Config\Database::connect();
        $db->transStart();

        $vendaId = $vendaModel->insert([
            'cliente' => $cliente,
            'total'   => $total,
        ], true);

        foreach ($itensVenda as $item) {
            $itemModel->insert([
                'venda_id'       => $vendaId,
                'produto_id'     => $item['produto']['id'],
                'produto_nome'   => $item['produto']['nome'],
                'quantidade'     => $item['qtd'],
                'preco_unitario' => $item['produto']['preco'],
                'subtotal'       => $item['subtotal'],
            ]);

            $this->produtos->update($item['produto']['id'], [
                'estoque' => (int) $item['produto']['estoque'] - $item['qtd'],
            ]);
        }

        $db->transComplete();

        if ($db->transStatus() === false) {
            return redirect()->to('carrinho')->with('erro', 'Não foi possível concluir a compra. Tente novamente.');
        }

        session()->remove('carrinho');

        return redirect()->to('pedido-confirmado/' . $vendaId);
    }

    public function confirmado(int $id): string
    {
        $vendaModel = new VendaModel();
        $itemModel  = new VendaItemModel();

        $venda = $vendaModel->find($id);
        if (! $venda) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('loja/confirmacao', [
            'title' => 'Pedido Confirmado',
            'venda' => $venda,
            'itens' => $itemModel->where('venda_id', $id)->findAll(),
        ]);
    }
}
