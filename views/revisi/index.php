<?php require_once __DIR__ . '/../layout/header.php'; ?>

<!-- =========================================================================
     Tab 1: Seminar Proposal
     ========================================================================= -->
<div id="tab-sempro" class="tab-panel dashboard-container" data-title="Revisi Seminar Proposal">

    <!-- Statistik Revisi Sempro -->
    <div class="stats">
        <div class="stat-card">
            <span class="stat-label">Total Catatan</span>
            <strong class="stat-value">
                <?= (int) $sempro['statistik']['total'] ?>
            </strong>
            <p>Dari dewan penguji proposal</p>
        </div>

        <div class="stat-card">
            <span class="stat-label">Selesai</span>
            <strong class="stat-value success">
                <?= (int) $sempro['statistik']['selesai'] ?>
            </strong>
            <p>Sudah diperbaiki</p>
        </div>

        <div class="stat-card">
            <span class="stat-label">Batas Revisi</span>
            <strong class="stat-value warning">
                <?= htmlspecialchars($sempro['statistik']['batas']) ?>
            </strong>
            <p><?= htmlspecialchars($sempro['statistik']['sisaWaktu']) ?></p>
        </div>
    </div>

    <!-- Daftar Catatan Revisi Sempro -->
    <div class="content-card">
        <div class="card-header border-b">
            <h2>Daftar Catatan Revisi Seminar Proposal</h2>
            <span class="badge warning sm">
                <?= (int) $sempro['statistik']['belumSelesai'] ?> belum selesai
            </span>
        </div>

        <div class="list list-lg">
            <?php foreach ($sempro['revisi'] as $item): ?>
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

    <!-- Unggah Lembar Revisi -->
    <div class="content-card">
        <div class="card-header border-b">
            <h2>Unggah Lembar Revisi Seminar Proposal</h2>
        </div>

        <form id="formUnggahRevisiSempro" enctype="multipart/form-data">
            <label for="fileRevisiSempro" class="upload-area">
                <strong id="namaFileRevisiSempro">
                    Seret berkas ke sini atau pilih dari perangkat
                </strong>
                <span class="btn-primary">Pilih Berkas</span>
            </label>
            <input type="file" id="fileRevisiSempro" name="file_revisi_sempro" accept=".pdf,.doc,.docx" hidden>
        </form>
    </div>

    <!-- Persetujuan Revisi Sempro -->
    <div class="content-card">
        <div class="card-header border-b">
            <h2>Persetujuan Revisi Dewan Penguji</h2>
        </div>

        <div class="list list-lg">
            <?php foreach ($sempro['persetujuan'] as $item): ?>
                <div class="list-item locked">
                    <div class="list-item-left">
                        <span class="list-item-num"><?= htmlspecialchars($item['inisial']) ?></span>
                        <h3><?= htmlspecialchars($item['nama']) ?></h3>
                    </div>
                    <span class="badge neutral sm">
                        <?= htmlspecialchars($item['status']) ?>
                    </span>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Aksi -->
    <div class="form-actions">
        <button type="button" class="btn-secondary" id="btnSimpanRevisiSempro">
            Simpan Draft
        </button>
        <button type="button" class="btn-primary" id="btnKirimRevisiSempro">
            <?= htmlspecialchars($sempro['btnAksi']) ?>
        </button>
    </div>

</div>

<!-- =========================================================================
     Tab 2: Skripsi
     ========================================================================= -->
<div id="tab-skripsi" class="tab-panel dashboard-container" data-title="Revisi Skripsi" style="display: none;">

    <!-- Statistik Revisi Skripsi -->
    <div class="stats">
        <div class="stat-card">
            <span class="stat-label">Total Catatan</span>
            <strong class="stat-value">
                <?= (int) $skripsi['statistik']['total'] ?>
            </strong>
            <p>Dari dewan penguji skripsi</p>
        </div>

        <div class="stat-card">
            <span class="stat-label">Selesai</span>
            <strong class="stat-value success">
                <?= (int) $skripsi['statistik']['selesai'] ?>
            </strong>
            <p>Sudah diperbaiki</p>
        </div>

        <div class="stat-card">
            <span class="stat-label">Batas Revisi</span>
            <strong class="stat-value warning">
                <?= htmlspecialchars($skripsi['statistik']['batas']) ?>
            </strong>
            <p><?= htmlspecialchars($skripsi['statistik']['sisaWaktu']) ?></p>
        </div>
    </div>

    <!-- Daftar Catatan Revisi Skripsi -->
    <div class="content-card">
        <div class="card-header border-b">
            <h2>Daftar Catatan Revisi Skripsi</h2>
            <span class="badge warning sm">
                <?= (int) $skripsi['statistik']['belumSelesai'] ?> belum selesai
            </span>
        </div>

        <div class="list list-lg">
            <?php foreach ($skripsi['revisi'] as $item): ?>
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

    <!-- Unggah Lembar Revisi Skripsi -->
    <div class="content-card">
        <div class="card-header border-b">
            <h2>Unggah Lembar Pengesahan Revisi Skripsi</h2>
        </div>

        <form id="formUnggahRevisiSkripsi" enctype="multipart/form-data">
            <label for="fileRevisiSkripsi" class="upload-area">
                <strong id="namaFileRevisiSkripsi">
                    Seret berkas lembar pengesahan ke sini atau pilih dari perangkat
                </strong>
                <span class="btn-primary">Pilih Berkas</span>
            </label>
            <input type="file" id="fileRevisiSkripsi" name="file_revisi_skripsi" accept=".pdf,.doc,.docx" hidden>
        </form>
    </div>

    <!-- Persetujuan Revisi Skripsi -->
    <div class="content-card">
        <div class="card-header border-b">
            <h2>Persetujuan Revisi Dewan Penguji Skripsi</h2>
        </div>

        <div class="list list-lg">
            <?php foreach ($skripsi['persetujuan'] as $item): ?>
                <div class="list-item <?= ($item['status'] === 'Disetujui' ? 'done' : ($item['status'] === 'Menunggu Review' ? 'active' : 'locked')) ?>">
                    <div class="list-item-left">
                        <span class="list-item-num"><?= htmlspecialchars($item['inisial']) ?></span>
                        <h3><?= htmlspecialchars($item['nama']) ?></h3>
                    </div>
                    <span class="badge <?= htmlspecialchars($item['badgeClass']) ?> sm">
                        <?= htmlspecialchars($item['status']) ?>
                    </span>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Aksi -->
    <div class="form-actions">
        <button type="button" class="btn-secondary" id="btnSimpanRevisiSkripsi">
            Simpan Draft
        </button>
        <button type="button" class="btn-primary" id="btnKirimRevisiSkripsi">
            <?= htmlspecialchars($skripsi['btnAksi']) ?>
        </button>
    </div>

</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
