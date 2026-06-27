<?= $this->extend('layout/loja') ?>

<?= $this->section('conteudo') ?>

<div class="container pagina-estreita">
    <h1 class="section-title">Seu carrinho</h1>

    <?php if (empty($carrinho)): ?>
        <div class="carrinho-vazio">
            <p>Seu carrinho está vazio.</p>
            <a href="<?= base_url('/') ?>" class="btn btn-primary">Continuar comprando</a>
        </div>
    <?php else: ?>
        <form action="<?= base_url('carrinho/atualizar') ?>" method="post">
            <?= csrf_field() ?>
            <div class="carrinho-lista">
                <?php foreach ($carrinho as $item): ?>
                    <div class="carrinho-item">
                        <div class="carrinho-item-img">
                            <?php if (! empty($item['imagem'])): ?>
                                <img src="<?=($item['imagem']) ?>" alt="<?= esc($item['nome']) ?>">
                            <?php else: ?>
                                <span class="img-fallback"><?= esc(strtoupper(mb_substr($item['nome'], 0, 1))) ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="carrinho-item-info">
                            <a href="<?= base_url('produto/' . $item['id']) ?>" class="carrinho-item-nome"><?= esc($item['nome']) ?></a>
                            <span class="carrinho-item-preco">R$ <?= number_format($item['preco'], 2, ',', '.') ?> un.</span>
                        </div>
                        <div class="carrinho-item-qtd">
                            <input type="number" name="quantidade[<?= $item['id'] ?>]" value="<?= $item['quantidade'] ?>" min="0">
                        </div>
                        <div class="carrinho-item-subtotal">
                            R$ <?= number_format($item['preco'] * $item['quantidade'], 2, ',', '.') ?>
                        </div>
                        <a href="<?= base_url('carrinho/remover/' . $item['id']) ?>" class="carrinho-item-remover" title="Remover">&times;</a>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="carrinho-rodape">
                <button type="submit" class="btn btn-ghost">Atualizar carrinho</button>
                <div class="carrinho-total">
                    <span>Total</span>
                    <strong>R$ <?= number_format($total, 2, ',', '.') ?></strong>
                </div>
            </div>
        </form>

        <div class="carrinho-acoes">
            <a href="<?= base_url('/') ?>" class="btn btn-ghost">Continuar comprando</a>
            <a href="<?= base_url('checkout') ?>" class="btn btn-primary btn-lg">Finalizar compra</a>
        </div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>
