<?php

namespace App\Controllers;

use App\Models\ProdutoModel;

class Produtos extends BaseController
{
    protected ProdutoModel $produtos;

    public function __construct()
    {
        $this->produtos = new ProdutoModel();
    }

    public function index(): string
    {
        return view('produtos/index', [
            'title'    => 'Produtos',
            'produtos' => $this->produtos->orderBy('nome', 'ASC')->findAll(),
        ]);
    }

    public function novo(): string
    {
        return view('produtos/form', [
            'title'   => 'Novo Produto',
            'produto' => null,
        ]);
    }

    public function salvar()
    {
        $dados = $this->request->getPost(['nome', 'imagem', 'descricao', 'preco', 'estoque']);

        if (! $this->produtos->save($dados)) {
            return redirect()->back()->withInput()->with('errors', $this->produtos->errors());
        }

        return redirect()->to('produtos')->with('sucesso', 'Produto cadastrado com sucesso.');
    }

    public function editar(int $id): string
    {
        $produto = $this->produtos->find($id);

        if (! $produto) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('produtos/form', [
            'title'   => 'Editar Produto',
            'produto' => $produto,
        ]);
    }

    public function atualizar(int $id)
    {
        if (! $this->produtos->find($id)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $dados = $this->request->getPost(['nome', 'descricao', 'preco', 'estoque']);

        if (! $this->produtos->update($id, $dados)) {
            return redirect()->back()->withInput()->with('errors', $this->produtos->errors());
        }

        return redirect()->to('produtos')->with('sucesso', 'Produto atualizado com sucesso.');
    }

    public function excluir(int $id)
    {
        if (! $this->produtos->find($id)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $this->produtos->delete($id);

        return redirect()->to('produtos')->with('sucesso', 'Produto excluído com sucesso.');
    }
}
