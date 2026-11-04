<?php
require_once __DIR__ . '/../layout/header.php';

?>

<div>
    <form
        action="<?= BASE_URL ?>/manajemen-akun/store"
        method="POST">
        <!-- Card Data Topik Penelitian -->
        <section class="content-card">

            <div class="card-header">
                <h2>Tambah Akun</h2>
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

                <!-- NIM -->
                <div class="form-field">
                    <label for="nim">
                        NIM
                    </label>

                    <input
                        type="number"
                        id="nim"
                        name="nim"
                        class="form-input"
                        placeholder="Masukkan NIM"
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

                <!-- Pilih Prodi -->
                <div class="form-field">
                    <label for="pilih_kelas">
                        PILIH KELAS
                    </label>

                    <select
                        id="pilih_prodi"
                        name="pilih_prodi"
                        class="form-input "
                        required>
                        <option
                            value=""
                            disabled>
                            Pilih kelas
                        </option>

                        <?php foreach (($kelas ?? []) as $kls): ?>
                            <option
                                value="<?= htmlspecialchars($kls) ?>">
                                <?= htmlspecialchars($kls) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Pilih Kelas -->
                <div class="form-field">
                    <label for="pilih_kelas">
                        PILIH PRODI
                    </label>

                    <select
                        id="pilih_kelas"
                        name="pilih_kelas"
                        class="form-input "
                        required>
                        <option
                            value=""
                            disabled>
                            Pilih kelas
                        </option>

                        <?php foreach (($kelas ?? []) as $kls): ?>
                            <option
                                value="<?= htmlspecialchars($kls) ?>">
                                <?= htmlspecialchars($kls) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Pilih Tahun Akademik -->
                <div class="form-field full">
                    <label for="pilih_tahun_akademik">
                        PILIH TAHUN AKADEMIK
                    </label>

                    <select
                        id="pilih_tahun_akademik"
                        name="pilih_tahun_akademik"
                        class="form-input "
                        required>
                        <option
                            value=""
                            disabled>
                            Pilih tahun akademik
                        </option>

                        <?php foreach (($tahunAkademik ?? []) as $ta): ?>
                            <option
                                value="<?= htmlspecialchars($ta) ?>">
                                <?= htmlspecialchars($ta) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

            </div>
        </section>

        <!-- Action Buttons -->
        <div class="form-actions">

            <a
                href="<?= BASE_URL ?>/manajemen-akun-mahasiswa"
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