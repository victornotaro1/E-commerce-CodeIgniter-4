<?php

namespace App\Controllers;

use App\Models\ProdutoModel;
use App\Models\VendaModel;
use App\Models\VendaItemModel;

class Vendas extends BaseController
{
    protected VendaModel $vendas;
    protected VendaItemModel $itens;
    protected ProdutoModel $produtos;

    public function __construct()
    {
        $this->vendas   = new VendaModel();
        $this->itens    = new VendaItemModel();
        $this->produtos = new ProdutoModel();
    }

    // Consulta de compras realizadas
    public function index(): string
    {
        return view('vendas/index', [
            'title'  => 'Compras Realizadas',
            'vendas' => $this->vendas->orderBy('created_at', 'DESC')->findAll(),
        ]);
    }

    public function nova(): string
    {
        return view('vendas/form', [
            'title'    => 'Registrar Venda',
            'produtos' => $this->produtos->where('estoque >', 0)->orderBy('nome', 'ASC')->findAll(),
        ]);
    }

    public function registrar()
    {
        $cliente     = trim((string) $this->request->getPost('cliente'));
        $produtoIds  = (array) $this->request->getPost('produto_id');
        $quantidades = (array) $this->request->getPost('quantidade');

        if ($cliente === '') {
            return redirect()->back()->withInput()->with('erro', 'Informe o nome do cliente.');
        }

        // Monta itens válidos
        $itensVenda = [];
        $total      = 0;

        foreach ($produtoIds as $i => $pid) {
            $pid = (int) $pid;
            $qtd = (int) ($quantidades[$i] ?? 0);

            if ($pid <= 0 || $qtd <= 0) {
                continue;
            }

            $produto = $this->produtos->find($pid);
            if (! $produto) {
                continue;
            }

            if ($qtd > (int) $produto['estoque']) {
                return redirect()->back()->withInput()->with(
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
            return redirect()->back()->withInput()->with('erro', 'Adicione ao menos um produto à venda.');
        }

        $db = \Config\Database::connect();
        $db->transStart();

        $vendaId = $this->vendas->insert([
            'cliente' => $cliente,
            'total'   => $total,
        ], true);

        foreach ($itensVenda as $item) {
            $this->itens->insert([
                'venda_id'       => $vendaId,
                'produto_id'     => $item['produto']['id'],
                'produto_nome'   => $item['produto']['nome'],
                'quantidade'     => $item['qtd'],
                'preco_unitario' => $item['produto']['preco'],
                'subtotal'       => $item['subtotal'],
            ]);

            // Baixa de estoque
            $this->produtos->update($item['produto']['id'], [
                'estoque' => (int) $item['produto']['estoque'] - $item['qtd'],
            ]);
        }

        $db->transComplete();

        if ($db->transStatus() === false) {
            return redirect()->back()->withInput()->with('erro', 'Não foi possível registrar a venda. Tente novamente.');
        }

        return redirect()->to('vendas')->with('sucesso', 'Venda registrada com sucesso.');
    }

    public function detalhes(int $id): string
    {
        $venda = $this->vendas->find($id);

        if (! $venda) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('vendas/detalhes', [
            'title' => 'Detalhes da Venda',
            'venda' => $venda,
            'itens' => $this->itens->where('venda_id', $id)->findAll(),
        ]);
    }
}
