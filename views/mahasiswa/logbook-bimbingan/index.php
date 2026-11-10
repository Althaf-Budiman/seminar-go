<?php require_once __DIR__ . '/../../layout/header.php'; ?>

<?php
$tabs = [
    'sempro' => [
        'id'           => 'tab-sempro',
        'key'          => 'Sempro',
        'label'        => 'Proposal',
        'dataTitle'    => 'Logbook Bimbingan Proposal',
        'active'       => true,
        'data'         => $sempro,
        'statLabel'    => 'Total Bimbingan',
        'statSubTotal' => 'Minimal 3 pertemuan sebelum sidang',
        'statSubSetuju'=> 'Catatan sudah diverifikasi dospem',
        'statSubTunggu'=> 'Menunggu verifikasi dospem',
        'syaratTitle'  => 'Syarat Maju Seminar Proposal',
        'showProgress' => false,
        'riwayatUnit'  => 'catatan',
    ],
    'skripsi' => [
        'id'           => 'tab-skripsi',
        'key'          => 'Skripsi',
        'label'        => 'Skripsi',
        'dataTitle'    => 'Logbook Bimbingan Skripsi',
        'active'       => false,
        'data'         => $skripsi,
        'statLabel'    => 'Sesi Bimbingan',
        'statSubTotal' => '',
        'statSubSetuju'=> '',
        'statSubTunggu'=> '',
        'syaratTitle'  => 'Syarat Maju Sidang',
        'showProgress' => true,
        'riwayatUnit'  => 'sesi',
    ],
];
?>

<?php foreach ($tabs as $programKey => $tab) : 
    $d = $tab['data'];
?>
<!-- =========================================================================
     Tab: <?= htmlspecialchars($tab['label']) ?>
     ========================================================================= -->
<div id="<?= $tab['id'] ?>" class="tab-panel dashboard-container" data-title="<?= htmlspecialchars($tab['dataTitle']) ?>" <?= !$tab['active'] ? 'style="display: none;"' : '' ?>>

    <!-- Statistik Bimbingan -->
    <div class="stats">
        <div class="stat-card">
            <span class="stat-label"><?= htmlspecialchars($tab['statLabel']) ?></span>
            <strong class="stat-value">
                <?= htmlspecialchars($d['statistik']['total'] ?? 0) ?>
            </strong>
            <?php if (!empty($tab['statSubTotal'])) : ?>
                <p><?= htmlspecialchars($tab['statSubTotal']) ?></p>
            <?php endif; ?>
        </div>

        <div class="stat-card">
            <span class="stat-label">Disetujui</span>
            <strong class="stat-value success">
                <?= (int) ($d['statistik']['disetujui'] ?? 0) ?>
            </strong>
            <?php if (!empty($tab['statSubSetuju'])) : ?>
                <p><?= htmlspecialchars($tab['statSubSetuju']) ?></p>
            <?php endif; ?>
        </div>

        <div class="stat-card">
            <span class="stat-label">Menunggu</span>
            <strong class="stat-value warning">
                <?= (int) ($d['statistik']['menunggu'] ?? 0) ?>
            </strong>
            <?php if (!empty($tab['statSubTunggu'])) : ?>
                <p><?= htmlspecialchars($tab['statSubTunggu']) ?></p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Syarat Maju -->
    <div class="content-card">
        <div class="card-header border-b">
            <h2><?= htmlspecialchars($tab['syaratTitle']) ?></h2>
            <a href="<?= BASE_URL ?>/logbook-bimbingan/tambah?program=<?= $programKey ?>" class="btn-primary">Tambah Logbook</a>
        </div>

        <?php if (!empty($tab['showProgress']) && isset($d['progress'])) : ?>
            <!-- Progress Bar -->
            <div class="bimbingan-progress-track" role="progressbar" aria-label="Progress syarat maju sidang" aria-valuenow="<?= (int) $d['progress'] ?>" aria-valuemin="0" aria-valuemax="100">
                <div class="bimbingan-progress-fill" style="width: <?= (int) $d['progress'] ?>%"></div>
            </div>
        <?php endif; ?>

        <div class="list list-lg">
            <?php foreach (($d['persyaratan'] ?? []) as $i => $item) : ?>
                <div class="list-item <?= htmlspecialchars($item['state']) ?>">
                    <div class="list-item-left">
                        <span class="list-item-num"><?= $i + 1 ?></span>
                        <h3><?= htmlspecialchars($item['judul']) ?></h3>
                    </div>
                    <span class="badge <?= htmlspecialchars($item['badgeClass']) ?> sm">
                        <?= htmlspecialchars($item['badge']) ?>
                    </span>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Riwayat Bimbingan -->
    <div class="content-card">
        <div class="card-header border-b">
            <h2>Riwayat Bimbingan</h2>
            <span class="badge primary sm">
                <?= count($d['riwayat'] ?? []) ?> <?= htmlspecialchars($tab['riwayatUnit']) ?>
            </span>
        </div>

        <div class="list list-lg">
            <?php foreach (($d['riwayat'] ?? []) as $item) : ?>
                <div class="list-item <?= htmlspecialchars($item['state']) ?>">
                    <div class="list-item-left">
                        <span class="list-item-num"><?= (int) $item['nomor'] ?></span>
                        <h3><?= htmlspecialchars($item['judul']) ?></h3>
                    </div>
                    <span class="badge <?= htmlspecialchars($item['badgeClass']) ?> sm">
                        <?= htmlspecialchars($item['badge']) ?>
                    </span>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

</div>
<?php endforeach; ?>

<?php require_once __DIR__ . '/../../layout/footer.php'; ?>
