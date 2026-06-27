<?= $this->extend('layout/main') ?>

<?= $this->section('conteudo') ?>

<div class="page-head">
    <div>
        <h1>Venda #<?= esc($venda['id']) ?></h1>
        <p><?= esc(date('d/m/Y \à\s H:i', strtotime($venda['created_at']))) ?></p>
    </div>
    <a href="<?= base_url('vendas') ?>" class="btn btn-outline">← Voltar</a>
</div>

<div class="grid grid-2">
    <div class="card">
        <div class="card-pad" style="border-bottom:1px solid var(--border);">
            <h2 class="section-title" style="margin:0;">Itens</h2>
        </div>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Produto</th>
                        <th class="text-right">Qtd</th>
                        <th class="text-right">Preço</th>
                        <th class="text-right">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($itens as $item): ?>
                        <tr>
                            <td><?= esc($item['produto_nome']) ?></td>
                            <td class="text-right"><?= esc($item['quantidade']) ?></td>
                            <td class="text-right">R$ <?= number_format($item['preco_unitario'], 2, ',', '.') ?></td>
                            <td class="text-right">R$ <?= number_format($item['subtotal'], 2, ',', '.') ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="card card-pad">
        <h2 class="section-title">Resumo</h2>
        <div style="display:flex;justify-content:space-between;padding:8px 0;">
            <span class="muted">Cliente</span>
            <strong><?= esc($venda['cliente']) ?></strong>
        </div>
        <div style="display:flex;justify-content:space-between;padding:8px 0;">
            <span class="muted">Itens</span>
            <span><?= count($itens) ?></span>
        </div>
        <div class="total-line">
            <span>Total</span>
            <span>R$ <?= number_format($venda['total'], 2, ',', '.') ?></span>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
