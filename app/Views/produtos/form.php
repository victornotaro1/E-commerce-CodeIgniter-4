<?= $this->extend('layout/main') ?>

<?= $this->section('conteudo') ?>

<?php
    $editando = $produto !== null;
    $action   = $editando ? base_url('produtos/atualizar/' . $produto['id']) : base_url('produtos/salvar');
?>

<div class="page-head">
    <div>
        <h1><?= $editando ? 'Editar Produto' : 'Novo Produto' ?></h1>
        <p>Preencha os dados do produto</p>
    </div>
    <a href="<?= base_url('produtos') ?>" class="btn btn-outline">← Voltar</a>
</div>

<?php if (session()->getFlashdata('errors')): ?>
    <div class="errors">
        <strong>Corrija os seguintes erros:</strong>
        <ul>
            <?php foreach (session()->getFlashdata('errors') as $erro): ?>
                <li><?= esc($erro) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<div class="card card-pad">
    <form method="post" action="<?= $action ?>" class="form-grid">
        <?= csrf_field() ?>

        <div class="field">
            <label for="nome">Nome *</label>
            <input type="text" id="nome" name="nome" value="<?= esc(old('nome', $produto['nome'] ?? '')) ?>" required>
        </div>

        <div class="field">
            <label for="imagem">Imagem *</label>
            <input type="text" id="imagem" name="imagem" value="<?= esc(old('imagem', $produto['imagem'] ?? '')) ?>" required>
        </div>

        <div class="field">
            <label for="descricao">Descrição</label>
            <textarea id="descricao" name="descricao"><?= esc(old('descricao', $produto['descricao'] ?? '')) ?></textarea>
        </div>

        <div class="grid grid-2" style="grid-template-columns: 1fr 1fr;">
            <div class="field">
                <label for="preco">Preço (R$) *</label>
                <input type="number" step="0.01" min="0" id="preco" name="preco" value="<?= esc(old('preco', $produto['preco'] ?? '')) ?>" required>
            </div>
            <div class="field">
                <label for="estoque">Estoque *</label>
                <input type="number" min="0" id="estoque" name="estoque" value="<?= esc(old('estoque', $produto['estoque'] ?? '')) ?>" required>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary"><?= $editando ? 'Salvar alterações' : 'Cadastrar produto' ?></button>
            <a href="<?= base_url('produtos') ?>" class="btn btn-outline">Cancelar</a>
        </div>
    </form>
</div>

<?= $this->endSection() ?>
