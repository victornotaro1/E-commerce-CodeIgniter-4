<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

// ===== Vitrine (visão do comprador) =====
$routes->get('/', 'Loja::index');
$routes->get('produto/(:num)', 'Loja::produto/$1');
$routes->post('carrinho/adicionar', 'Loja::adicionar');
$routes->post('carrinho/atualizar', 'Loja::atualizarCarrinho');
$routes->get('carrinho/remover/(:num)', 'Loja::remover/$1');
$routes->get('carrinho', 'Loja::carrinho');
$routes->get('checkout', 'Loja::checkout');
$routes->post('checkout/finalizar', 'Loja::finalizar');
$routes->get('pedido-confirmado/(:num)', 'Loja::confirmado/$1');

// ===== Painel administrativo =====
$routes->get('admin', 'Home::index');

// Produtos (admin)
$routes->group('produtos', static function ($routes) {
    $routes->get('/', 'Produtos::index');
    $routes->get('novo', 'Produtos::novo');
    $routes->post('salvar', 'Produtos::salvar');
    $routes->get('editar/(:num)', 'Produtos::editar/$1');
    $routes->post('atualizar/(:num)', 'Produtos::atualizar/$1');
    $routes->get('excluir/(:num)', 'Produtos::excluir/$1');
});

// Vendas (admin)
$routes->group('vendas', static function ($routes) {
    $routes->get('/', 'Vendas::index');
    $routes->get('nova', 'Vendas::nova');
    $routes->post('registrar', 'Vendas::registrar');
    $routes->get('detalhes/(:num)', 'Vendas::detalhes/$1');
});
