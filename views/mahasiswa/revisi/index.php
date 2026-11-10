<?php require_once __DIR__ . '/../../layout/header.php'; ?>

<?php
$tabs = [
    'sempro' => [
        'id'        => 'tab-sempro',
        'key'       => 'Sempro',
        'label'     => 'Seminar Proposal',
        'dataTitle' => 'Revisi Seminar Proposal',
        'active'    => true,
        'data'      => $sempro,
        'uploadHint'=> 'Seret berkas ke sini atau pilih dari perangkat',
    ],
    'skripsi' => [
        'id'        => 'tab-skripsi',
        'key'       => 'Skripsi',
        'label'     => 'Skripsi',
        'dataTitle' => 'Revisi Skripsi',
        'active'    => false,
        'data'      => $skripsi,
        'uploadHint'=> 'Seret berkas lembar pengesahan ke sini atau pilih dari perangkat',
    ],
];
?>

<?php foreach ($tabs as $programKey => $tab) : 
    $d = $tab['data'];
    $key = $tab['key'];
    $label = $tab['label'];
?>
<!-- =========================================================================
     Tab: <?= htmlspecialchars($label) ?>
     ========================================================================= -->
<div id="<?= $tab['id'] ?>" class="tab-panel dashboard-container" data-title="<?= htmlspecialchars($tab['dataTitle']) ?>" <?= !$tab['active'] ? 'style="display: none;"' : '' ?>>

    <!-- Statistik Revisi -->
    <div class="stats">
        <div class="stat-card">
            <span class="stat-label">Total Catatan</span>
            <strong class="stat-value">
                <?= (int) ($d['statistik']['total'] ?? 0) ?>
            </strong>
            <p>Dari dewan penguji <?= strtolower($label) ?></p>
        </div>

        <div class="stat-card">
            <span class="stat-label">Selesai</span>
            <strong class="stat-value success">
                <?= (int) ($d['statistik']['selesai'] ?? 0) ?>
            </strong>
            <p>Sudah diperbaiki</p>
        </div>

        <div class="stat-card">
            <span class="stat-label">Batas Revisi</span>
            <strong class="stat-value warning">
                <?= htmlspecialchars($d['statistik']['batas'] ?? '-') ?>
            </strong>
            <p><?= htmlspecialchars($d['statistik']['sisaWaktu'] ?? '') ?></p>
        </div>
    </div>

    <!-- Daftar Catatan Revisi -->
    <div class="content-card">
        <div class="card-header border-b">
            <h2>Daftar Catatan Revisi <?= htmlspecialchars($label) ?></h2>
            <span class="badge warning sm">
                <?= (int) ($d['statistik']['belumSelesai'] ?? 0) ?> belum selesai
            </span>
        </div>

        <div class="list list-lg">
            <?php foreach ($d['revisi'] as $item) : ?>
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

    <!-- Unggah Lembar Revisi -->
    <div class="content-card">
        <div class="card-header border-b">
            <h2>Unggah Lembar Revisi <?= htmlspecialchars($label) ?></h2>
        </div>

        <form id="formUnggahRevisi<?= $key ?>" enctype="multipart/form-data">
            <label for="fileRevisi<?= $key ?>" class="upload-area">
                <strong id="namaFileRevisi<?= $key ?>">
                    <?= htmlspecialchars($tab['uploadHint']) ?>
                </strong>
                <span class="btn-primary">Pilih Berkas</span>
            </label>
            <input type="file" id="fileRevisi<?= $key ?>" name="file_revisi_<?= strtolower($key) ?>" accept=".pdf,.doc,.docx" hidden>
        </form>
    </div>

    <!-- Persetujuan Revisi Dewan Penguji -->
    <div class="content-card">
        <div class="card-header border-b">
            <h2>Persetujuan Revisi Dewan Penguji<?= $programKey === 'skripsi' ? ' Skripsi' : '' ?></h2>
        </div>

        <div class="list list-lg">
            <?php foreach ($d['persetujuan'] as $index => $item) : ?>
                <div class="list-item locked">
                    <div class="list-item-left">
                        <span class="list-item-num"><?= $index + 1 ?></span>
                        <h3><?= htmlspecialchars($item['nama']) ?></h3>
                    </div>
                    <span class="badge neutral sm">
                        <?= htmlspecialchars($item['status']) ?>
                    </span>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Aksi -->
    <div class="form-actions">
        <button type="button" class="btn-primary" id="btnKirimRevisi<?= $key ?>">
            Kirim Revisi untuk Persetujuan
        </button>
    </div>

</div>
<?php endforeach; ?>

<?php require_once __DIR__ . '/../../layout/footer.php'; ?>
