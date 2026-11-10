<?php require_once __DIR__ . '/../../layout/header.php'; ?>

<?php
$tabs = [
    'sempro' => [
        'id'        => 'tab-sempro',
        'key'       => 'Sempro',
        'label'     => 'Seminar Proposal',
        'dataTitle' => 'Sidang Seminar Proposal',
        'active'    => true,
        'data'      => $sempro,
        'selamat'   => 'Selamat kamu sudah menyelesaikan seminar proposal!',
        'showAksi'  => false,
    ],
    'skripsi' => [
        'id'        => 'tab-skripsi',
        'key'       => 'Skripsi',
        'label'     => 'Skripsi',
        'dataTitle' => 'Sidang Skripsi',
        'active'    => false,
        'data'      => $skripsi,
        'selamat'   => '',
        'showAksi'  => true,
    ],
];
?>

<?php foreach ($tabs as $programKey => $tab) : 
    $d = $tab['data'];
    $label = $tab['label'];
?>
<!-- =========================================================================
     Tab: <?= htmlspecialchars($label) ?>
     ========================================================================= -->
<div id="<?= $tab['id'] ?>" class="tab-panel dashboard-container hasil-penilaian-page" data-title="<?= htmlspecialchars($tab['dataTitle']) ?>" <?= !$tab['active'] ? 'style="display: none;"' : '' ?>>

    <!-- Statistik Nilai -->
    <div class="stats">
        <div class="stat-card">
            <span class="stat-label">Nilai Akhir</span>
            <strong class="stat-value">
                <?= isset($d['nilaiAkhir']) ? number_format($d['nilaiAkhir'], 1, ',', '.') : '-' ?>
            </strong>
            <p>Skala 0 - 100</p>
        </div>

        <?php if (!empty($d['predikat'])) : ?>
            <div class="stat-card">
                <span class="stat-label">Predikat</span>
                <strong class="stat-value hasil-predikat">
                    <?= htmlspecialchars($d['predikat']) ?>
                </strong>
                <p>Predikat sidang <?= strtolower($label) ?></p>
            </div>
        <?php endif; ?>

        <div class="stat-card">
            <span class="stat-label">Keputusan</span>
            <strong class="stat-value success">
                <?= htmlspecialchars($d['keputusan'] ?? '-') ?>
            </strong>
            <p><?= htmlspecialchars($d['keteranganKeputusan'] ?? '') ?></p>
        </div>
    </div>

    <!-- Keputusan Sidang -->
    <div class="content-card">
        <div class="card-header border-b">
            <h2>Keputusan Sidang</h2>
            <span class="badge success">
                <?= htmlspecialchars($d['labelKeputusan'] ?? $d['keputusan'] ?? 'Lulus') ?>
            </span>
        </div>
        <p class="desc" style="margin-top: 1rem; color: #475569; line-height: 1.6;"></p>

        <div class="detail-item-row">
            <div class="detail-item" style="flex: 1;">
                <label>CATATAN UMUM</label>
                <p><?= htmlspecialchars($d['catatanUmum'] ?? '-') ?></p>
            </div>
        </div>

        <?php if (!empty($tab['selamat'])) : ?>
            <p style="font-weight: 700; margin-top: 16px;"><?= htmlspecialchars($tab['selamat']) ?></p>
        <?php endif; ?>
    </div>

    <!-- Rincian Nilai Dewan Penguji -->
    <?php if (!empty($d['dewanPenguji'])) : ?>
        <div class="content-card">
            <div class="card-header border-b">
                <h2>Rincian Nilai Dewan Penguji <?= htmlspecialchars($tab['key']) ?></h2>
                <span class="badge primary sm">
                    <?= count($d['dewanPenguji']) ?> penilai
                </span>
            </div>

            <div class="list list-lg">
                <?php foreach ($d['dewanPenguji'] as $index => $dosen) : ?>
                    <div class="list-item">
                        <div class="list-item-left">
                            <span class="list-item-num"><?= htmlspecialchars($index + 1) ?></span>
                            <h3><?= htmlspecialchars($dosen['nama']) ?></h3>
                        </div>
                        <strong class="hasil-nilai-angka"><?= (int) $dosen['nilai'] ?></strong>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>

    <!-- Komponen Penilaian -->
    <?php if (!empty($d['komponenPenilaian'])) : ?>
        <div class="content-card">
            <div class="card-header border-b">
                <h2>Komponen Penilaian <?= htmlspecialchars($label) ?></h2>
            </div>

            <div class="hasil-komponen-list">
                <?php foreach ($d['komponenPenilaian'] as $item) : ?>
                    <?php $nilai = max(0, min(100, (int) $item['nilai'])); ?>
                    <div class="hasil-komponen-item">
                        <div class="skripsi-progress-label">
                            <span><?= htmlspecialchars($item['nama']) ?></span>
                            <strong><?= $nilai ?></strong>
                        </div>
                        <div class="skripsi-progress-track">
                            <div class="skripsi-progress-fill" style="width: <?= $nilai ?>%"></div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>

    <!-- Detail Tempat (jika ada jadwal) -->
    <!-- <?php if (!empty($d['jadwal'])) : ?>
        <div class="content-card">
            <div class="card-header border-b">
                <h2>Detail Tempat</h2>
                <span class="badge success sm">
                    <?= htmlspecialchars($d['jadwal']['status'] ?? 'Terkonfirmasi') ?>
                </span>
            </div>

            <div class="detail-list">
                <div class="detail-item-row">
                    <div class="detail-item" style="flex: 1;">
                        <label>Hari & Tanggal</label>
                        <p><?= htmlspecialchars($d['jadwal']['tanggal'] ?? '-') ?></p>
                    </div>
                    <div class="detail-item" style="flex: 1;">
                        <label>Waktu</label>
                        <p><?= htmlspecialchars($d['jadwal']['waktu'] ?? '-') ?></p>
                    </div>
                </div>

                <div class="detail-item-row">
                    <div class="detail-item" style="flex: 1;">
                        <label>TEMPAT</label>
                        <?php if (!empty($d['jadwal']['link'])) : ?>
                            <a href="<?= htmlspecialchars($d['jadwal']['link']) ?>" style="width: fit-content" class="btn-primary" target="_blank" rel="noopener">Link Sidang</a>
                        <?php else : ?>
                            <p><?= htmlspecialchars($d['jadwal']['tempat'] ?? '-') ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="detail-item" style="flex: 1;">
                        <label>Mode Pelaksanaan</label>
                        <p><?= htmlspecialchars($d['jadwal']['mode'] ?? '-') ?></p>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- Aksi -->
    <?php if (!empty($tab['showAksi'])) : ?>
        <div class="form-actions">
            <a href="<?= BASE_URL ?>/revisi" class="btn-secondary">
                Lihat Revisi <?= htmlspecialchars($label) ?>
            </a>
        </div>
    <?php endif; ?>

</div>
<?php endforeach; ?>

<?php require_once __DIR__ . '/../../layout/footer.php'; ?>
