<?= $this->extend('layout/loja') ?>

<?= $this->section('conteudo') ?>

<div class="container">
    <nav class="breadcrumb">
        <a href="<?= base_url('/') ?>">Produtos</a>
        <span>/</span>
        <span><?= esc($produto['nome']) ?></span>
    </nav>

    <?php $esgotado = (int) $produto['estoque'] <= 0; ?>
    <section class="produto-detalhe">
        <div class="produto-detalhe-img">
            <?php if (! empty($produto['imagem'])): ?>
                <img src="<?= $produto['imagem'] ?>" alt="<?= esc($produto['nome']) ?>">
            <?php else: ?>
                <span class="img-fallback grande"><?= esc(strtoupper(mb_substr($produto['nome'], 0, 1))) ?></span>
            <?php endif; ?>
        </div>

        <div class="produto-detalhe-info">
            <h1 class="produto-detalhe-nome text-balance"><?= esc($produto['nome']) ?></h1>
            <p class="produto-detalhe-preco">R$ <?= number_format((float) $produto['preco'], 2, ',', '.') ?></p>
            <p class="produto-detalhe-desc text-pretty"><?= esc($produto['descricao']) ?></p>

            <p class="produto-detalhe-estoque">
                <?php if ($esgotado): ?>
                    <span class="dot dot-esgotado"></span> Esgotado
                <?php else: ?>
                    <span class="dot dot-ok"></span> <?= (int) $produto['estoque'] ?> em estoque
                <?php endif; ?>
            </p>

            <?php if (! $esgotado): ?>
                <form action="<?= base_url('carrinho/adicionar') ?>" method="post" class="produto-detalhe-form">
                    <?= csrf_field() ?>
                    <input type="hidden" name="produto_id" value="<?= $produto['id'] ?>">
                    <div class="qtd-control">
                        <label for="quantidade">Quantidade</label>
                        <input type="number" id="quantidade" name="quantidade" value="1" min="1" max="<?= (int) $produto['estoque'] ?>">
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg">Adicionar ao carrinho</button>
                </form>
            <?php else: ?>
                <button class="btn btn-ghost btn-lg" disabled>Produto indisponível</button>
            <?php endif; ?>
        </div>
    </section>

    <?php if (! empty($relacionados)): ?>
        <section class="relacionados">
            <h2 class="section-title">Você também pode gostar</h2>
            <div class="produtos-grid">
                <?php foreach ($relacionados as $p): ?>
                    <article class="produto-card">
                        <a href="<?= base_url('produto/' . $p['id']) ?>" class="produto-card-img">
                            <?php if (! empty($p['imagem'])): ?>
                                <img src="<?=($p['imagem']) ?>" alt="<?= esc($p['nome']) ?>" loading="lazy">
                            <?php else: ?>
                                <span class="img-fallback"><?= esc(strtoupper(mb_substr($p['nome'], 0, 1))) ?></span>
                            <?php endif; ?>
                        </a>
                        <div class="produto-card-body">
                            <h3 class="produto-card-nome">
                                <a href="<?= base_url('produto/' . $p['id']) ?>"><?= esc($p['nome']) ?></a>
                            </h3>
                            <div class="produto-card-footer">
                                <span class="preco">R$ <?= number_format((float) $p['preco'], 2, ',', '.') ?></span>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </section>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>
