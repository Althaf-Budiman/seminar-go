<?php require_once __DIR__ . '/../../layout/header.php'; ?>


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
            <span class="stat-label">Keputusan</span>
            <strong class="stat-value success">
                <?= htmlspecialchars($sempro['keputusan']) ?>
            </strong>
            <p><?= htmlspecialchars($sempro['keteranganKeputusan']) ?></p>
        </div>
    </div>

    <!-- Keputusan sidang -->
    <div class="content-card">
        <div class="card-header border-b">
            <h2>Keputusan Sidang</h2>
            <span class="badge success">
                Lulus
            </span>
        </div>
        <p class="desc" style="margin-top: 1rem; color: #475569; line-height: 1.6;">
        </p>

        <div class="detail-item-row">
            <div class="detail-item" style="flex: 1;">
                <label>CATATAN UMUM</label>
                <?= htmlspecialchars($sempro['catatanUmum']) ?>
            </div>
        </div>

        <p style="font-weight: 700; margin-top: 16px;">Selamat kamu sudah menyelesaikan seminar proposal!</p>
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
            <?php foreach ($sempro['dewanPenguji'] as $index => $dosen) : ?>
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

    <!-- Komponen Penilaian -->
    <div class="content-card">
        <div class="card-header border-b">
            <h2>Komponen Penilaian Seminar Proposal</h2>
        </div>

        <div class="hasil-komponen-list">
            <?php foreach ($sempro['komponenPenilaian'] as $item) : ?>
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

    <!-- Detail Tempat -->
    <div class="content-card">
        <div class="card-header border-b">
            <h2>Detail Tempat</h2>
            <span class="badge success sm">
                <?= htmlspecialchars($sempro['jadwal']['status']) ?>
            </span>
        </div>

        <div class="detail-list">
            <!-- Hari & Tanggal dan Waktu -->
            <div class="detail-item-row">
                <div class="detail-item" style="flex: 1;">
                    <label>Hari & Tanggal</label>
                    <p><?= htmlspecialchars($sempro['jadwal']['tanggal']) ?></p>
                </div>
                <div class="detail-item" style="flex: 1;">
                    <label>Waktu</label>
                    <p><?= htmlspecialchars($sempro['jadwal']['waktu']) ?></p>
                </div>

            </div>

            <!-- Ruangan dan Mode Pelaksanaan -->
            <div class="detail-item-row">
                <div class="detail-item" style="flex: 1;">
                    <label>TEMPAT</label>
                    <a href="<?= htmlspecialchars($sempro['jadwal']['link']) ?>" style="width: fit-content" class="btn-primary">Link Sidang</a>
                </div>
                <div class="detail-item" style="flex: 1;">
                    <label>Mode Pelaksanaan</label>
                    <p><?= htmlspecialchars($sempro['jadwal']['mode']) ?></p>
                </div>
            </div>
        </div>
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

    <!-- Keputusan sidang -->
    <div class="content-card">
        <div class="card-header border-b">
            <h2>Keputusan Sidang</h2>
            <span class="badge success">
                Lulus dengan Revisi
            </span>
        </div>
        <p class="desc" style="margin-top: 1rem; color: #475569; line-height: 1.6;">
        </p>

        <div class="detail-item-row">
            <div class="detail-item" style="flex: 1;">
                <label>CATATAN UMUM</label>
                <?= htmlspecialchars($sempro['catatanUmum']) ?>
            </div>
        </div>
    </div>

    <!-- Komponen Penilaian Skripsi -->
    <div class="content-card">
        <div class="card-header border-b">
            <h2>Komponen Penilaian Skripsi</h2>
        </div>

        <div class="hasil-komponen-list">
            <?php foreach ($skripsi['komponenPenilaian'] as $item) : ?>
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

    <!-- Rincian Nilai Dewan Penguji Skripsi -->
    <div class="content-card">
        <div class="card-header border-b">
            <h2>Rincian Nilai Dewan Penguji Skripsi</h2>
            <span class="badge primary sm">
                <?= count($skripsi['dewanPenguji']) ?> penilai
            </span>
        </div>

        <div class="list list-lg">
            <?php foreach ($skripsi['dewanPenguji'] as $index => $dosen) : ?>
                <div class="list-item">
                    <div class="list-item-left">
                        <span class="list-item-num"><?= $index + 1 ?></span>
                        <h3><?= htmlspecialchars($dosen['nama']) ?></h3>
                    </div>
                    <strong class="hasil-nilai-angka"><?= (int) $dosen['nilai'] ?></strong>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Aksi -->
    <div class="form-actions">
        <a href="<?= BASE_URL ?>/revisi" class="btn-secondary">
            Lihat Revisi Skripsi
        </a>
    </div>

</div>

<?php require_once __DIR__ . '/../../layout/footer.php'; ?>