<?php require_once __DIR__ . '/../layout/header.php'; ?>

<!-- =========================================================================
     Tab 1: Seminar Proposal
     ========================================================================= -->
<div id="tab-sempro" class="tab-panel dashboard-container" data-title="Bimbingan Proposal">

    <!-- Statistik Bimbingan Sempro -->
    <div class="stats">
        <div class="stat-card">
            <span class="stat-label">Total Bimbingan</span>
            <strong class="stat-value">
                <?= (int) $sempro['statistik']['total'] ?>
            </strong>
            <p>Minimal 3 pertemuan sebelum sidang</p>
        </div>

        <div class="stat-card">
            <span class="stat-label">Disetujui</span>
            <strong class="stat-value success">
                <?= (int) $sempro['statistik']['disetujui'] ?>
            </strong>
            <p>Catatan sudah diverifikasi dospem</p>
        </div>

        <div class="stat-card">
            <span class="stat-label">Menunggu</span>
            <strong class="stat-value warning">
                <?= (int) $sempro['statistik']['menunggu'] ?>
            </strong>
            <p>Menunggu verifikasi dospem</p>
        </div>
    </div>

    <!-- Syarat Maju Seminar Proposal -->
    <div class="content-card">
        <div class="card-header border-b">
            <h2>Syarat Maju Seminar Proposal</h2>
            <span class="badge primary sm">
                <?= (int) $sempro['progress'] ?>%
            </span>
        </div>

        <!-- Progress Bar -->
        <div class="bimbingan-progress-track"
             role="progressbar"
             aria-label="Progress syarat maju seminar"
             aria-valuenow="<?= (int) $sempro['progress'] ?>"
             aria-valuemin="0"
             aria-valuemax="100">
            <div class="bimbingan-progress-fill" style="width: <?= (int) $sempro['progress'] ?>%"></div>
        </div>

        <div class="list list-lg">
            <?php foreach ($sempro['persyaratan'] as $i => $item): ?>
                <div class="list-item <?= htmlspecialchars($item['state']) ?>">
                    <div class="list-item-left">
                        <span class="list-item-num"><?= $i + 1 ?></span>
                        <h3><?= htmlspecialchars($item['judul']) ?></h3>
                    </div>
                    <span class="badge <?= htmlspecialchars($item['badgeClass']) ?> sm">
                        <?= htmlspecialchars($item['badge']) ?>
                    </span>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Riwayat Bimbingan Sempro -->
    <div class="content-card">
        <div class="card-header border-b">
            <h2>Riwayat Bimbingan</h2>
            <span class="badge primary sm">
                <?= count($sempro['riwayat']) ?> catatan
            </span>
        </div>

        <div class="list list-lg">
            <?php foreach ($sempro['riwayat'] as $item): ?>
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

    <!-- Aksi -->
    <div class="form-actions">
        <a href="<?= BASE_URL ?>/bimbingan/create?program=sempro" class="btn-primary" id="btnTambahBimbinganSempro">
            Tambah Catatan Bimbingan
        </a>
    </div>

</div>

<!-- =========================================================================
     Tab 2: Skripsi (matching uploaded image)
     ========================================================================= -->
<div id="tab-skripsi" class="tab-panel dashboard-container" data-title="Bimbingan Skripsi" style="display: none;">

    <!-- Statistik Bimbingan Skripsi -->
    <div class="stats">
        <div class="stat-card">
            <span class="stat-label">Sesi Bimbingan</span>
            <strong class="stat-value">
                <?= htmlspecialchars($skripsi['statistik']['sesi']) ?>
            </strong>
        </div>

        <div class="stat-card">
            <span class="stat-label">Disetujui</span>
            <strong class="stat-value success">
                <?= (int) $skripsi['statistik']['disetujui'] ?>
            </strong>
        </div>

        <div class="stat-card">
            <span class="stat-label">Menunggu</span>
            <strong class="stat-value warning">
                <?= (int) $skripsi['statistik']['menunggu'] ?>
            </strong>
        </div>
    </div>

    <!-- Syarat Maju Sidang Skripsi -->
    <div class="content-card">
        <div class="card-header border-b">
            <h2>Syarat Maju Sidang</h2>
            <span class="badge primary sm">
                <?= (int) $skripsi['progress'] ?>%
            </span>
        </div>

        <!-- Progress Bar -->
        <div class="bimbingan-progress-track"
             role="progressbar"
             aria-label="Progress syarat maju sidang"
             aria-valuenow="<?= (int) $skripsi['progress'] ?>"
             aria-valuemin="0"
             aria-valuemax="100">
            <div class="bimbingan-progress-fill" style="width: <?= (int) $skripsi['progress'] ?>%"></div>
        </div>

        <div class="list list-lg">
            <?php foreach ($skripsi['persyaratan'] as $i => $item): ?>
                <div class="list-item <?= htmlspecialchars($item['state']) ?>">
                    <div class="list-item-left">
                        <span class="list-item-num"><?= $i + 1 ?></span>
                        <h3><?= htmlspecialchars($item['judul']) ?></h3>
                    </div>
                    <span class="badge <?= htmlspecialchars($item['badgeClass']) ?> sm">
                        <?= htmlspecialchars($item['badge']) ?>
                    </span>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Riwayat Bimbingan Skripsi -->
    <div class="content-card">
        <div class="card-header border-b">
            <h2>Riwayat Bimbingan</h2>
            <span class="badge primary sm">
                <?= count($skripsi['riwayat']) ?> sesi
            </span>
        </div>

        <div class="list list-lg">
            <?php foreach ($skripsi['riwayat'] as $item): ?>
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

    <!-- Aksi -->
    <div class="form-actions">
        <a href="<?= BASE_URL ?>/bimbingan/create?program=skripsi" class="btn-primary" id="btnTambahBimbinganSkripsi">
            Tambah Catatan Bimbingan
        </a>
    </div>

</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
