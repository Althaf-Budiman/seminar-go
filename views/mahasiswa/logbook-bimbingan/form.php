<?php
require_once __DIR__ . '/../../layout/header.php';

$program = $program ?? ($_GET['program'] ?? 'sempro');
$identitas = $identitas ?? [];
$esc = static fn ($value) => htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
?>

<form action="<?= BASE_URL ?>/bimbingan/store?program=<?= rawurlencode((string) $program) ?>" method="POST" style="display: flex; flex-direction: column; gap: 1.5rem;">
    <input type="hidden" name="program" value="<?= $esc($program) ?>">

    <!-- Identitas Logbook -->
    <section class="content-card">
        <div class="card-header border-b">
            <h2>Identitas Logbook</h2>
        </div>

        <div class="detail-list logbook-identity">
            <div class="detail-item-row">
                <div class="detail-item">
                    <label>Judul Skripsi</label>
                    <p><?= $esc($identitas['judul_skripsi'] ?? '—') ?></p>
                </div>
                <div class="detail-item">
                    <label>Sub Judul</label>
                    <p><?= $esc($identitas['sub_judul'] ?? '—') ?></p>
                </div>
            </div>

            <div class="detail-item-row">
                <div class="detail-item">
                    <label>Nama Mahasiswa</label>
                    <p><?= $esc($identitas['nama_mahasiswa'] ?? '—') ?></p>
                </div>
                <div class="detail-item">
                    <label>NIM</label>
                    <p><?= $esc($identitas['nim'] ?? '—') ?></p>
                </div>
            </div>

            <div class="detail-item-row">
                <div class="detail-item">
                    <label>Program Studi</label>
                    <p><?= $esc($identitas['program_studi'] ?? '—') ?></p>
                </div>
                <div class="detail-item">
                    <label>Tahun Akademik</label>
                    <p><?= $esc($identitas['tahun_akademik'] ?? '—') ?></p>
                </div>
            </div>
        </div>
    </section>

    <!-- Catatan Bimbingan -->
    <section class="content-card">
        <div class="card-header">
            <h2>Catatan Bimbingan</h2>
        </div>

        <div class="form-grid">
            <div class="form-field">
                <label for="tanggal">Hari / Tanggal Pencatatan</label>
                <input type="date" id="tanggal" name="tanggal" class="form-input" required>
            </div>

            <div class="form-field">
                <label for="tempat">Tempat</label>
                <input type="text" id="tempat" name="tempat" class="form-input" placeholder="Masukkan tempat bimbingan" required>
            </div>

            <div class="form-field full">
                <label for="uraian">Uraian</label>
                <textarea id="uraian" name="uraian" class="form-input" placeholder="Tuliskan poin penjelasan yang diperoleh saat bimbingan" rows="5" required></textarea>
            </div>

            <div class="form-field full">
                <label for="rencana_pencapaian">Rencana Pencapaian</label>
                <textarea id="rencana_pencapaian" name="rencana_pencapaian" class="form-input" placeholder="Tuliskan rencana untuk bimbingan berikutnya" rows="5" required></textarea>
            </div>

            <div class="form-field">
                <label for="tujuan">Tujuan</label>
                <input type="text" id="tujuan" name="tujuan" class="form-input" placeholder="Masukkan tujuan" required>
            </div>

            <div class="form-field">
                <label for="manfaat">Manfaat</label>
                <input type="text" id="manfaat" name="manfaat" class="form-input" placeholder="Masukkan manfaat" required>
            </div>

            <!-- Field Submission -->
            <!-- <div class="form-field full">
                <label>Field Submission</label>
                <div class="logbook-submission">
                    <div class="logbook-submission-row">
                        <i class="bi bi-text-left"></i>
                        <input type="text" name="submission_text" placeholder="Text">
                    </div>
                    <div class="logbook-submission-row">
                        <i class="bi bi-link-45deg"></i>
                        <input type="url" name="submission_link" placeholder="Type or paste a link">
                    </div>
                </div>
            </div> -->
           
        </div>
    </section>

    <!-- Action Buttons -->
    <div class="form-actions logbook-form-actions">
        <a href="<?= BASE_URL ?>/logbook-bimbingan?program=<?= rawurlencode((string) $program) ?>" class="btn-secondary">
            Batal
        </a>

        <button type="submit" class="btn-primary">
            Kirim Logbook
        </button>
    </div>
</form>

<?php require_once __DIR__ . '/../../layout/footer.php'; ?>