<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Loja') ?> — Minha Loja</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="description" content="Vitrine de produtos selecionados com entrega rápida e compra segura.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
</head>
<body class="loja-body">
    <?php $qtdCarrinho = array_sum(array_column(session('carrinho') ?? [], 'quantidade')); ?>
    <header class="loja-topbar">
        <div class="container loja-topbar-inner">
            <a href="<?= base_url('/') ?>" class="brand">
                <span class="brand-mark"></span> VitekShop
            </a>
            <nav class="loja-nav">
               
                <a href="<?= base_url('carrinho') ?>" class="nav-cart">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart-fill" viewBox="0 0 16 16">
                <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                </svg>
                    
                    <?php if ($qtdCarrinho > 0): ?>
                        <span class="cart-badge"><?= $qtdCarrinho ?></span>
                    <?php endif; ?>
                </a>
                
            </nav>
        </div>
    </header>

    <main>
        <div class="container">
            <?php if (session()->getFlashdata('sucesso')): ?>
                <div class="alert alert-sucesso"><?= esc(session()->getFlashdata('sucesso')) ?></div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('erro')): ?>
                <div class="alert alert-erro"><?= esc(session()->getFlashdata('erro')) ?></div>
            <?php endif; ?>
        </div>

        <?= $this->renderSection('conteudo') ?>
    </main>

   <footer class="bg-dark text-white mt-5 py-5">
    <div class="container">
        <div class="row">

            <div class="col-md-4 mb-4">
                <h5>VitekShop</h5>
                <p>
                    Moda com qualidade, estilo e os melhores preços para você.
                </p>
            </div>

            <div class="col-md-4 mb-4">
                <h5>Links</h5>
                <ul class="list-unstyled">
                    <li><a href="<?= base_url() ?>" class="text-white text-decoration-none">Início</a></li>
                    <li><a href="#catalogo" class="text-white text-decoration-none">Produtos</a></li>
                    <li><a href="<?= base_url('carrinho') ?>" class="text-white text-decoration-none">Carrinho</a></li>
                </ul>
            </div>

            <div class="col-md-4 mb-4">
                <h5>Contato</h5>
                <p>Email: contato@VitekShop.com</p>
                <p>Telefone: (14) 99999-9999</p>
            </div>

        </div>

        <hr class="border-secondary">

        <div class="text-center">
            &copy; <?= date('Y') ?> VitekShop - Todos os direitos reservados.
        </div>
    </div>
</footer>

    <?= $this->renderSection('scripts') ?>
</body>
</html>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>