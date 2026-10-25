
<?php require_once __DIR__ . '/../layout/header.php'; ?>

<div class="dashboard-container">

    <!-- Jadwal Sidang Anda -->
    <div class="content-card">

        <div class="card-header border-b">
            <h2>Jadwal Sidang Anda</h2>

            <span class="badge success sm">
                <?= htmlspecialchars($jadwal['status']) ?>
            </span>
        </div>

        <div class="detail-list">

            <!-- Hari & Tanggal dan Waktu -->
            <div class="detail-item-row">

                <div class="detail-item" style="flex: 1;">
                    <label>Hari & Tanggal</label>
                    <p><?= htmlspecialchars($jadwal['tanggal']) ?></p>
                </div>

                <div class="detail-item" style="flex: 1;">
                    <label>Waktu</label>
                    <p><?= htmlspecialchars($jadwal['waktu']) ?></p>
                </div>

            </div>

            <!-- Ruangan dan Mode Pelaksanaan -->
            <div class="detail-item-row">

                <div class="detail-item" style="flex: 1;">
                    <label>Ruangan</label>
                    <p><?= htmlspecialchars($jadwal['ruangan']) ?></p>
                </div>

                <div class="detail-item" style="flex: 1;">
                    <label>Mode Pelaksanaan</label>
                    <p><?= htmlspecialchars($jadwal['mode']) ?></p>
                </div>

            </div>

        </div>
    </div>

    <!-- Dewan Penguji -->
    <div class="content-card">

        <div class="card-header border-b">
            <h2>Dewan Penguji</h2>

            <span class="badge primary sm">
                <?= count($dewanPenguji) ?> anggota
            </span>
        </div>

        <div class="list list-lg">

            <?php foreach ($dewanPenguji as $dosen): ?>
                <div class="list-item <?= htmlspecialchars($dosen['state']) ?>">

                    <div class="list-item-left">

                        <span class="list-item-num">
                            <?= htmlspecialchars($dosen['inisial']) ?>
                        </span>

                        <h3>
                            <?= htmlspecialchars($dosen['nama']) ?>
                        </h3>

                    </div>

                    <span class="badge <?= htmlspecialchars($dosen['badgeClass']) ?> sm">
                        <?= htmlspecialchars($dosen['peran']) ?>
                    </span>

                </div>
            <?php endforeach; ?>

        </div>
    </div>

    <!-- Aksi -->
    <div class="form-actions">

        <a
            href="<?= BASE_URL ?>/jadwal-sidang/perubahan"
            class="btn-secondary"
        >
            Ajukan Perubahan Jadwal
        </a>

        <a
            href="<?= BASE_URL ?>/jadwal-sidang/unduh-undangan"
            class="btn-primary"
        >
            Unduh Undangan Sidang
        </a>

    </div>

</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
