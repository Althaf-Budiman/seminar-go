<?php
require_once __DIR__ . '/../../layout/header.php';

$mahasiswa = $mahasiswa ?? [];
$programStudi = $programStudi ?? [];
$kelas = $kelas ?? [];
$topikSkripsi = $topikSkripsi ?? [];
$dosen = $dosen ?? [];

$esc = static fn ($value) => htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
?>

<form action="<?= BASE_URL ?>/formulir-pengajuan-topik" method="POST" id="formulirTopikForm" style="display: flex; flex-direction: column; gap: 1.5rem;">

    <!-- Data Mahasiswa -->
    <section class="content-card">
        <div class="card-header border-b">
            <h2>Data Mahasiswa</h2>
        </div>

        <div class="form-grid">
            <div class="form-field">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-input" placeholder="Masukkan email mahasiswa" value="<?= $esc($mahasiswa['email'] ?? '') ?>" required>
            </div>

            <div class="form-field">
                <label for="no_hp">No. Kontak Mahasiswa</label>
                <input type="tel" id="no_hp" name="no_hp" class="form-input" placeholder="Masukkan nomor WhatsApp aktif" value="<?= $esc($mahasiswa['no_hp'] ?? '') ?>" required>
            </div>

            <div class="form-field">
                <label for="program_studi">Program Studi</label>
                <select id="program_studi" name="program_studi" class="form-input" required>
                    <option value="" disabled selected>Pilih program studi</option>
                    <?php foreach ($programStudi as $prodi) : ?>
                        <option value="<?= $esc($prodi) ?>" <?= ($mahasiswa['program_studi'] ?? '') === $prodi ? 'selected' : '' ?>>
                            <?= $esc($prodi) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-field">
                <label for="kelas">Kelas</label>
                <select id="kelas" name="kelas" class="form-input" required>
                    <option value="" disabled selected>Pilih kelas</option>
                    <?php foreach ($kelas as $opsiKelas) : ?>
                        <option value="<?= $esc($opsiKelas) ?>" <?= ($mahasiswa['kelas'] ?? '') === $opsiKelas ? 'selected' : '' ?>>
                            <?= $esc($opsiKelas) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-field">
                <label for="nama_orangtua">Nama Orang Tua / Wali</label>
                <input type="text" id="nama_orangtua" name="nama_orangtua" class="form-input" placeholder="Masukkan nama orang tua atau wali" value="<?= $esc($mahasiswa['nama_orangtua'] ?? '') ?>" required>
            </div>

            <div class="form-field">
                <label for="no_hp_orangtua">No. Kontak Orang Tua / Wali</label>
                <input type="tel" id="no_hp_orangtua" name="no_hp_orangtua" class="form-input" placeholder="Masukkan nomor orang tua atau wali" value="<?= $esc($mahasiswa['no_hp_orangtua'] ?? '') ?>" required>
            </div>

            <div class="form-field">
                <label for="jenis_pengerjaan">Jenis Pengerjaan</label>
                <select id="jenis_pengerjaan" name="jenis_pengerjaan" class="form-input" required>
                    <option value="" disabled selected>Pilih individu atau kelompok</option>
                    <option value="Individu">Individu</option>
                    <option value="Kelompok">Kelompok</option>
                </select>
            </div>

            <div class="form-field group-only" hidden>
                <label for="nama_kelompok">Nama Kelompok</label>
                <input type="text" id="nama_kelompok" name="nama_kelompok" class="form-input" placeholder="Masukkan nama kelompok">
            </div>

            <div class="form-field group-only" hidden>
                <label for="jumlah_anggota">Jumlah Anggota</label>
                <input type="number" id="jumlah_anggota" name="jumlah_anggota" class="form-input" placeholder="Masukkan jumlah anggota" min="2">
            </div>

            <div class="form-field group-only" hidden>
                <label for="nama_anggota">Nama Anggota / Partner</label>
                <input type="text" id="nama_anggota" name="nama_anggota" class="form-input" placeholder="Pisahkan dengan tanda koma & ditulis dengan huruf KAPITAL">
            </div>
        </div>
    </section>

    <!-- Data Topik -->
    <section class="content-card">
        <div class="card-header border-b">
            <h2>Data Topik</h2>
        </div>

        <div class="form-grid">
            <div class="form-field">
                <label for="jenis_topik">Jenis Topik</label>
                <select id="jenis_topik" name="jenis_topik" class="form-input" required>
                    <option value="" disabled selected>Pilih topik dosen atau ide mandiri</option>
                    <option value="Topik Dosen">Topik Dosen</option>
                    <option value="Ide Mandiri">Ide Mandiri</option>
                </select>
            </div>

            <div class="form-field">
                <label for="topik">Topik</label>
                <select id="topik" name="topik" class="form-input" required>
                    <option value="" disabled selected>Pilih topik skripsi</option>
                    <?php foreach ($topikSkripsi as $opsiTopik) : ?>
                        <option value="<?= $esc($opsiTopik) ?>"><?= $esc($opsiTopik) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-field full">
                <label for="judul">Judul Skripsi</label>
                <input type="text" id="judul" name="judul" class="form-input" placeholder="Masukkan judul skripsi" required>
            </div>

            <div class="form-field full">
                <label for="sub_judul">Sub Judul</label>
                <input type="text" id="sub_judul" name="sub_judul" class="form-input" placeholder='Masukkan sub judul (isi "-" jika tidak ada)'>
            </div>

            <div class="form-field">
                <label for="studi_kasus">Studi Kasus</label>
                <input type="text" id="studi_kasus" name="studi_kasus" class="form-input" placeholder='Masukkan studi kasus (isi "-" jika tidak ada)'>
            </div>

            <div class="form-field">
                <label for="biaya">Biaya</label>
                <input type="number" id="biaya" name="biaya" class="form-input" placeholder="Masukkan perkiraan biaya" min="0">
            </div>

            <div class="form-field full">
                <label for="abstrak">Abstrak / Ringkasan Skripsi</label>
                <textarea id="abstrak" name="abstrak" class="form-input" placeholder="Tuliskan ringkasan skripsi yang akan dikerjakan" rows="5" required></textarea>
            </div>

            <div class="form-field full">
                <label for="referensi">Sumber Referensi</label>
                <textarea id="referensi" name="referensi" class="form-input" placeholder="Minimal 3 artikel jurnal nasional dan 2 artikel internasional terindeks Scopus (contoh: IEEE Xplore, Elsevier), pisahkan tiap referensi dengan tanda ;" rows="4" required></textarea>
            </div>
        </div>
    </section>

    <!-- Calon Dosen Pembimbing -->
    <section class="content-card">
        <div class="card-header border-b">
            <h2>Calon Dosen Pembimbing</h2>
        </div>

        <div style="display: flex; flex-direction: column; gap: 1rem; margin-top: 16px;">
            <?php for ($i = 1; $i <= 3; $i++) : ?>
                <div class="form-field">
                    <label for="dosen_<?= $i ?>">Prioritas <?= $i ?></label>
                    <select id="dosen_<?= $i ?>" name="dosen_prioritas[]" class="form-input dosen-prioritas" required>
                        <option value="" disabled selected>
                            <?= $i === 1 ? 'Pilih calon dosen pembimbing 1' : "Pilih calon dosen pembimbing $i" ?>
                        </option>
                        <?php foreach ($dosen as $opsiDosen) : ?>
                            <option value="<?= $esc($opsiDosen['dosen_id'] ?? $opsiDosen) ?>">
                                <?= $esc($opsiDosen['nama_lengkap'] ?? $opsiDosen) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            <?php endfor; ?>
        </div>
    </section>

    <div class="form-actions">
        <a href="<?= BASE_URL ?>/pengajuan-dosen-pembimbing" class="btn-secondary">Batal</a>
        <a href="<?= BASE_URL ?>/pengajuan-dosen-pembimbing" class="btn-secondary">List Dosen Pembimbing</a>
        <button type="submit" class="btn-primary">Kirim Pengajuan</button>
    </div>
</form>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const jenisPengerjaan = document.getElementById('jenis_pengerjaan');
        const groupFields = document.querySelectorAll('.group-only');
        const groupInputs = document.querySelectorAll('.group-only input');

        function toggleGroupFields() {
            const isGroup = jenisPengerjaan.value === 'Kelompok';
            groupFields.forEach(field => field.hidden = !isGroup);
            groupInputs.forEach(input => input.required = isGroup);
        }

        jenisPengerjaan.addEventListener('change', toggleGroupFields);
        toggleGroupFields();

        const dosenSelects = [...document.querySelectorAll('.dosen-prioritas')];

        function updateDosenOptions() {
            const selectedValues = dosenSelects.map(select => select.value).filter(Boolean);

            dosenSelects.forEach(select => {
                [...select.options].forEach(option => {
                    if (!option.value) return;
                    option.disabled = selectedValues.includes(option.value) && option.value !== select.value;
                });
            });
        }

        dosenSelects.forEach(select => select.addEventListener('change', updateDosenOptions));
        updateDosenOptions();
    });
</script>

<?php require_once __DIR__ . '/../../layout/footer.php'; ?>