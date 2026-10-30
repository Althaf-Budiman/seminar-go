<?php
require_once __DIR__ . '/../layout/header.php';

$program = $_GET['program'];
?>

<div>
    <form
        action="<?= BASE_URL ?>/bimbingan/store?program=<?= $program ?>"
        method="POST">
        <!-- Card Data Topik Penelitian -->
        <section class="content-card">

            <div class="card-header">
                <h2>Data Bimbingan</h2>
            </div>

            <div class="form-grid">

                <!-- Topik Bimbingan -->
                <div class="form-field">
                    <label for="topik_bimbingan">
                        TOPIK BIMBINGAN
                    </label>

                    <input
                        type="text"
                        id="topik_bimbingan"
                        name="topik_bimbingan"
                        class="form-input"
                        placeholder="Masukkan topik bimbingan"
                        required>
                </div>

                <!-- Tanggal Bimbingan -->
                <div class="form-field">
                    <label for="tanggal">
                        TANGGAL BIMBINGAN
                    </label>

                    <input
                        type="date"
                        id="tanggal"
                        name="tanggal"
                        class="form-input"
                        placeholder="Pilih Tanggal"
                        required>
                </div>

                <!-- Dosen -->
                <div class="form-field">
                    <label for="dosen">
                        DOSEN PEMBIMBING
                    </label>

                    <select
                        id="bidang"
                        name="bidang"
                        class="form-input "
                        required>
                        <option
                            value=""
                            disabled>
                            Pilih Dosen Pembimbing
                        </option>

                        <?php foreach (($dosenPembimbing ?? []) as $opsiDosen): ?>
                            <option
                                value="<?= htmlspecialchars($opsiDosen) ?>">
                                <?= htmlspecialchars($opsiDosen) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Metode Bimbingan -->
                <div class="form-field">
                    <label for="metode_bimbingan">
                        METODE BIMBINGAN
                    </label>

                    <select
                        id="metode_bimbingan"
                        name="metode_bimbingan"
                        class="form-input "
                        required>
                        <option
                            value=""
                            disabled>
                            Pilih Metode Bimbingan
                        </option>

                        <?php foreach (($metodeBimbingan ?? []) as $opsiMetodeBimbingan): ?>
                            <option
                                value="<?= htmlspecialchars($opsiMetodeBimbingan) ?>">
                                <?= htmlspecialchars($opsiMetodeBimbingan) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Catatan Bimbingan -->
                <div class="form-field full">
                    <label for="catatan_bimbingan">
                        CATATAN BIMBINGAN
                    </label>

                    <textarea
                        id="catatan_bimbingan"
                        name="catatan_bimbingan"
                        class="form-input topik-textarea"
                        placeholder="Tuliskan catatan bimbingan"
                        required></textarea>
                </div>

                <!-- Lampiran -->
                <div class="form-field full">
                    <label for="lampiran">Lampiran</label>
                    <div class="form-input form-file">
                        <input type="file" id="lampiran" name="lampiran" class="form-file-input" title="">
                        <span class="form-file-text">Pilih berkas pendukung</span>
                    </div>
                </div>

            </div>
        </section>

        <!-- Action Buttons -->
        <div class="form-actions">

            <a
                href="<?= BASE_URL ?>/pengajuan-dosen-pembimbing"
                class="btn-secondary">
                Batal
            </a>

            <button type="submit" class="btn-primary">
                Kirim Pengajuan
            </button>

        </div>
    </form>

</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>