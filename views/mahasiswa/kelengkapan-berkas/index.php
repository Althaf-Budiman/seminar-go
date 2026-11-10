<?php require_once __DIR__ . '/../../layout/header.php'; ?>

<?php
$tabs = [
    'sempro' => [
        'id'           => 'tab-sempro',
        'key'          => 'Sempro',
        'filePrefix'   => 'sempro',
        'label'        => 'Seminar Proposal',
        'dataTitle'    => 'Kelengkapan Berkas Seminar Proposal',
        'active'       => true,
        'data'         => $sempro,
        'batasUnggah'  => 'H-7 sebelum jadwal seminar',
        'actionBtn'    => $sempro['actionBtn'] ?? 'Ajukan Pendaftaran Sempro',
    ],
    'skripsi' => [
        'id'           => 'tab-skripsi',
        'key'          => 'Skripsi',
        'filePrefix'   => 'skripsi',
        'label'        => 'Skripsi',
        'dataTitle'    => 'Kelengkapan Berkas Skripsi',
        'active'       => false,
        'data'         => $skripsi,
        'batasUnggah'  => 'H-7 sebelum jadwal sidang skripsi',
        'actionBtn'    => $skripsi['actionBtn'] ?? 'Ajukan Pendaftaran Skripsi',
    ],
];
?>

<?php foreach ($tabs as $programKey => $tab) : 
    $d = $tab['data'];
    $key = $tab['key'];
    $filePrefix = $tab['filePrefix'];
?>
<!-- =========================================================================
     Tab: <?= htmlspecialchars($tab['label']) ?>
     ========================================================================= -->
<div id="<?= $tab['id'] ?>" class="tab-panel dashboard-container" data-title="<?= htmlspecialchars($tab['dataTitle']) ?>" <?= !$tab['active'] ? 'style="display: none;"' : '' ?>>

    <!-- Syarat Pendaftaran -->
    <div class="content-card">
        <div class="card-header border-b">
            <h2>Syarat Pendaftaran</h2>
            <span class="badge success sm">
                Diperiksa oleh sistem
            </span>
        </div>

        <div class="list list-lg">
            <?php foreach ($d['syarat_pendaftaran'] as $i => $item) : ?>
                <div class="list-item <?= htmlspecialchars($item['state']) ?>">
                    <div class="list-item-left">
                        <span class="list-item-num"><?= $i + 1 ?></span>
                        <h3><?= htmlspecialchars($item['nama']) ?></h3>
                    </div>

                    <div>
                        <span class="badge <?= htmlspecialchars($item['badgeClass']) ?> sm">
                            <?= htmlspecialchars($item['status']) ?>
                        </span>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Daftar Berkas Wajib -->
    <div class="content-card">
        <div class="card-header border-b">
            <h2>Daftar Berkas Wajib</h2>
            <span class="badge warning sm">
                <?= (int) ($d['jumlahLengkap'] ?? 0) ?> dari <?= count($d['berkas'] ?? []) ?> lengkap
            </span>
        </div>

        <div class="list list-lg">
            <?php foreach ($d['berkas'] as $i => $item) : ?>
                <div class="list-item <?= htmlspecialchars($item['state']) ?>">
                    <div class="list-item-left">
                        <span class="list-item-num"><?= $i + 1 ?></span>
                        <h3><?= htmlspecialchars($item['nama']) ?></h3>
                    </div>

                    <div class="form-actions">
                        <span class="badge <?= htmlspecialchars($item['badgeClass']) ?> sm">
                            <?= htmlspecialchars($item['status']) ?>
                        </span>

                        <label for="file-<?= $filePrefix ?>-<?= (int) $item['id'] ?>" class="<?= !empty($item['uploaded']) ? 'btn-secondary' : 'btn-primary' ?>">
                            <?= !empty($item['uploaded']) ? 'Ganti' : 'Unggah' ?>
                        </label>

                        <input type="file" id="file-<?= $filePrefix ?>-<?= (int) $item['id'] ?>" name="berkas_<?= $filePrefix ?>[<?= (int) $item['id'] ?>]" class="berkas-file-input" accept=".pdf,application/pdf">
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Ketentuan Berkas -->
    <div class="content-card">
        <div class="card-header border-b">
            <h2>Ketentuan Berkas</h2>
        </div>

        <div class="detail-item-row berkas-rules">
            <div class="detail-item">
                <label>Format Berkas</label>
                <p>PDF, maks. 5 MB per berkas</p>
            </div>
            <div class="detail-item">
                <label>Penamaan Berkas</label>
                <p>NIM_NamaBerkas.pdf</p>
            </div>
            <div class="detail-item">
                <label>Batas Unggah</label>
                <p><?= htmlspecialchars($tab['batasUnggah']) ?></p>
            </div>
        </div>
    </div>

    <!-- Aksi -->
    <div class="form-actions">
        <button type="button" class="btn-primary" id="btnAjukan<?= $key ?>">
            <?= htmlspecialchars($tab['actionBtn']) ?>
        </button>
    </div>

</div>
<?php endforeach; ?>

<?php require_once __DIR__ . '/../../layout/footer.php'; ?>
