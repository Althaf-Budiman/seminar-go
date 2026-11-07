<?php require_once __DIR__ . '/../../layout/header.php'; ?>

<?php
$mahasiswaDetail = $mahasiswaDetail ?? [];
$nilai = $nilai ?? [];
$catatanRevisi = $catatanRevisi ?? '';
$mode = $mode ?? 'create';

$readOnly = $mode === 'detail';
$isEdit = $mode === 'edit';
$mahasiswaId = (int) ($mahasiswaDetail['id'] ?? 0);

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

$formatRange = static fn ($value) => rtrim(rtrim(number_format((float) $value, 1, ',', '.'), '0'), ',');
$formatScore = static fn ($value) => number_format((float) $value, 2, ',', '.');

$subtotal = [];
$nilaiTotal = 0;
$allComplete = true;

foreach ($rubrik as $kode => $kategori) {
    $subtotal[$kode] = 0;
    $categoryComplete = true;

    foreach ($kategori['items'] as $itemKode => $item) {
        $value = $nilai[$itemKode] ?? '';

        if ($value === '' || !is_numeric($value)) {
            $categoryComplete = false;
            $allComplete = false;
            continue;
        }

        $value = (float) $value;

        if ($value < $item['min'] || $value > $item['max']) {
            $categoryComplete = false;
            $allComplete = false;
            continue;
        }

        $subtotal[$kode] += $value;
    }

    if (!$categoryComplete) {
        $subtotal[$kode] = null;
    } else {
        $nilaiTotal += $subtotal[$kode];
    }
}

if (!$allComplete) {
    $nilaiTotal = null;
}

$fotoUrl = !empty($mahasiswaDetail['foto'])
    ? BASE_URL . '/' . ltrim($mahasiswaDetail['foto'], '/')
    : null;

$formAction = match ($mode) {
    'detail' => BASE_URL . '/nilai-dan-revisi/permanen/' . $mahasiswaId,
    'edit' => BASE_URL . '/nilai-dan-revisi/update/' . $mahasiswaId,
    default => BASE_URL . '/nilai-dan-revisi/store',
};
?>

<div class="dashboard-container nilai-skripsi-page">

    <?php if ($readOnly) : ?>
        <h2 class="nilai-page-title">Rekap Mahasiswa</h2>
    <?php elseif ($isEdit) : ?>
        <h2 class="nilai-page-title">Edit Nilai Skripsi</h2>
    <?php else : ?>
        <h2 class="nilai-page-title">Tambah Nilai Skripsi</h2>
    <?php endif; ?>

    <form action="<?= htmlspecialchars($formAction) ?>" method="POST" id="formNilaiSkripsi" class="nilai-skripsi-form" style="display: flex; flex-direction: column; gap: 1rem;">
        <input type="hidden" name="mahasiswa_id" value="<?= $mahasiswaId ?>">

        <!-- Data Mahasiswa -->
        <section class="content-card">
            <?php if ($readOnly) : ?>
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <div style="display: flex; flex-direction: column; gap: 10px;">
                        <span class="nilai-overline">Mahasiswa</span>
                        <h2><?= htmlspecialchars($mahasiswaDetail['nama'] ?? '-') ?></h2>
                        <div style="display: flex; gap: 12px; font-size: 14px;">
                            <span>NIM&nbsp; <?= htmlspecialchars($mahasiswaDetail['nim'] ?? '-') ?></span>
                            <span>Kelas&nbsp; <?= htmlspecialchars($mahasiswaDetail['kelas'] ?? '-') ?></span>
                            <span><?= htmlspecialchars($mahasiswaDetail['program_studi'] ?? '-') ?></span>
                        </div>
                    </div>
                    <div class="profile-picture nilai-mahasiswa-avatar">
                        <?php if ($fotoUrl) : ?>
                            <img src="<?= htmlspecialchars($fotoUrl, ENT_QUOTES) ?>" alt="Foto mahasiswa">
                        <?php else : ?>
                            <i class="bi bi-person"></i>
                        <?php endif; ?>
                    </div>
                </div>
            <?php else : ?>
                <div class="card-header">
                    <h2>Data Mahasiswa</h2>
                </div>
                <div class="profile-picture nilai-mahasiswa-avatar" style="margin-top: 16px;">
                    <?php if ($fotoUrl) : ?>
                        <img src="<?= htmlspecialchars($fotoUrl, ENT_QUOTES) ?>" alt="Foto mahasiswa">
                    <?php else : ?>
                        <i class="bi bi-person"></i>
                    <?php endif; ?>
                </div>

                <div class="nilai-mahasiswa-layout">
                    <div class="form-grid nilai-mahasiswa-fields">
                        <div class="form-field">
                            <label for="namaMahasiswa">Nama Mahasiswa</label>
                            <input type="text" id="namaMahasiswa" class="form-input" value="<?= htmlspecialchars($mahasiswaDetail['nama'] ?? '') ?>" placeholder="Nama mahasiswa" readonly>
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
            <?php endif; ?>
        </section>

        <!-- Rubrik Penilaian -->
        <section class="content-card">
            <div class="card-header border-b">
                <h2>Rubrik Penilaian</h2>
                <?php if ($readOnly) : ?>
                    <span class="badge primary sm">Draf tersimpan</span>
                <?php else : ?>
                    <span class="badge primary sm" id="statusPenilaian" aria-live="polite">Belum Dinilai</span>
                <?php endif; ?>
            </div>

            <div class="documents-table-wrap rubrik-table-wrap">
                <table class="documents-table rubrik-table">
                    <thead>
                        <tr>
                            <th colspan="2">Parameter Uji</th>
                            <th>Rentang Nilai</th>
                            <th>Perolehan Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rubrik as $kode => $kategori) : ?>
                            <tr class="rubrik-category-row">
                                <td colspan="4">
                                    <span class="rubrik-category-code"><?= $kode ?></span>
                                    <?= htmlspecialchars($kategori['kategori']) ?>
                                </td>
                            </tr>

                            <?php foreach ($kategori['items'] as $itemKode => $item) : ?>
                                <?php $value = $nilai[$itemKode] ?? ''; ?>
                                <tr>
                                    <td class="td-no rubrik-code"><?= $itemKode ?></td>
                                    <td><?= htmlspecialchars($item['label']) ?></td>
                                    <td class="rubrik-range">
                                        <?= $formatRange($item['min']) ?> &ndash; <?= $formatRange($item['max']) ?>
                                    </td>
                                    <td class="rubrik-score-cell">
                                        <input type="number" class="form-input nilai-input" name="nilai[<?= $itemKode ?>]" data-kategori="<?= $kode ?>" data-min="<?= $item['min'] ?>" data-max="<?= $item['max'] ?>" min="<?= $item['min'] ?>" max="<?= $item['max'] ?>" step="0.1" value="<?= htmlspecialchars((string) $value) ?>" placeholder="—" <?= $readOnly ? 'readonly' : 'required' ?>>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                            <tr class="rubrik-subtotal-row">
                                <td colspan="2"><?= htmlspecialchars($kategori['namaTotal']) ?></td>
                                <td class="rubrik-equation">
                                    N<?= $kode ?> = <?= implode(' + ', array_keys($kategori['items'])) ?>
                                </td>
                                <td class="rubrik-subtotal-value" id="total<?= $kode ?>">
                                    <?= $subtotal[$kode] !== null ? $formatScore($subtotal[$kode]) : '—' ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="rubrik-total-card">
                <div>
                    <strong>Nilai Total</strong>
                    <p id="rumusNilaiTotal">NA + NB + NC</p>
                </div>
                <strong id="nilaiTotal">
                    <?= $nilaiTotal !== null ? $formatScore($nilaiTotal) : '—' ?>
                </strong>
            </div>
        </section>

        <!-- Revisi Skripsi -->
        <section class="content-card">
            <div class="card-header">
                <h2><?= $readOnly ? 'Revisi Skripsi Mahasiswa' : 'Masukkan Revisi Skripsi Mahasiswa' ?></h2>
            </div>

            <?php if ($readOnly) : ?>
                <div class="nilai-revisi-content">
                    <?= nl2br(htmlspecialchars($catatanRevisi)) ?>
                </div>
            <?php else : ?>
                <div class="form-field nilai-revisi-field">
                    <textarea class="form-input" name="catatan_revisi" rows="4" placeholder="Tuliskan catatan revisi skripsi mahasiswa di sini..."><?= htmlspecialchars($catatanRevisi) ?></textarea>
                </div>
            <?php endif; ?>
        </section>

        <!-- Tombol Aksi -->
        <?php if ($readOnly) : ?>
            <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 1rem;">
                <div class="header-actions">
                    <a href="<?= BASE_URL ?>/nilai-dan-revisi" class="btn-secondary">Back</a>
                    <a href="<?= BASE_URL ?>/nilai-dan-revisi/edit/<?= $mahasiswaId ?>" class="btn-secondary">Edit</a>
                </div>
                <button type="submit" class="btn-primary">Simpan Permanen</button>
            </div>
        <?php elseif ($isEdit) : ?>
            <div class="form-actions">
                <a href="<?= BASE_URL ?>/nilai-dan-revisi/detail/<?= $mahasiswaId ?>" class="btn-secondary">Batal</a>
                <button type="submit" class="btn-primary">Simpan Perubahan</button>
            </div>
        <?php else : ?>
            <div class="form-actions">
                <button type="reset" class="btn-secondary">Reset</button>
                <button type="submit" class="btn-primary">Simpan</button>
            </div>
        <?php endif; ?>
    </form>
</div>

<?php if (!$readOnly) : ?>
    <script src="<?= BASE_URL ?>/scripts/nilai-skripsi.js" defer></script>
<?php endif; ?>

<?php require_once __DIR__ . '/../../layout/footer.php'; ?>