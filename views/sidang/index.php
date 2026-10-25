
<?php require_once __DIR__ . '/../layout/header.php'; ?>

<div class="dashboard-container">

    <!-- Persiapan Sidang -->
    <div class="content-card">

        <div class="card-header border-b">
            <h2>Persiapan Sidang</h2>

            <span class="badge warning sm">
                <?= (int) $jumlahSiap ?> dari <?= count($persiapan) ?> siap
            </span>
        </div>

        <div class="list list-lg">

            <?php foreach ($persiapan as $i => $item): ?>
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
                        <?= htmlspecialchars($item['status']) ?>
                    </span>

                </div>
            <?php endforeach; ?>

        </div>
    </div>

    <!-- Susunan Acara Sidang -->
    <div class="content-card">

        <div class="card-header border-b">
            <h2>Susunan Acara Sidang</h2>
        </div>

        <div class="list list-lg">

            <?php foreach ($susunanAcara as $i => $item): ?>
                <div class="list-item <?= htmlspecialchars($item['state']) ?>">

                    <div class="list-item-left">
                        <span class="list-item-num">
                            <?= $i + 1 ?>
                        </span>

                        <h3>
                            <?= htmlspecialchars($item['judul']) ?>
                        </h3>
                    </div>

                </div>
            <?php endforeach; ?>

        </div>
    </div>

    <!-- Berita Acara Sidang -->
    <div class="content-card">

        <div class="card-header border-b">
            <h2>Berita Acara Sidang</h2>

            <span class="badge neutral sm">
                <?= htmlspecialchars($beritaAcara['status']) ?>
            </span>
        </div>

        <?php if (!$beritaAcara['tersedia']): ?>

            <div class="card-empty">
                <span class="empty-icon">
                    <i class="bi bi-lock"></i>
                </span>

                <p>Berita Acara Belum Tersedia</p>
            </div>

        <?php else: ?>

            <div class="detail-list">
                <div class="detail-item">
                    <label>Berita Acara</label>
                    <p><?= htmlspecialchars($beritaAcara['keterangan']) ?></p>
                </div>
            </div>

        <?php endif; ?>

    </div>

    <!-- Aksi -->
    <div class="form-actions">
        <a
            href="<?= BASE_URL ?>/jadwal-sidang"
            class="btn-primary"
        >
            Lihat Detail Ruangan
        </a>
    </div>

</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
