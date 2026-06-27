<?= $this->extend('layout/main') ?>

<?= $this->section('conteudo') ?>

<div class="page-head">
    <div>
        <h1>Compras Realizadas</h1>
        <p>Histórico de todas as vendas</p>
    </div>
    <a href="<?= base_url('vendas/nova') ?>" class="btn btn-primary">+ Registrar venda</a>
</div>

<div class="card">
    <?php if (empty($vendas)): ?>
        <div class="empty">
            <div class="icon">🧾</div>
            <p>Nenhuma compra registrada.</p>
            <p><a href="<?= base_url('vendas/nova') ?>" class="nav-link">Registrar a primeira venda →</a></p>
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
                        <th class="text-right">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($vendas as $v): ?>
                        <tr>
                            <td>#<?= esc($v['id']) ?></td>
                            <td><strong><?= esc($v['cliente']) ?></strong></td>
                            <td><?= esc(date('d/m/Y H:i', strtotime($v['created_at']))) ?></td>
                            <td class="text-right">R$ <?= number_format($v['total'], 2, ',', '.') ?></td>
                            <td>
                                <div class="actions">
                                    <a href="<?= base_url('vendas/detalhes/' . $v['id']) ?>" class="btn btn-outline btn-sm">Ver detalhes</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>
