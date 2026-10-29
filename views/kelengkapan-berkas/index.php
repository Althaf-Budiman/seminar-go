<?php require_once __DIR__ . '/../layout/header.php'; ?>

<!-- =========================================================================
     Tab 1: Seminar Proposal
     ========================================================================= -->
<div id="tab-sempro" class="tab-panel dashboard-container" data-title="Kelengkapan Berkas Seminar Proposal">

    <!-- Daftar Berkas Wajib Sempro -->
    <div class="content-card">
        <div class="card-header border-b">
            <h2>Daftar Berkas Wajib</h2>
            <span class="badge warning sm">
                <?= (int) $sempro['jumlahLengkap'] ?> dari <?= count($sempro['berkas']) ?> lengkap
            </span>
        </div>

        <!-- Progress Berkas -->
        <div class="bimbingan-progress-track"
             role="progressbar"
             aria-label="Progress kelengkapan berkas"
             aria-valuenow="<?= (int) $sempro['progress'] ?>"
             aria-valuemin="0"
             aria-valuemax="100">
            <div class="bimbingan-progress-fill" style="width: <?= (int) $sempro['progress'] ?>%"></div>
        </div>

        <div class="list list-lg">
            <?php foreach ($sempro['berkas'] as $i => $item): ?>
                <div class="list-item <?= htmlspecialchars($item['state']) ?>">
                    <div class="list-item-left">
                        <span class="list-item-num"><?= $i + 1 ?></span>
                        <h3><?= htmlspecialchars($item['nama']) ?></h3>
                    </div>

                    <div class="form-actions">
                        <span class="badge <?= htmlspecialchars($item['badgeClass']) ?> sm">
                            <?= htmlspecialchars($item['status']) ?>
                        </span>

                        <label for="file-sempro-<?= (int) $item['id'] ?>"
                               class="<?= $item['uploaded'] ? 'btn-secondary' : 'btn-primary' ?>">
                            <?= $item['uploaded'] ? 'Ganti' : 'Unggah' ?>
                        </label>

                        <input type="file"
                               id="file-sempro-<?= (int) $item['id'] ?>"
                               name="berkas_sempro[<?= (int) $item['id'] ?>]"
                               class="berkas-file-input"
                               accept=".pdf,application/pdf">
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Ketentuan Berkas -->
    <div class="content-card">
        <div class="card-header border-b">
            <h2>Ketentuan Berkas</h2>
        </div>

        <div class="detail-item-row berkas-rules">
            <div class="detail-item">
                <label>Format Berkas</label>
                <p>PDF, maks. 5 MB per berkas</p>
            </div>
            <div class="detail-item">
                <label>Penamaan Berkas</label>
                <p>NIM_NamaBerkas.pdf</p>
            </div>
            <div class="detail-item">
                <label>Batas Unggah</label>
                <p>H-7 sebelum jadwal seminar</p>
            </div>
        </div>
    </div>

    <!-- Aksi -->
    <div class="form-actions">
        <button type="button" class="btn-secondary" id="btnSimpanBerkasSempro">
            Simpan
        </button>
        <button type="button" class="btn-primary" id="btnAjukanSempro">
            <?= htmlspecialchars($sempro['actionBtn']) ?>
        </button>
    </div>

</div>

<!-- =========================================================================
     Tab 2: Skripsi (matching uploaded image)
     ========================================================================= -->
<div id="tab-skripsi" class="tab-panel dashboard-container" data-title="Kelengkapan Berkas Skripsi" style="display: none;">

    <!-- Daftar Berkas Wajib Skripsi -->
    <div class="content-card">
        <div class="card-header border-b">
            <h2>Daftar Berkas Wajib</h2>
            <span class="badge warning sm">
                <?= (int) $skripsi['jumlahLengkap'] ?> dari <?= count($skripsi['berkas']) ?> lengkap
            </span>
        </div>

        <!-- Progress Berkas -->
        <div class="bimbingan-progress-track"
             role="progressbar"
             aria-label="Progress kelengkapan berkas skripsi"
             aria-valuenow="<?= (int) $skripsi['progress'] ?>"
             aria-valuemin="0"
             aria-valuemax="100">
            <div class="bimbingan-progress-fill" style="width: <?= (int) $skripsi['progress'] ?>%"></div>
        </div>

        <div class="list list-lg">
            <?php foreach ($skripsi['berkas'] as $i => $item): ?>
                <div class="list-item <?= htmlspecialchars($item['state']) ?>">
                    <div class="list-item-left">
                        <span class="list-item-num"><?= $i + 1 ?></span>
                        <h3><?= htmlspecialchars($item['nama']) ?></h3>
                    </div>

                    <div class="form-actions">
                        <span class="badge <?= htmlspecialchars($item['badgeClass']) ?> sm">
                            <?= htmlspecialchars($item['status']) ?>
                        </span>

                        <label for="file-skripsi-<?= (int) $item['id'] ?>"
                               class="<?= $item['uploaded'] ? 'btn-secondary' : 'btn-primary' ?>">
                            <?= $item['uploaded'] ? 'Ganti' : 'Unggah' ?>
                        </label>

                        <input type="file"
                               id="file-skripsi-<?= (int) $item['id'] ?>"
                               name="berkas_skripsi[<?= (int) $item['id'] ?>]"
                               class="berkas-file-input"
                               accept=".pdf,application/pdf">
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Ketentuan Berkas -->
    <div class="content-card">
        <div class="card-header border-b">
            <h2>Ketentuan Berkas</h2>
        </div>

        <div class="detail-item-row berkas-rules">
            <div class="detail-item">
                <label>Format Berkas</label>
                <p>PDF, maks. 5 MB per berkas</p>
            </div>
            <div class="detail-item">
                <label>Penamaan Berkas</label>
                <p>NIM_NamaBerkas.pdf</p>
            </div>
            <div class="detail-item">
                <label>Batas Unggah</label>
                <p>H-7 sebelum jadwal sidang skripsi</p>
            </div>
        </div>
    </div>

    <!-- Aksi -->
    <div class="form-actions">
        <button type="button" class="btn-secondary" id="btnSimpanBerkasSkripsi">
            Simpan
        </button>
        <button type="button" class="btn-primary" id="btnAjukanSkripsi">
            <?= htmlspecialchars($skripsi['actionBtn']) ?>
        </button>
    </div>

</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
