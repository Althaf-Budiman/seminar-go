
<?php require_once __DIR__ . '/../layout/header.php'; ?>

<div class="dashboard-container hasil-penilaian-page">

    <!-- Statistik Nilai -->
    <div class="stats">

        <div class="stat-card">
            <span class="stat-label">Nilai Akhir</span>
            <strong class="stat-value">
                <?= number_format($nilaiAkhir, 1, ',', '.') ?>
            </strong>
            <p>Skala 0 - 100</p>
        </div>

        <div class="stat-card">
            <span class="stat-label">Predikat</span>
            <strong class="stat-value hasil-predikat">
                <?= htmlspecialchars($predikat) ?>
            </strong>
            <p>Predikat sementara</p>
        </div>

        <div class="stat-card">
            <span class="stat-label">Keputusan</span>
            <strong class="stat-value success">
                <?= htmlspecialchars($keputusan) ?>
            </strong>
            <p><?= htmlspecialchars($keteranganKeputusan) ?></p>
        </div>

    </div>

    <!-- Rincian Nilai Dewan Penguji -->
    <div class="content-card">

        <div class="card-header border-b">
            <h2>Rincian Nilai Dewan Penguji</h2>

            <span class="badge primary sm">
                <?= count($dewanPenguji) ?> penilai
            </span>
        </div>

        <div class="list list-lg">

            <?php foreach ($dewanPenguji as $dosen): ?>
                <div class="list-item active">

                    <div class="list-item-left">

                        <span class="list-item-num">
                            <?= htmlspecialchars($dosen['inisial']) ?>
                        </span>

                        <h3>
                            <?= htmlspecialchars($dosen['nama']) ?>
                        </h3>

                    </div>

                    <strong class="hasil-nilai-angka">
                        <?= (int) $dosen['nilai'] ?>
                    </strong>

                </div>
            <?php endforeach; ?>

        </div>
    </div>

    <!-- Komponen Penilaian -->
    <div class="content-card">

        <div class="card-header border-b">
            <h2>Komponen Penilaian</h2>
        </div>

        <div class="hasil-komponen-list">

            <?php foreach ($komponenPenilaian as $item): ?>
                <?php $nilai = max(0, min(100, (int) $item['nilai'])); ?>

                <div class="hasil-komponen-item">

                    <div class="skripsi-progress-label">
                        <span><?= htmlspecialchars($item['nama']) ?></span>
                        <strong><?= $nilai ?></strong>
                    </div>

                    <div class="skripsi-progress-track">
                        <div
                            class="skripsi-progress-fill"
                            style="width: <?= $nilai ?>%">
                        </div>
                    </div>

                </div>
            <?php endforeach; ?>

        </div>
    </div>

    <!-- Keputusan Sidang -->
    <div class="content-card">

        <div class="card-header border-b">
            <h2>Keputusan Sidang</h2>

            <span class="badge success sm">
                <?= htmlspecialchars($labelKeputusan) ?>
            </span>
        </div>

        <div class="detail-list">

            <div class="detail-item">
                <label>Catatan Umum</label>

                <p class="desc">
                    <?= htmlspecialchars($catatanUmum) ?>
                </p>
            </div>

        </div>
    </div>

    <!-- Aksi -->
    <div class="form-actions">

        <a
            href="<?= BASE_URL ?>/hasil-penilaian/unduh"
            class="btn-secondary">
            Unduh Lembar Penilaian
        </a>

        <a
            href="<?= BASE_URL ?>/nilai-revisi"
            class="btn-primary">
            Lanjut ke Revisi
        </a>

    </div>

</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
