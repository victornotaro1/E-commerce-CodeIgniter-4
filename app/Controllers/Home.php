<?php

namespace App\Controllers;

use App\Models\ProdutoModel;
use App\Models\VendaModel;

class Home extends BaseController
{
    public function index(): string
    {
        $produtoModel = new ProdutoModel();
        $vendaModel   = new VendaModel();

        $totalProdutos = $produtoModel->countAllResults();
        $totalVendas   = $vendaModel->countAllResults();
        $faturamento   = (float) ($vendaModel->selectSum('total')->first()['total'] ?? 0);

        $ultimasVendas = $vendaModel->orderBy('created_at', 'DESC')->findAll(5);

        return view('home', [
            'title'         => 'Painel',
            'totalProdutos' => $totalProdutos,
            'totalVendas'   => $totalVendas,
            'faturamento'   => $faturamento,
            'ultimasVendas' => $ultimasVendas,
        ]);
    }
}
