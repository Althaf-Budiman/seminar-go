<?php require_once __DIR__ . '/../../layout/header.php'; ?>

<?php
$mahasiswaDetail = $mahasiswaDetail ?? [];

$rubrik = [
    'A' => [
        'kategori' => 'Tata Tulis Laporan',
        'namaTotal' => 'Nilai Pengetahuan',
        'items' => [
            'A1' => ['label' => 'Kesesuaian dengan Sistematika Penulisan', 'min' => 4.5, 'max' => 10],
            'A2' => ['label' => 'Kesesuaian dengan isi laporan', 'min' => 4.5, 'max' => 15],
            'A3' => ['label' => 'Sesuai dengan format penulisan', 'min' => 4.5, 'max' => 10],
        ],
    ],
    'B' => [
        'kategori' => 'Keterampilan',
        'namaTotal' => 'Nilai Keterampilan',
        'items' => [
            'B1' => ['label' => 'Perancangan Alat/Program Aplikasi', 'min' => 4.5, 'max' => 15],
            'B2' => ['label' => 'Pembangunan Alat/Program Aplikasi', 'min' => 4.5, 'max' => 10],
            'B3' => ['label' => 'Pengujian Alat/Program Aplikasi', 'min' => 4.5, 'max' => 10],
            'B4' => ['label' => 'Pengoperasian Alat/Program Aplikasi', 'min' => 4.5, 'max' => 15],
        ],
    ],
    'C' => [
        'kategori' => 'Etika Kerja',
        'namaTotal' => 'Nilai Etika Kerja',
        'items' => [
            'C1' => ['label' => 'Komitmen terhadap jadwal bimbingan', 'min' => 1.5, 'max' => 4],
            'C2' => ['label' => 'Tanggung jawab', 'min' => 1.5, 'max' => 4],
            'C3' => ['label' => 'Kemampuan bekerjasama', 'min' => 1, 'max' => 3],
            'C4' => ['label' => 'Kepedulian terhadap ... Kerja / Standar Operasi Kerja*', 'min' => 1, 'max' => 4],
        ],
    ],
];

$formatRange = static function ($value) {
    return rtrim(rtrim(number_format((float) $value, 1, ',', '.'), '0'), ',');
};

$fotoUrl = !empty($mahasiswaDetail['foto'])
    ? BASE_URL . '/' . ltrim($mahasiswaDetail['foto'], '/')
    : null;
?>

<div class="dashboard-container">

    <h2>Tambah Nilai Skripsi</h2>

    <form action="<?= BASE_URL ?>/nilai-dan-revisi/store" method="POST" id="formNilaiSkripsi" style="display: flex; flex-direction: column; gap: 1rem;">

        <input type="hidden" name="mahasiswa_id" value="<?= (int) ($mahasiswaDetail['id'] ?? 0) ?>">

        <!-- Data Mahasiswa -->
        <section class="content-card">

            <div class="card-header">
                <h2>Data Mahasiswa</h2>
            </div>

            <div>
                <div style="margin-top: 16px;" class="profile-picture nilai-mahasiswa-avatar">
                    <?php if ($fotoUrl) : ?>
                        <img src="<?= htmlspecialchars($fotoUrl, ENT_QUOTES) ?>" alt="Foto <?= htmlspecialchars($mahasiswaDetail['nama'] ?? 'mahasiswa') ?>">
                    <?php else : ?>
                        <i class="bi bi-person"></i>
                    <?php endif; ?>
                </div>

                <div class="form-grid">

                    <div class="form-field">
                        <label for="namaMahasiswa">Nama Mahasiswa</label>
                        <input type="text" id="namaMahasiswa" class="form-input" value="<?= htmlspecialchars($mahasiswaDetail['nama'] ?? '') ?>" placeholder="Pilih mahasiswa" readonly>
                    </div>

                    <div class="form-field">
                        <label for="nimMahasiswa">NIM</label>
                        <input type="text" id="nimMahasiswa" class="form-input" value="<?= htmlspecialchars($mahasiswaDetail['nim'] ?? '') ?>" placeholder="Nomor induk mahasiswa" readonly>
                    </div>

                    <div class="form-field">
                        <label for="programStudi">Program Studi</label>
                        <input type="text" id="programStudi" class="form-input" value="<?= htmlspecialchars($mahasiswaDetail['program_studi'] ?? '') ?>" placeholder="Program studi mahasiswa" readonly>
                    </div>

                    <div class="form-field">
                        <label for="kelasMahasiswa">Kelas</label>
                        <input type="text" id="kelasMahasiswa" class="form-input" value="<?= htmlspecialchars($mahasiswaDetail['kelas'] ?? '') ?>" placeholder="Kelas mahasiswa" readonly>
                    </div>

                    <div class="form-field full">
                        <label for="judulSkripsi">Judul Skripsi</label>
                        <input type="text" id="judulSkripsi" class="form-input" value="<?= htmlspecialchars($mahasiswaDetail['judul_skripsi'] ?? '') ?>" placeholder="Judul skripsi mahasiswa" readonly>
                    </div>

                </div>

            </div>
        </section>

        <!-- Rubrik Penilaian -->
        <section class="content-card">

            <div class="card-header">
                <h2>Rubrik Penilaian</h2>

                <span class="badge primary sm" id="statusPenilaian" aria-live="polite">
                    Belum Dinilai
                </span>
            </div>

            <div class="documents-table-wrap rubrik-table-wrap">

                <table class="rubrik-table">
                    <thead>
                        <tr>
                            <th colspan="2">Parameter Uji</th>
                            <th>Rentang Nilai</th>
                            <th>Perolehan Nilai</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($rubrik as $kode => $kategori) : ?>

                            <!-- Kategori -->
                            <tr class="rubrik-category-row">
                                <td colspan="4">
                                    <span class="rubrik-category-code">
                                        <?= $kode ?>
                                    </span>

                                    <?= htmlspecialchars($kategori['kategori']) ?>
                                </td>
                            </tr>

                            <!-- Parameter penilaian -->
                            <?php foreach ($kategori['items'] as $itemKode => $item) : ?>
                                <tr>
                                    <td class="td-no rubrik-code">
                                        <?= $itemKode ?>
                                    </td>

                                    <td>
                                        <?= htmlspecialchars($item['label']) ?>
                                    </td>

                                    <td class="rubrik-range">
                                        <?= $formatRange($item['min']) ?>
                                        &ndash;
                                        <?= $formatRange($item['max']) ?>
                                    </td>

                                    <td class="rubrik-score-cell">
                                        <input type="number" class="form-input nilai-input" name="nilai[<?= $itemKode ?>]" data-kategori="<?= $kode ?>" data-min="<?= $item['min'] ?>" data-max="<?= $item['max'] ?>" min="<?= $item['min'] ?>" max="<?= $item['max'] ?>" step="0.1" placeholder="—" required>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                            <!-- Subtotal -->
                            <tr class="rubrik-subtotal-row">
                                <td colspan="2">
                                    <?= htmlspecialchars($kategori['namaTotal']) ?>
                                </td>

                                <td class="rubrik-equation">
                                    N<?= $kode ?> =
                                    <?= implode(' + ', array_keys($kategori['items'])) ?>
                                </td>

                                <td class="rubrik-subtotal-value" id="total<?= $kode ?>">
                                    —
                                </td>
                            </tr>

                        <?php endforeach; ?>
                    </tbody>
                </table>

            </div>

            <!-- Nilai Total -->
            <div class="rubrik-total-card">

                <div>
                    <strong>Nilai Total</strong>
                    <p>NA + NB + NC</p>
                </div>

                <strong id="nilaiTotal">—</strong>

            </div>

        </section>

        <!-- Catatan Revisi -->
        <section class="content-card">

            <div class="card-header">
                <h2>Masukkan Revisi Skripsi Mahasiswa</h2>
            </div>

            <div class="form-field nilai-revisi-field">
                <textarea class="form-input" name="catatan_revisi" rows="4" placeholder="Tuliskan catatan revisi skripsi mahasiswa di sini..."></textarea>
            </div>

        </section>

        <!-- Aksi -->
        <div class="form-actions ">

            <button type="reset" class="btn-secondary">
                Reset
            </button>

            <button type="submit" class="btn-primary">
                Simpan
            </button>

        </div>

    </form>

</div>

<script src="<?= BASE_URL ?>/scripts/nilai-skripsi.js" defer></script>

<?php require_once __DIR__ . '/../../layout/footer.php'; ?>