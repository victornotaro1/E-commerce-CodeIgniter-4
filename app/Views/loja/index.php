<?= $this->extend('layout/loja') ?>

<?= $this->section('conteudo') ?>

<section class="hero">
    <div class="container hero-inner">
        <div class="hero-content">
            <span class="hero-eyebrow">Coleção essencial</span>
            <h1 class="hero-title text-balance">Produtos selecionados para o seu dia a dia</h1>
            <p class="hero-text text-pretty">Qualidade, preço justo e entrega rápida. Descubra peças que combinam com a sua rotina.</p>
            <a href="#catalogo" class="btn btn-primary btn-lg">Ver produtos</a>
        </div>
        <div class="hero-image">
            <img src="<?= base_url('assets/loja/hero.png') ?>" alt="Seleção de produtos da loja">
        </div>
    </div>
</section>

<section id="catalogo" class="catalogo">
    <div class="container">
        <div class="section-head">
            <h2 class="section-title">Nossos produtos</h2>
            <p class="section-sub"><?= count($produtos) ?> itens disponíveis</p>
        </div>

        <?php if (empty($produtos)): ?>
            <p class="vazio">Nenhum produto cadastrado ainda.</p>
        <?php else: ?>
            <div class="produtos-grid">
                <?php foreach ($produtos as $p): ?>
                    <?php $esgotado = (int) $p['estoque'] <= 0; ?>
                    <article class="produto-card">
                        <a href="<?= base_url('produto/' . $p['id']) ?>" class="produto-card-img">
                            
                            <?php if (! empty($p['imagem'])): ?>
                                <img src="<?= $p['imagem'] ?>" alt="<?= esc($p['nome']) ?>" loading="lazy">
                            <?php else: ?>
                                <span class="img-fallback"><?= esc(strtoupper(mb_substr($p['nome'], 0, 1))) ?></span>
                            <?php endif; ?>
                            <?php if ($esgotado): ?>
                                <span class="tag tag-esgotado">Esgotado</span>
                            <?php elseif ((int) $p['estoque'] <= 5): ?>
                                <span class="tag tag-baixo">Últimas unidades</span>
                            <?php endif; ?>
                        </a>
                        <div class="produto-card-body">
                            <h3 class="produto-card-nome">
                                <a href="<?= base_url('produto/' . $p['id']) ?>"><?= esc($p['nome']) ?></a>
                            </h3>
                            <p class="produto-card-desc"><?= esc(character_limiter($p['descricao'] ?? '', 60)) ?></p>
                            <div class="produto-card-footer">
                                <span class="preco">R$ <?= number_format((float) $p['preco'], 2, ',', '.') ?></span>
                                <?php if ($esgotado): ?>
                                    <button class="btn btn-ghost" disabled>Indisponível</button>
                                <?php else: ?>
                                    <form action="<?= base_url('carrinho/adicionar') ?>" method="post">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="produto_id" value="<?= $p['id'] ?>">
                                        <input type="hidden" name="quantidade" value="1">
                                        <button type="submit" class="btn btn-primary">Adicionar</button>
                                    </form>
                                <?php endif; ?>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<?= $this->endSection() ?>
