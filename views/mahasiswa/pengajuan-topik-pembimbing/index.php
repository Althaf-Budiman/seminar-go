<?php require_once __DIR__ . '/../../layout/header.php'; ?>


<div class="dashboard-container">

    <!-- Formulir Pengajuan Topik -->
    <div class="content-card">
        <div class="card-header border-b">
            <h2>Data Pengajuan</h2>
            <div class="header-actions">
                <span class="badge neutral sm"><?= htmlspecialchars($formulir['status']) ?></span>
                <a href="<?= BASE_URL ?>/formulir-pengajuan-topik" class="btn-primary">Isi Formulir</a>
            </div>
        </div>

        <div class="detail-list">
            <div class="detail-item">
                <label>Judul Proposal Penelitian</label>
                <h4><?= htmlspecialchars($formulir['judul']) ?></h4>
            </div>

            <div class="detail-item-row">
                <div class="detail-item">
                    <label>Topik Penelitian</label>
                    <p><?= htmlspecialchars($formulir['topik']) ?></p>
                </div>
                <div class="detail-item">
                    <label>Bidang Peminatan</label>
                    <p><?= htmlspecialchars($formulir['bidang']) ?></p>
                </div>
            </div>

            <div class="detail-item">
                <label>Ringkasan Eksekutif</label>
                <p class="desc"><?= nl2br(htmlspecialchars($formulir['ringkasan'])) ?></p>
            </div>
        </div>
    </div>

    <!-- Calon Dosen Pembimbing -->
    <div class="content-card">
        <div class="card-header border-b">
            <h2>Calon Dosen Pembimbing</h2>
            <span class="badge primary sm"><?= count($usulan) ?> usulan</span>
        </div>

        <div class="list">
            <?php foreach ($usulan as $item) :
                $isFirst = $item['prioritas'] === 1;
            ?>
                <div class="list-item <?= $isFirst ? 'active' : 'locked' ?>">
                    <div class="list-item-left">
                        <span class="list-item-num"><?= (int)$item['prioritas'] ?></span>
                        <h3><?= htmlspecialchars($item['nama']) ?></h3>
                    </div>
                    <span class="badge <?= $isFirst ? 'primary' : 'neutral' ?> sm">Prioritas <?= (int)$item['prioritas'] ?></span>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Status Pengajuan -->
    <div class="content-card">
        <div class="card-header border-b">
            <h2>Status Pengajuan</h2>
        </div>

        <div class="list list-lg">
            <?php foreach ($pengajuan as $i => $step) : ?>
                <div class="list-item <?= htmlspecialchars($step['state']) ?>">
                    <div class="list-item-left">
                        <span class="list-item-num"><?= $i + 1 ?></span>
                        <h3><?= htmlspecialchars($step['judul']) ?></h3>
                    </div>
                    <span class="badge <?= htmlspecialchars($step['badgeClass']) ?> sm"><?= htmlspecialchars($step['badge']) ?></span>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../../layout/footer.php'; ?>