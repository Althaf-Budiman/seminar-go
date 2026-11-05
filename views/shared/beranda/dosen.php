<?php require_once __DIR__ . '/../../layout/header.php'; ?>


<div class="dashboard-container">

    <!-- Welcome Banner -->
    <div class="content-card">
        <div class="card-header">
            <h2>Selamat Datang, <?= htmlspecialchars($dosenName) ?>!</h2>
        </div>
    </div>

    <?php if (($dosenRole ?? 'pembimbing') === 'pembimbing') : ?>
        <!-- =============================================================
             TAMPILAN DOSEN PEMBIMBING
             ============================================================= -->

        <!-- Menunggu Tinjauan -->
        <div class="content-card">
            <div class="card-header border-b">
                <h2>Menunggu Tinjauan</h2>
                <a href="<?= BASE_URL ?>/bimbingan" class="btn-primary">Daftar Mahasiswa Bimbingan</a>
            </div>

            <div class="stats" style="grid-template-columns: repeat(2, minmax(0, 1fr)); margin-top: 16px;">
                <div class="stat-card">
                    <span class="stat-label">LOGBOOK</span>
                    <strong class="stat-value"><?= (int)($pendingLogbook ?? 5) ?></strong>
                </div>
                <div class="stat-card">
                    <span class="stat-label">FORM</span>
                    <strong class="stat-value"><?= (int)($pendingForm ?? 5) ?></strong>
                </div>
            </div>
        </div>

        <!-- Timeline Pembimbing -->
        <div class="content-card">
            <div class="card-header">
                <h2>Timeline</h2>
            </div>

            <div class="list">
                <?php foreach (($timeline ?? []) as $item) : ?>
                    <div class="list-item <?= htmlspecialchars($item['badge'] ?? '') ?>">
                        <div class="list-item-left">
                            <span class="list-item-num"><?= (int)$item['step'] ?></span>
                            <div>
                                <h3><?= htmlspecialchars($item['title']) ?></h3>
                            </div>
                        </div>
                        <div>
                            <?php if (($item['badge'] ?? '') === 'active') : ?>
                                <span class="badge primary"><?= htmlspecialchars($item['status']) ?></span>
                            <?php else : ?>
                                <span class="badge neutral"><?= htmlspecialchars($item['status']) ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

    <?php else : ?>
        <!-- =============================================================
             TAMPILAN DOSEN PENGUJI
             ============================================================= -->

        <!-- Agenda Pengujian Singkat -->
        <div class="content-card">
            <div class="card-header border-b">
                <h2>Agenda Pengujian Terdekat</h2>
                <a href="<?= BASE_URL ?>/jadwal-sidang" class="btn-primary">Lihat Jadwal Lengkap</a>
            </div>

            <div class="stats" style="grid-template-columns: repeat(2, minmax(0, 1fr)); margin-top: 16px;">
                <div class="stat-card">
                    <span class="stat-label">SEMINAR PROPOSAL</span>
                    <strong class="stat-value">3</strong>
                </div>
                <div class="stat-card">
                    <span class="stat-label">SIDANG SKRIPSI</span>
                    <strong class="stat-value">1</strong>
                </div>
            </div>
        </div>

        <!-- Timeline Penguji -->
        <div class="content-card">
            <div class="card-header">
                <h2>Timeline</h2>
            </div>

            <div class="list">
                <?php foreach (($timeline ?? []) as $item) : ?>
                    <div class="list-item <?= htmlspecialchars($item['badge'] ?? '') ?>">
                        <div class="list-item-left">
                            <span class="list-item-num"><?= (int)$item['step'] ?></span>
                            <div>
                                <h3><?= htmlspecialchars($item['title']) ?></h3>
                            </div>
                        </div>
                        <div>
                            <?php if (($item['badge'] ?? '') === 'active') : ?>
                                <span class="badge primary"><?= htmlspecialchars($item['status']) ?></span>
                            <?php else : ?>
                                <span class="badge neutral"><?= htmlspecialchars($item['status']) ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

    <?php endif; ?>

</div>

<?php require_once __DIR__ . '/../../layout/footer.php'; ?>