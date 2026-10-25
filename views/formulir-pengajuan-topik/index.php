
<?php
require_once __DIR__ . '/../layout/header.php';

$old = $_POST ?? [];
$judul = $old['judul'] ?? '';
$topik = $old['topik'] ?? '';
$bidangTerpilih = $old['bidang'] ?? '';
$ringkasan = $old['ringkasan'] ?? '';
?>

<div class="formulir-topik-page">

    <form
        action="<?= BASE_URL ?>/formulir-pengajuan-topik"
        method="POST"
        id="formulirTopikForm"
    >
        <!-- Card Data Topik Penelitian -->
        <section class="content-card topik-form-card">

            <div class="card-header topik-form-header">
                <h2>Data Topik Penelitian</h2>
            </div>

            <div class="form-grid topik-form-grid">

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
                        value="<?= htmlspecialchars($judul) ?>"
                        required
                    >
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
                        value="<?= htmlspecialchars($topik) ?>"
                        required
                    >
                </div>

                <!-- Bidang Peminatan -->
                <div class="form-field">
                    <label for="bidang">
                        Bidang Peminatan
                    </label>

                    <select
                        id="bidang"
                        name="bidang"
                        class="form-input topik-select"
                        required
                    >
                        <option
                            value=""
                            disabled
                            <?= $bidangTerpilih === '' ? 'selected' : '' ?>
                        >
                            Pilih bidang peminatan
                        </option>

                        <?php foreach (($bidang ?? []) as $opsiBidang): ?>
                            <option
                                value="<?= htmlspecialchars($opsiBidang) ?>"
                                <?= $bidangTerpilih === $opsiBidang ? 'selected' : '' ?>
                            >
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
                        class="form-input topik-textarea"
                        placeholder="Tuliskan ringkasan latar belakang, tujuan, dan metode penelitian"
                        required
                    ><?= htmlspecialchars($ringkasan) ?></textarea>
                </div>

            </div>
        </section>

        <!-- Action Buttons -->
        <div class="form-actions topik-form-actions">

            <a
                href="<?= BASE_URL ?>/pengajuan-dosen-pembimbing"
                class="btn-secondary"
            >
                Batal
            </a>

            <button type="submit" class="btn-primary">
                Kirim Pengajuan
            </button>

        </div>
    </form>

</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
