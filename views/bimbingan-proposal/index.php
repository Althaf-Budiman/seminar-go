
<?php require_once __DIR__ . '/../layout/header.php'; ?>

<div class="dashboard-container">

    <!-- Statistik Bimbingan -->
    <div class="stats">

        <div class="stat-card">
            <span class="stat-label">Total Bimbingan</span>
            <strong class="stat-value">
                <?= (int) $statistik['total'] ?>
            </strong>
            <p>Minimal 3 pertemuan sebelum sidang</p>
        </div>

        <div class="stat-card">
            <span class="stat-label">Disetujui</span>
            <strong class="stat-value success">
                <?= (int) $statistik['disetujui'] ?>
            </strong>
            <p>Catatan sudah diverifikasi dospem</p>
        </div>

        <div class="stat-card">
            <span class="stat-label">Menunggu</span>
            <strong class="stat-value warning">
                <?= (int) $statistik['menunggu'] ?>
            </strong>
            <p>Menunggu verifikasi dospem</p>
        </div>

    </div>

    <!-- Syarat Maju Seminar Proposal -->
    <div class="content-card">

        <div class="card-header border-b">
            <h2>Syarat Maju Seminar Proposal</h2>

            <span class="badge primary sm">
                <?= (int) $progress ?>%
            </span>
        </div>

        <!-- Progress Bar -->
        <div class="bimbingan-progress-track"
             role="progressbar"
             aria-label="Progress syarat maju seminar"
             aria-valuenow="<?= max(0, min(100, (int) $progress)) ?>"
             aria-valuemin="0"
             aria-valuemax="100">

            <div
                class="bimbingan-progress-fill"
                style="width: <?= max(0, min(100, (int) $progress)) ?>%">
            </div>

        </div>

        <div class="list list-lg">

            <?php foreach ($persyaratan as $i => $item): ?>
                <div class="list-item <?= htmlspecialchars($item['state']) ?>">

                    <div class="list-item-left">
                        <span class="list-item-num">
                            <?= $i + 1 ?>
                        </span>

                        <h3>
                            <?= htmlspecialchars($item['judul']) ?>
                        </h3>
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
                <?= count($riwayat) ?> catatan
            </span>
        </div>

        <div class="list list-lg">

            <?php foreach ($riwayat as $item): ?>
                <div class="list-item <?= htmlspecialchars($item['state']) ?>">

                    <div class="list-item-left">
                        <span class="list-item-num">
                            <?= (int) $item['nomor'] ?>
                        </span>

                        <h3>
                            <?= htmlspecialchars($item['judul']) ?>
                        </h3>
                    </div>

                    <span class="badge <?= htmlspecialchars($item['badgeClass']) ?> sm">
                        <?= htmlspecialchars($item['badge']) ?>
                    </span>

                </div>
            <?php endforeach; ?>

        </div>
    </div>

    <!-- Aksi -->
    <div class="form-actions">
        <a
            href="<?= BASE_URL ?>/proposal/tambah"
            class="btn-primary">
            Tambah Catatan Bimbingan
        </a>
    </div>

</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
