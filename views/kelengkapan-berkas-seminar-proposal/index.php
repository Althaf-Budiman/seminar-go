
<?php require_once __DIR__ . '/../layout/header.php'; ?>

<div class="dashboard-container">

    <!-- Daftar Berkas Wajib -->
    <div class="content-card">

        <div class="card-header border-b">
            <h2>Daftar Berkas Wajib</h2>

            <span class="badge warning sm">
                <?= (int) $jumlahLengkap ?> dari <?= count($berkas) ?> lengkap
            </span>
        </div>

        <!-- Progress Berkas -->
        <div
            class="bimbingan-progress-track"
            role="progressbar"
            aria-label="Progress kelengkapan berkas"
            aria-valuenow="<?= (int) $progress ?>"
            aria-valuemin="0"
            aria-valuemax="100"
        >
            <div
                class="bimbingan-progress-fill"
                style="width: <?= max(0, min(100, (int) $progress)) ?>%">
            </div>
        </div>

        <div class="list list-lg">

            <?php foreach ($berkas as $i => $item): ?>
                <div class="list-item <?= htmlspecialchars($item['state']) ?>">

                    <div class="list-item-left">
                        <span class="list-item-num">
                            <?= $i + 1 ?>
                        </span>

                        <h3>
                            <?= htmlspecialchars($item['nama']) ?>
                        </h3>
                    </div>

                    <div class="form-actions">

                        <span class="badge <?= htmlspecialchars($item['badgeClass']) ?> sm">
                            <?= htmlspecialchars($item['status']) ?>
                        </span>

                        <label
                            for="file-<?= (int) $item['id'] ?>"
                            class="btn-secondary"
                            style="font-size: 0.75rem"
                        >
                            <?= $item['uploaded'] ? 'Ganti' : 'Unggah' ?>
                        </label>

                        <input
                            type="file"
                            id="file-<?= (int) $item['id'] ?>"
                            name="berkas[<?= (int) $item['id'] ?>]"
                            class="berkas-file-input"
                            accept=".pdf,application/pdf"
                        >

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
                <p>H-7 sebelum jadwal sidang</p>
            </div>

        </div>
    </div>

    <!-- Aksi -->
    <div class="form-actions">
        <button type="button" class="btn-secondary" id="btnSimpanBerkas">
            Simpan
        </button>

        <button type="button" class="btn-primary" id="btnAjukanSempro">
            Ajukan Pendaftaran Sempro
        </button>
    </div>

</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
                