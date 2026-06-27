<?= $this->extend('layout/main') ?>

<?= $this->section('conteudo') ?>

<div class="page-head">
    <div>
        <h1>Painel</h1>
        <p>Visão geral da sua loja</p>
    </div>
    <div class="quick">
        <a href="<?= base_url('produtos/novo') ?>" class="btn btn-outline">+ Produto</a>
        <a href="<?= base_url('vendas/nova') ?>" class="btn btn-primary">Registrar venda</a>
    </div>
</div>

<div class="grid grid-3">
    <div class="metric">
        <div class="label">Produtos cadastrados</div>
        <div class="value"><?= esc($totalProdutos) ?></div>
    </div>
    <div class="metric">
        <div class="label">Vendas realizadas</div>
        <div class="value"><?= esc($totalVendas) ?></div>
    </div>
    <div class="metric">
        <div class="label">Faturamento total</div>
        <div class="value accent">R$ <?= number_format($faturamento, 2, ',', '.') ?></div>
    </div>
</div>

<div class="card" style="margin-top: 24px;">
    <div class="card-pad" style="border-bottom: 1px solid var(--border); display:flex; justify-content:space-between; align-items:center;">
        <h2 class="section-title" style="margin:0;">Últimas vendas</h2>
        <a href="<?= base_url('vendas') ?>" class="nav-link">Ver todas →</a>
    </div>
    <?php if (empty($ultimasVendas)): ?>
        <div class="empty">
            <div class="icon">🧾</div>
            <p>Nenhuma venda registrada ainda.</p>
        </div>
    <?php else: ?>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Cliente</th>
                        <th>Data</th>
                        <th class="text-right">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($ultimasVendas as $v): ?>
                        <tr>
                            <td>#<?= esc($v['id']) ?></td>
                            <td><?= esc($v['cliente']) ?></td>
                            <td><?= esc(date('d/m/Y H:i', strtotime($v['created_at']))) ?></td>
                            <td class="text-right">R$ <?= number_format($v['total'], 2, ',', '.') ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>
