<?php require_once __DIR__ . '/../layout/header.php'; ?>

<div class="dashboard-container">

    <!-- Welcome Banner -->
    <div class="content-card">
        <div class="card-header">
            <h2>Selamat Datang, <?= htmlspecialchars($adminName ?? 'Admin') ?>!</h2>
        </div>
    </div>

    <!-- Overview Cards -->
    <div class="content-card">
        <div class="card-header">
            <h2>Overview</h2>
        </div>

        <div class="stats">
            <div class="stat-card">
                <span class="stat-label">AKUN MAHASISWA</span>
                <strong class="stat-value"><?= (int)($totalMahasiswa ?? 0) ?></strong>
            </div>
            <div class="stat-card">
                <span class="stat-label">AKUN DOSEN</span>
                <strong class="stat-value"><?= (int)($totalDosen ?? 0) ?></strong>
            </div>
            <div class="stat-card">
                <span class="stat-label">KEGIATAN BULAN INI</span>
                <strong class="stat-value"><?= (int)($kegiatanBulan ?? 0) ?></strong>
            </div>
        </div>
    </div>

    <!-- Timeline -->
    <div class="content-card">
        <div class="card-header">
            <h2>Timeline</h2>
        </div>

        <div class="list">
            <?php foreach (($timeline ?? []) as $item): ?>
                <div class="list-item <?= htmlspecialchars($item['badge'] ?? '') ?>">
                    <div class="list-item-left">
                        <span class="list-item-num"><?= (int)$item['step'] ?></span>
                        <div>
                            <h3><?= htmlspecialchars($item['title']) ?></h3>
                        </div>
                    </div>
                    <div>
                        <?php if (($item['badge'] ?? '') === 'active'): ?>
                            <span class="badge primary"><?= htmlspecialchars($item['status']) ?></span>
                        <?php else: ?>
                            <span class="badge neutral"><?= htmlspecialchars($item['status']) ?></span>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
