<?php require_once __DIR__ . '/../layout/header.php'; ?>

<!-- =========================================================================
     Tab 1: Seminar Proposal
     ========================================================================= -->
<div id="tab-sempro" class="tab-panel dashboard-container hasil-penilaian-page" data-title="Hasil Penilaian Seminar Proposal">

    <!-- Statistik Nilai Sempro -->
    <div class="stats">
        <div class="stat-card">
            <span class="stat-label">Nilai Akhir</span>
            <strong class="stat-value">
                <?= number_format($sempro['nilaiAkhir'], 1, ',', '.') ?>
            </strong>
            <p>Skala 0 - 100</p>
        </div>

        <div class="stat-card">
            <span class="stat-label">Predikat</span>
            <strong class="stat-value hasil-predikat">
                <?= htmlspecialchars($sempro['predikat']) ?>
            </strong>
            <p>Predikat seminar proposal</p>
        </div>

        <div class="stat-card">
            <span class="stat-label">Keputusan</span>
            <strong class="stat-value success">
                <?= htmlspecialchars($sempro['keputusan']) ?>
            </strong>
            <p><?= htmlspecialchars($sempro['keteranganKeputusan']) ?></p>
        </div>
    </div>

    <!-- Rincian Nilai Dewan Penguji -->
    <div class="content-card">
        <div class="card-header border-b">
            <h2>Rincian Nilai Dewan Penguji Sempro</h2>
            <span class="badge primary sm">
                <?= count($sempro['dewanPenguji']) ?> penilai
            </span>
        </div>

        <div class="list list-lg">
            <?php foreach ($sempro['dewanPenguji'] as $dosen): ?>
                <div class="list-item active">
                    <div class="list-item-left">
                        <span class="list-item-num"><?= htmlspecialchars($dosen['inisial']) ?></span>
                        <h3><?= htmlspecialchars($dosen['nama']) ?></h3>
                    </div>
                    <strong class="hasil-nilai-angka"><?= (int) $dosen['nilai'] ?></strong>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Komponen Penilaian -->
    <div class="content-card">
        <div class="card-header border-b">
            <h2>Komponen Penilaian Seminar Proposal</h2>
        </div>

        <div class="hasil-komponen-list">
            <?php foreach ($sempro['komponenPenilaian'] as $item): ?>
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

    <!-- Catatan Dewan Penguji -->
    <div class="content-card">
        <div class="card-header border-b">
            <h2>Catatan Dewan Penguji</h2>
        </div>
        <p class="desc" style="margin-top: 1rem; color: #475569; line-height: 1.6;">
            <?= htmlspecialchars($sempro['catatanUmum']) ?>
        </p>
    </div>

    <!-- Aksi -->
    <div class="form-actions">
        <a href="<?= BASE_URL ?>/revisi" class="btn-secondary">
            Lihat Revisi
        </a>
        <a href="<?= BASE_URL ?>/hasil-penilaian/unduh" class="btn-primary">
            <?= htmlspecialchars($sempro['btnUnduh']) ?>
        </a>
    </div>

</div>

<!-- =========================================================================
     Tab 2: Skripsi
     ========================================================================= -->
<div id="tab-skripsi" class="tab-panel dashboard-container hasil-penilaian-page" data-title="Hasil Penilaian Skripsi" style="display: none;">

    <!-- Statistik Nilai Skripsi -->
    <div class="stats">
        <div class="stat-card">
            <span class="stat-label">Nilai Akhir</span>
            <strong class="stat-value">
                <?= number_format($skripsi['nilaiAkhir'], 1, ',', '.') ?>
            </strong>
            <p>Skala 0 - 100</p>
        </div>

        <div class="stat-card">
            <span class="stat-label">Predikat</span>
            <strong class="stat-value hasil-predikat">
                <?= htmlspecialchars($skripsi['predikat']) ?>
            </strong>
            <p>Predikat sidang skripsi</p>
        </div>

        <div class="stat-card">
            <span class="stat-label">Keputusan</span>
            <strong class="stat-value success">
                <?= htmlspecialchars($skripsi['keputusan']) ?>
            </strong>
            <p><?= htmlspecialchars($skripsi['keteranganKeputusan']) ?></p>
        </div>
    </div>

    <!-- Rincian Nilai Dewan Penguji Skripsi -->
    <div class="content-card">
        <div class="card-header border-b">
            <h2>Rincian Nilai Dewan Penguji Skripsi</h2>
            <span class="badge primary sm">
                <?= count($skripsi['dewanPenguji']) ?> penilai
            </span>
        </div>

        <div class="list list-lg">
            <?php foreach ($skripsi['dewanPenguji'] as $dosen): ?>
                <div class="list-item active">
                    <div class="list-item-left">
                        <span class="list-item-num"><?= htmlspecialchars($dosen['inisial']) ?></span>
                        <h3><?= htmlspecialchars($dosen['nama']) ?></h3>
                    </div>
                    <strong class="hasil-nilai-angka"><?= (int) $dosen['nilai'] ?></strong>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Komponen Penilaian Skripsi -->
    <div class="content-card">
        <div class="card-header border-b">
            <h2>Komponen Penilaian Skripsi</h2>
        </div>

        <div class="hasil-komponen-list">
            <?php foreach ($skripsi['komponenPenilaian'] as $item): ?>
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

    <!-- Catatan Dewan Penguji Skripsi -->
    <div class="content-card">
        <div class="card-header border-b">
            <h2>Catatan Dewan Penguji Skripsi</h2>
        </div>
        <p class="desc" style="margin-top: 1rem; color: #475569; line-height: 1.6;">
            <?= htmlspecialchars($skripsi['catatanUmum']) ?>
        </p>
    </div>

    <!-- Aksi -->
    <div class="form-actions">
        <a href="<?= BASE_URL ?>/revisi" class="btn-secondary">
            Lihat Revisi Skripsi
        </a>
        <a href="<?= BASE_URL ?>/hasil-penilaian/unduh" class="btn-primary">
            <?= htmlspecialchars($skripsi['btnUnduh']) ?>
        </a>
    </div>

</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
