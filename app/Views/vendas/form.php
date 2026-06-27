<?= $this->extend('layout/main') ?>

<?= $this->section('conteudo') ?>

<div class="page-head">
    <div>
        <h1>Registrar Venda</h1>
        <p>Selecione os produtos e a quantidade vendida</p>
    </div>
    <a href="<?= base_url('vendas') ?>" class="btn btn-outline">← Voltar</a>
</div>

<?php if (empty($produtos)): ?>
    <div class="card card-pad empty">
        <div class="icon">📦</div>
        <p>Não há produtos com estoque disponível.</p>
        <p><a href="<?= base_url('produtos/novo') ?>" class="nav-link">Cadastrar produto →</a></p>
    </div>
<?php else: ?>
<div class="grid grid-2">
    <div class="card card-pad">
        <h2 class="section-title">Itens da venda</h2>
        <form method="post" action="<?= base_url('vendas/registrar') ?>" id="form-venda">
            <?= csrf_field() ?>

            <div class="field" style="margin-bottom:18px;">
                <label for="cliente">Cliente *</label>
                <input type="text" id="cliente" name="cliente" value="<?= esc(old('cliente')) ?>" placeholder="Nome do cliente" required>
            </div>

            <div id="itens">
                <div class="item-row">
                    <div class="field">
                        <label>Produto</label>
                        <select name="produto_id[]" class="produto-select" onchange="recalcular()">
                            <option value="">Selecione...</option>
                            <?php foreach ($produtos as $p): ?>
                                <option value="<?= $p['id'] ?>" data-preco="<?= $p['preco'] ?>" data-estoque="<?= $p['estoque'] ?>">
                                    <?= esc($p['nome']) ?> — R$ <?= number_format($p['preco'], 2, ',', '.') ?> (<?= $p['estoque'] ?> em estoque)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="field">
                        <label>Qtd</label>
                        <input type="number" name="quantidade[]" class="qtd-input" min="1" value="1" onchange="recalcular()" oninput="recalcular()">
                    </div>
                    <div class="field">
                        <label>&nbsp;</label>
                        <button type="button" class="btn btn-danger btn-sm" onclick="removerLinha(this)">✕</button>
                    </div>
                </div>
            </div>

            <button type="button" class="btn btn-outline btn-sm" onclick="adicionarLinha()">+ Adicionar item</button>

            <div class="form-actions" style="margin-top:24px;">
                <button type="submit" class="btn btn-primary">Registrar venda</button>
            </div>
        </form>
    </div>

    <div class="card card-pad">
        <h2 class="section-title">Resumo</h2>
        <div id="resumo" class="muted">Selecione os produtos para ver o resumo.</div>
        <div class="total-line">
            <span>Total</span>
            <span id="total">R$ 0,00</span>
        </div>
    </div>
</div>

<template id="template-linha">
    <div class="item-row">
        <div class="field">
            <label>Produto</label>
            <select name="produto_id[]" class="produto-select" onchange="recalcular()">
                <option value="">Selecione...</option>
                <?php foreach ($produtos as $p): ?>
                    <option value="<?= $p['id'] ?>" data-preco="<?= $p['preco'] ?>" data-estoque="<?= $p['estoque'] ?>">
                        <?= esc($p['nome']) ?> — R$ <?= number_format($p['preco'], 2, ',', '.') ?> (<?= $p['estoque'] ?> em estoque)
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="field">
            <label>Qtd</label>
            <input type="number" name="quantidade[]" class="qtd-input" min="1" value="1" onchange="recalcular()" oninput="recalcular()">
        </div>
        <div class="field">
            <label>&nbsp;</label>
            <button type="button" class="btn btn-danger btn-sm" onclick="removerLinha(this)">✕</button>
        </div>
    </div>
</template>
<?php endif; ?>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    function adicionarLinha() {
        const tpl = document.getElementById('template-linha');
        const clone = tpl.content.cloneNode(true);
        document.getElementById('itens').appendChild(clone);
        recalcular();
    }

    function removerLinha(btn) {
        const linhas = document.querySelectorAll('#itens .item-row');
        if (linhas.length <= 1) {
            btn.closest('.item-row').querySelector('.produto-select').value = '';
            recalcular();
            return;
        }
        btn.closest('.item-row').remove();
        recalcular();
    }

    function recalcular() {
        let total = 0;
        let linhasResumo = [];
        document.querySelectorAll('#itens .item-row').forEach(function (row) {
            const select = row.querySelector('.produto-select');
            const qtdInput = row.querySelector('.qtd-input');
            const opt = select.options[select.selectedIndex];
            if (!select.value || !opt) return;

            const preco = parseFloat(opt.dataset.preco) || 0;
            const estoque = parseInt(opt.dataset.estoque) || 0;
            let qtd = parseInt(qtdInput.value) || 0;

            if (qtd > estoque) {
                qtd = estoque;
                qtdInput.value = estoque;
            }
            if (qtd < 1) return;

            const subtotal = preco * qtd;
            total += subtotal;

            const nome = opt.textContent.split(' — ')[0].trim();
            linhasResumo.push(
                '<div style="display:flex;justify-content:space-between;padding:6px 0;border-bottom:1px solid var(--border);">' +
                '<span>' + qtd + 'x ' + nome + '</span>' +
                '<span>R$ ' + subtotal.toLocaleString('pt-BR', {minimumFractionDigits: 2, maximumFractionDigits: 2}) + '</span>' +
                '</div>'
            );
        });

        const resumo = document.getElementById('resumo');
        resumo.innerHTML = linhasResumo.length
            ? linhasResumo.join('')
            : 'Selecione os produtos para ver o resumo.';

        document.getElementById('total').textContent =
            'R$ ' + total.toLocaleString('pt-BR', {minimumFractionDigits: 2, maximumFractionDigits: 2});
    }

    document.addEventListener('DOMContentLoaded', recalcular);
</script>
<?= $this->endSection() ?>
