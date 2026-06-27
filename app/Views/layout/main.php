<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Loja') ?> — Minha Loja</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
</head>
<body>
    <header class="topbar">
        <div class="container topbar-inner">
            <a href="<?= base_url('admin') ?>" class="brand">
                <span class="brand-mark">◆</span> Minha Loja <span class="brand-tag">Admin</span>
            </a>
            <nav class="nav">
                <a href="<?= base_url('admin') ?>" class="nav-link <?= (service('uri')->getSegment(1) === 'admin') ? 'active' : '' ?>">Painel</a>
                <a href="<?= base_url('produtos') ?>" class="nav-link <?= (service('uri')->getSegment(1) === 'produtos') ? 'active' : '' ?>">Produtos</a>
                <a href="<?= base_url('vendas/nova') ?>" class="nav-link">Nova Venda</a>
                <a href="<?= base_url('vendas') ?>" class="nav-link <?= (service('uri')->getSegment(1) === 'vendas' && service('uri')->getSegment(2) !== 'nova') ? 'active' : '' ?>">Compras</a>
                <a href="<?= base_url('/') ?>" class="nav-link nav-loja">Ver loja →</a>
            </nav>
        </div>
    </header>

    <main class="container main">
        <?php if (session()->getFlashdata('sucesso')): ?>
            <div class="alert alert-sucesso"><?= esc(session()->getFlashdata('sucesso')) ?></div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('erro')): ?>
            <div class="alert alert-erro"><?= esc(session()->getFlashdata('erro')) ?></div>
        <?php endif; ?>

        <?= $this->renderSection('conteudo') ?>
    </main>

    <!-- <footer class="footer">
        <div class="container">
            
        </div>
    </footer> -->

    <?= $this->renderSection('scripts') ?>
</body>
</html>
