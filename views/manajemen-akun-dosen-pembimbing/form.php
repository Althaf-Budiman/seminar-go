<?php
require_once __DIR__ . '/../layout/header.php';

?>

<div>
    <form
        action="<?= BASE_URL ?>/manajemen-akun-dosen-pembimbing/store"
        method="POST">
        <!-- Card Data Topik Penelitian -->
        <section class="content-card">

            <div class="card-header">
                <h2>Tambah Akun Dosen Pembimbing</h2>
            </div>

            <div class="form-grid">

                <!-- Nama Lengkap -->
                <div class="form-field">
                    <label for="nama_lengkap">
                        NAMA LENGKAP
                    </label>

                    <input
                        type="text"
                        id="nama_lengkap"
                        name="nama_lengkap"
                        class="form-input"
                        placeholder="Masukkan nama lengkap"
                        required>
                </div>

                <!-- nip -->
                <div class="form-field">
                    <label for="nip">
                        nip
                    </label>

                    <input
                        type="number"
                        id="nip"
                        name="nip"
                        class="form-input"
                        placeholder="Masukkan nip"
                        required>
                </div>

                <!-- Email -->
                <div class="form-field">
                    <label for="email">
                        Email
                    </label>

                    <input type="email" id="email" name="email" class="form-input" placeholder="Masukkan email" require>
                </div>

                <!-- No Telepon -->
                <div class="form-field">
                    <label for="no_hp">
                        NO TELEPON
                    </label>

                    <input type="no_hp" id="no_hp" name="no_hp" class="form-input" placeholder="Masukkan nomor telepon" require>
                </div>

                <!-- Pilih Bidang Peminatan -->
                <div class="form-field full">
                    <label for="pilih_bidang_peminatan">
                        Bidang Peminatan
                    </label>

                    <select
                        id="pilih_bidang_peminatan"
                        name="pilih_bidang_peminatan"
                        class="form-input "
                        required>
                        <option
                            value=""
                            disabled>
                            Pilih bidang peminatan
                        </option>

                        <?php foreach (($bidangPeminatan ?? []) as $bp): ?>
                            <option
                                value="<?= htmlspecialchars($bp) ?>">
                                <?= htmlspecialchars($bp) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

            </div>
        </section>

        <!-- Action Buttons -->
        <div class="form-actions">

            <a
                href="<?= BASE_URL ?>/manajemen-akun-dosen-pembimbing"
                class="btn-secondary">
                Batal
            </a>

            <button type="submit" class="btn-primary">
                Buat
            </button>

        </div>
    </form>

</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>