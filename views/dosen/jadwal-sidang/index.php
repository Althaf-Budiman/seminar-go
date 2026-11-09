<?php require_once __DIR__ . '/../../layout/header.php'; ?>


<!-- =========================================================================
     Tab 1: Seminar Proposal
     ========================================================================= -->
<div id="tab-sempro" class="tab-panel dashboard-container" data-title="Jadwal Seminar Proposal">

    <!-- Jadwal Seminar Proposal Anda -->
    <div class="content-card">
        <div class="card-header border-b">
            <h2>Jadwal Sidang Sempro Anda</h2>
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

    <!-- Dewan Penguji Seminar -->
    <div class="content-card">
        <div class="card-header border-b">
            <h2>Dewan Penguji / Pembahas</h2>
            <span class="badge primary sm">
                <?= count($sempro['dewanPenguji']) ?> anggota
            </span>
        </div>

        <div class="list list-lg">
            <?php foreach ($sempro['dewanPenguji'] as $index => $dosen) : ?>
                <div class="list-item">
                    <div class="list-item-left">
                        <span class="list-item-num"><?= htmlspecialchars($index + 1) ?></span>
                        <h3><?= htmlspecialchars($dosen['nama']) ?></h3>
                    </div>
                    <span class="badge neutral sm">
                        <?= htmlspecialchars($dosen['peran']) ?>
                    </span>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<!-- =========================================================================
     Tab 2: Skripsi
     ========================================================================= -->
<div id="tab-skripsi" class="tab-panel dashboard-container" data-title="Jadwal Sidang Skripsi" style="display: none;">

    <!-- Jadwal Sidang Skripsi Anda -->
    <div class="content-card">
        <div class="card-header border-b">
            <h2>Jadwal Sidang Skripsi Anda</h2>
            <span class="badge success sm">
                <?= htmlspecialchars($skripsi['jadwal']['status']) ?>
            </span>
        </div>

        <div class="detail-list">
            <!-- Hari & Tanggal dan Waktu -->
            <div class="detail-item-row">
                <div class="detail-item" style="flex: 1;">
                    <label>Hari & Tanggal</label>
                    <p><?= htmlspecialchars($skripsi['jadwal']['tanggal']) ?></p>
                </div>
                <div class="detail-item" style="flex: 1;">
                    <label>Waktu</label>
                    <p><?= htmlspecialchars($skripsi['jadwal']['waktu']) ?></p>
                </div>
            </div>

            <!-- Ruangan dan Mode Pelaksanaan -->
            <div class="detail-item-row">
                <div class="detail-item" style="flex: 1;">
                    <label>Ruangan</label>
                    <p><?= htmlspecialchars($skripsi['jadwal']['ruangan']) ?></p>
                </div>
                <div class="detail-item" style="flex: 1;">
                    <label>Mode Pelaksanaan</label>
                    <p><?= htmlspecialchars($skripsi['jadwal']['mode']) ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Dewan Penguji Sidang Skripsi -->
    <div class="content-card">
        <div class="card-header border-b">
            <h2>Dewan Penguji Skripsi</h2>
            <span class="badge primary sm">
                <?= count($skripsi['dewanPenguji']) ?> anggota
            </span>
        </div>

        <div class="list list-lg">
            <?php foreach ($skripsi['dewanPenguji'] as $index => $dosen) : ?>
                <div class="list-item">
                    <div class="list-item-left">
                        <span class="list-item-num"><?= $index + 1 ?></span>
                        <h3><?= htmlspecialchars($dosen['nama']) ?></h3>
                    </div>
                    <span class="badge neutral sm">
                        <?= htmlspecialchars($dosen['peran']) ?>
                    </span>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../../layout/footer.php'; ?>