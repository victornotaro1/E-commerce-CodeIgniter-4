<?= $this->extend('layout/loja') ?>

<?= $this->section('conteudo') ?>

<div class="container pagina-estreita">
    <h1 class="section-title">Finalizar compra</h1>

    <div class="checkout-grid">
        <div class="checkout-form-box">
            <h2 class="box-titulo">Seus dados</h2>
            <form action="<?= base_url('checkout/finalizar') ?>" method="post">
                <?= csrf_field() ?>
                <div class="form-grupo">
                    <label for="cliente">Nome completo</label>
                    <input type="text" id="cliente" name="cliente" value="<?= esc(old('cliente')) ?>" placeholder="Ex.: Maria Silva" required>
                </div>
                <button type="submit" class="btn btn-primary btn-lg btn-bloco">Concluir pedido</button>
                <a href="<?= base_url('carrinho') ?>" class="link-voltar">← Voltar ao carrinho</a>
            </form>
        </div>

        <aside class="checkout-resumo">
            <h2 class="box-titulo">Resumo do pedido</h2>
            <ul class="resumo-itens">
                <?php foreach ($carrinho as $item): ?>
                    <li>
                        <span class="resumo-qtd"><?= $item['quantidade'] ?>×</span>
                        <span class="resumo-nome"><?= esc($item['nome']) ?></span>
                        <span class="resumo-valor">R$ <?= number_format($item['preco'] * $item['quantidade'], 2, ',', '.') ?></span>
                    </li>
                <?php endforeach; ?>
            </ul>
            <div class="resumo-total">
                <span>Total</span>
                <strong>R$ <?= number_format($total, 2, ',', '.') ?></strong>
            </div>
        </aside>
    </div>
</div>

<?= $this->endSection() ?>
