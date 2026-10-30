<?php
require_once __DIR__ . '/../layout/header.php';

?>

<div>
    <form
        action="<?= BASE_URL ?>/formulir-pengajuan-topik"
        method="POST"
        id="formulirTopikForm">
        <!-- Card Data Topik Penelitian -->
        <section class="content-card -card">

            <div class="card-header -header">
                <h2>Data Topik Penelitian</h2>
            </div>

            <div class="form-grid -grid">

                <!-- Judul Proposal -->
                <div class="form-field full">
                    <label for="judul">
                        Judul Proposal Penelitian
                    </label>

                    <input
                        type="text"
                        id="judul"
                        name="judul"
                        class="form-input"
                        placeholder="Masukkan judul proposal penelitian"
                        required>
                </div>

                <!-- Topik Penelitian -->
                <div class="form-field">
                    <label for="topik">
                        Topik Penelitian
                    </label>

                    <input
                        type="text"
                        id="topik"
                        name="topik"
                        class="form-input"
                        placeholder="Masukkan topik penelitian"
                        required>
                </div>

                <!-- Bidang Peminatan -->
                <div class="form-field">
                    <label for="bidang">
                        Bidang Peminatan
                    </label>

                    <select
                        id="bidang"
                        name="bidang"
                        class="form-input "
                        required>
                        <option
                            value=""
                            disabled>
                            Pilih bidang peminatan
                        </option>

                        <?php foreach (($bidang ?? []) as $opsiBidang): ?>
                            <option
                                value="<?= htmlspecialchars($opsiBidang) ?>">
                                <?= htmlspecialchars($opsiBidang) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Ringkasan -->
                <div class="form-field full">
                    <label for="ringkasan">
                        Ringkasan
                    </label>

                    <textarea
                        id="ringkasan"
                        name="ringkasan"
                        class="form-input "
                        placeholder="Tuliskan ringkasan latar belakang, tujuan, dan metode penelitian"
                        required></textarea>
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