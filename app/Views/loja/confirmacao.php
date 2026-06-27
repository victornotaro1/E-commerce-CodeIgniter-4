<?= $this->extend('layout/loja') ?>

<?= $this->section('conteudo') ?>

<div class="container pagina-estreita">
    <div class="confirmacao">
        <div class="confirmacao-icone">✓</div>
        <h1 class="confirmacao-titulo">Pedido confirmado!</h1>
        <p class="confirmacao-texto">Obrigado pela sua compra, <strong><?= esc($venda['cliente']) ?></strong>. Seu pedido <strong>#<?= $venda['id'] ?></strong> foi registrado com sucesso.</p>

        <div class="confirmacao-card">
            <h2 class="box-titulo">Itens do pedido</h2>
            <ul class="resumo-itens">
                <?php foreach ($itens as $item): ?>
                    <li>
                        <span class="resumo-qtd"><?= $item['quantidade'] ?>×</span>
                        <span class="resumo-nome"><?= esc($item['produto_nome']) ?></span>
                        <span class="resumo-valor">R$ <?= number_format((float) $item['subtotal'], 2, ',', '.') ?></span>
                    </li>
                <?php endforeach; ?>
            </ul>
            <div class="resumo-total">
                <span>Total pago</span>
                <strong>R$ <?= number_format((float) $venda['total'], 2, ',', '.') ?></strong>
            </div>
        </div>

        <a href="<?= base_url('/') ?>" class="btn btn-primary btn-lg">Voltar à loja</a>
    </div>
</div>

<?= $this->endSection() ?>
