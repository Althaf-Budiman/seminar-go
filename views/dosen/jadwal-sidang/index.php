<?php require_once __DIR__ . '/../../layout/header.php'; ?>

<?php
$tabs = [
    'sempro' => [
        'id'           => 'tab-sempro',
        'key'          => 'Sempro',
        'label'        => 'Seminar Proposal',
        'dataTitle'    => 'Jadwal Seminar Proposal',
        'active'       => true,
        'data'         => $sempro,
        'pengujiTitle' => 'Dewan Penguji / Pembahas',
    ],
    'skripsi' => [
        'id'           => 'tab-skripsi',
        'key'          => 'Skripsi',
        'label'        => 'Skripsi',
        'dataTitle'    => 'Jadwal Sidang Skripsi',
        'active'       => false,
        'data'         => $skripsi,
        'pengujiTitle' => 'Dewan Penguji Skripsi',
    ],
];
?>

<?php foreach ($tabs as $programKey => $tab) : 
    $d = $tab['data'];
    $jadwal = $d['jadwal'] ?? [];
    $penguji = $d['dewanPenguji'] ?? [];
?>
<!-- =========================================================================
     Tab: <?= htmlspecialchars($tab['label']) ?>
     ========================================================================= -->
<div id="<?= $tab['id'] ?>" class="tab-panel dashboard-container" data-title="<?= htmlspecialchars($tab['dataTitle']) ?>" <?= !$tab['active'] ? 'style="display: none;"' : '' ?>>

    <!-- Jadwal Sidang Anda -->
    <div class="content-card">
        <div class="card-header border-b">
            <h2>Jadwal Sidang <?= htmlspecialchars($tab['key']) ?> Anda</h2>
            <?php if (!empty($jadwal['status'])) : ?>
                <span class="badge success sm">
                    <?= htmlspecialchars($jadwal['status']) ?>
                </span>
            <?php endif; ?>
        </div>

        <div class="detail-list">
            <!-- Hari & Tanggal dan Waktu -->
            <div class="detail-item-row">
                <div class="detail-item" style="flex: 1;">
                    <label>Hari & Tanggal</label>
                    <p><?= htmlspecialchars($jadwal['tanggal'] ?? '-') ?></p>
                </div>
                <div class="detail-item" style="flex: 1;">
                    <label>Waktu</label>
                    <p><?= htmlspecialchars($jadwal['waktu'] ?? '-') ?></p>
                </div>
            </div>

            <!-- Ruangan / Tempat dan Mode Pelaksanaan -->
            <div class="detail-item-row">
                <div class="detail-item" style="flex: 1;">
                    <label><?= !empty($jadwal['link']) ? 'TEMPAT' : 'Ruangan' ?></label>
                    <?php if (!empty($jadwal['link'])) : ?>
                        <a href="<?= htmlspecialchars($jadwal['link']) ?>" style="width: fit-content" class="btn-primary" target="_blank" rel="noopener">Link Sidang</a>
                    <?php else : ?>
                        <p><?= htmlspecialchars($jadwal['ruangan'] ?? $jadwal['tempat'] ?? '-') ?></p>
                    <?php endif; ?>
                </div>
                <div class="detail-item" style="flex: 1;">
                    <label>Mode Pelaksanaan</label>
                    <p><?= htmlspecialchars($jadwal['mode'] ?? '-') ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Dewan Penguji -->
    <div class="content-card">
        <div class="card-header border-b">
            <h2><?= htmlspecialchars($tab['pengujiTitle']) ?></h2>
            <span class="badge primary sm">
                <?= count($penguji) ?> anggota
            </span>
        </div>

        <div class="list list-lg">
            <?php foreach ($penguji as $index => $dosen) : ?>
                <div class="list-item">
                    <div class="list-item-left">
                        <span class="list-item-num"><?= htmlspecialchars($index + 1) ?></span>
                        <h3><?= htmlspecialchars($dosen['nama']) ?></h3>
                    </div>
                    <span class="badge neutral sm">
                        <?= htmlspecialchars($dosen['peran'] ?? 'Penguji') ?>
                    </span>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?php endforeach; ?>

<?php require_once __DIR__ . '/../../layout/footer.php'; ?>
