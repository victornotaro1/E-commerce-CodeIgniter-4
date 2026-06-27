<?= $this->extend('layout/main') ?>

<?= $this->section('conteudo') ?>

<div class="page-head">
    <div>
        <h1>Produtos</h1>
        <p>Gerencie o catálogo da sua loja</p>
    </div>
    <a href="<?= base_url('produtos/novo') ?>" class="btn btn-primary">+ Novo produto</a>
</div>

<div class="card">
    <?php if (empty($produtos)): ?>
        <div class="empty">
            <div class="icon">📦</div>
            <p>Nenhum produto cadastrado.</p>
            <p><a href="<?= base_url('produtos/novo') ?>" class="nav-link">Cadastrar o primeiro produto →</a></p>
        </div>
    <?php else: ?>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Produto</th>
                        <th class="text-right">Preço</th>
                        <th class="text-right">Estoque</th>
                        <th>Status</th>
                        <th class="text-right">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($produtos as $p): ?>
                        <tr>
                            <td>
                                <strong><?= esc($p['nome']) ?></strong>
                                <?php if (! empty($p['descricao'])): ?>
                                    <div class="muted" style="font-size:.85rem;"><?= esc(character_limiter($p['descricao'], 60)) ?></div>
                                <?php endif; ?>
                            </td>
                            <td class="text-right">R$ <?= number_format($p['preco'], 2, ',', '.') ?></td>
                            <td class="text-right"><?= esc($p['estoque']) ?></td>
                            <td>
                                <?php $e = (int) $p['estoque']; ?>
                                <?php if ($e === 0): ?>
                                    <span class="badge badge-out">Esgotado</span>
                                <?php elseif ($e <= 5): ?>
                                    <span class="badge badge-low">Estoque baixo</span>
                                <?php else: ?>
                                    <span class="badge badge-ok">Disponível</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="actions">
                                    <a href="<?= base_url('produtos/editar/' . $p['id']) ?>" class="btn btn-outline btn-sm">Editar</a>
                                    <a href="<?= base_url('produtos/excluir/' . $p['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Excluir este produto?');">Excluir</a>
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
