<?php require_once __DIR__ . '/../layout/header.php'; ?>

<div class="dashboard-container">

    <!-- Welcome Banner -->
    <div class="content-card">
        <div class="card-header">
            <h2>Selamat Datang, <?= htmlspecialchars($dosenName ?? 'Dosen') ?>!</h2>
        </div>
    </div>

    <!-- Quota Bimbingan -->
    <div class="content-card">
        <div class="card-header">
            <div>
                <h2>Kuota Bimbingan</h2>
                <p>Sisa slot mahasiswa bimbingan yang tersedia</p>
            </div>
            <span class="badge <?= ($quotaLeft ?? 0) > 0 ? 'primary' : 'warning' ?>">
                <?= (int)($quotaLeft ?? 0) ?> slot tersisa
            </span>
        </div>
    </div>

    <!-- Daftar Mahasiswa Bimbingan -->
    <div class="content-card">
        <div class="card-header">
            <div>
                <h2>Mahasiswa Bimbingan</h2>
                <p>Daftar mahasiswa yang sedang dalam bimbingan Anda</p>
            </div>
            <span class="badge neutral">
                <?= count($mahasiswaBimbingan ?? []) ?> mahasiswa
            </span>
        </div>

        <?php if (empty($mahasiswaBimbingan)): ?>
            <div class="card-empty">
                <div class="empty-icon"><i class="bi bi-people"></i></div>
                <p>Belum ada mahasiswa bimbingan</p>
            </div>
        <?php else: ?>
            <div class="list">
                <?php foreach ($mahasiswaBimbingan as $mhs): ?>
                    <div class="list-item">
                        <div class="list-item-left">
                            <span class="icon-badge"><i class="bi bi-mortarboard"></i></span>
                            <div>
                                <h3><?= htmlspecialchars($mhs['nama']) ?></h3>
                                <p><?= htmlspecialchars($mhs['nim']) ?> — <?= htmlspecialchars($mhs['topik']) ?></p>
                            </div>
                        </div>
                        <div>
                            <?php
                            $statusClass = match($mhs['status'] ?? '') {
                                'Bimbingan' => 'primary',
                                'Seminar'   => 'warning',
                                'Pengajuan' => 'neutral',
                                default     => 'neutral',
                            };
                            ?>
                            <span class="badge <?= $statusClass ?>"><?= htmlspecialchars($mhs['status']) ?></span>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
