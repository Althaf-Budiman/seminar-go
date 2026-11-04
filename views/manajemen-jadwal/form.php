<?php
require_once __DIR__ . '/../layout/header.php';
?>

<style>
.time-range-group {
    display: flex !important;
    flex-direction: row !important;
    align-items: center !important;
    gap: 0.5rem !important;
    width: auto !important;
}

.time-range-group .time-box {
    width: 54px !important;
    min-width: 54px !important;
    max-width: 54px !important;
    height: 40px !important;
    padding: 0.4rem 0.2rem !important;
    text-align: center !important;
    font-size: 0.875rem !important;
    color: var(--text-primary, #0f172a) !important;
    background-color: var(--bg-surface, #ffffff) !important;
    border: 1px solid #e2e8f0 !important;
    border-radius: var(--radius-md, 8px) !important;
    box-sizing: border-box !important;
    transition: border-color 0.15s ease, box-shadow 0.15s ease !important;
    flex: 0 0 54px !important;
}

.time-range-group .time-box::placeholder {
    color: #94a3b8 !important;
}

.time-range-group .time-box:focus {
    outline: none !important;
    border-color: #93c5fd !important;
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.08) !important;
}

.time-range-group .time-separator {
    font-size: 0.95rem !important;
    font-weight: 600 !important;
    color: #64748b !important;
    user-select: none !important;
}

.time-range-group .time-delimiter {
    font-size: 0.85rem !important;
    color: #64748b !important;
    margin: 0 0.35rem !important;
    user-select: none !important;
}

.select-stack {
    display: flex !important;
    flex-direction: column !important;
    gap: 0.75rem !important;
}
</style>

<div>
    <form
        action="<?= BASE_URL ?>/manajemen-jadwal/store"
        method="POST"
        id="formTambahKegiatan">
        <section class="content-card">

            <div class="card-header">
                <h2>Tambah Kegiatan</h2>
            </div>

            <div class="form-grid">

                <!-- Waktu -->
                <div class="form-field">
                    <label for="jam_mulai">
                        WAKTU
                    </label>

                    <div class="time-range-group">
                        <input
                            type="text"
                            inputmode="numeric"
                            maxlength="2"
                            id="jam_mulai"
                            name="jam_mulai"
                            class="form-input time-box"
                            placeholder="00"
                            autocomplete="off"
                            required>
                        <span class="time-separator">:</span>
                        <input
                            type="text"
                            inputmode="numeric"
                            maxlength="2"
                            id="menit_mulai"
                            name="menit_mulai"
                            class="form-input time-box"
                            placeholder="00"
                            autocomplete="off"
                            required>
                        <span class="time-delimiter">hingga</span>
                        <input
                            type="text"
                            inputmode="numeric"
                            maxlength="2"
                            id="jam_selesai"
                            name="jam_selesai"
                            class="form-input time-box"
                            placeholder="00"
                            autocomplete="off"
                            required>
                        <span class="time-separator">:</span>
                        <input
                            type="text"
                            inputmode="numeric"
                            maxlength="2"
                            id="menit_selesai"
                            name="menit_selesai"
                            class="form-input time-box"
                            placeholder="00"
                            autocomplete="off"
                            required>
                    </div>
                </div>

                <!-- Tanggal -->
                <div class="form-field">
                    <label for="tanggal">
                        TANGGAL
                    </label>

                    <input
                        type="date"
                        id="tanggal"
                        name="tanggal"
                        class="form-input"
                        placeholder="Pilih Tanggal"
                        required>
                </div>

                <!-- Tempat -->
                <div class="form-field">
                    <label for="tempat">
                        TEMPAT
                    </label>

                    <input
                        type="text"
                        id="tempat"
                        name="tempat"
                        class="form-input"
                        placeholder="Masukkan tempat kegiatan"
                        required>
                </div>

                <!-- Nama Mahasiswa -->
                <div class="form-field">
                    <label for="nama_mahasiswa">
                        NAMA MAHASISWA
                    </label>

                    <input
                        type="text"
                        id="nama_mahasiswa"
                        name="nama_mahasiswa"
                        class="form-input"
                        placeholder="Masukkan nama mahasiswa"
                        value="<?= htmlspecialchars($namaMahasiswa ?? $_GET['nama'] ?? '') ?>"
                        required>
                </div>

                <!-- Pilih Dosen Pembimbing -->
                <div class="form-field">
                    <label for="pilih_dosen_pembimbing">
                        NAMA DOSEN PEMBIMBING
                    </label>

                    <select
                        id="pilih_dosen_pembimbing"
                        name="pilih_dosen_pembimbing"
                        class="form-input"
                        required>
                        <option
                            value=""
                            disabled selected>
                            Pilih dosen pembimbing
                        </option>

                        <?php foreach (($dosenPembimbing ?? []) as $dosbing): ?>
                            <option
                                value="<?= htmlspecialchars($dosbing) ?>">
                                <?= htmlspecialchars($dosbing) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Pilih Dosen Penguji -->
                <div class="form-field">
                    <label for="pilih_dosen_penguji_1">
                        NAMA DOSEN PENGUJI
                    </label>

                    <div class="select-stack">
                        <select
                            id="pilih_dosen_penguji_1"
                            name="pilih_dosen_penguji[]"
                            class="form-input"
                            required>
                            <option
                                value=""
                                disabled selected>
                                Pilih dosen penguji 1
                            </option>

                            <?php foreach (($dosenPenguji ?? []) as $penguji): ?>
                                <option
                                    value="<?= htmlspecialchars($penguji) ?>">
                                    <?= htmlspecialchars($penguji) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>

                        <select
                            id="pilih_dosen_penguji_2"
                            name="pilih_dosen_penguji[]"
                            class="form-input"
                            required>
                            <option
                                value=""
                                disabled selected>
                                Pilih dosen penguji 2
                            </option>

                            <?php foreach (($dosenPenguji ?? []) as $penguji): ?>
                                <option
                                    value="<?= htmlspecialchars($penguji) ?>">
                                    <?= htmlspecialchars($penguji) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>

                        <select
                            id="pilih_dosen_penguji_3"
                            name="pilih_dosen_penguji[]"
                            class="form-input"
                            required>
                            <option
                                value=""
                                disabled selected>
                                Pilih dosen penguji 3
                            </option>

                            <?php foreach (($dosenPenguji ?? []) as $penguji): ?>
                                <option
                                    value="<?= htmlspecialchars($penguji) ?>">
                                    <?= htmlspecialchars($penguji) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

            </div>
        </section>

        <!-- Action Buttons -->
        <div class="form-actions" style="margin-top: 1.25rem;">
            <a
                href="<?= BASE_URL ?>/manajemen-jadwal"
                class="btn-secondary">
                Batal
            </a>

            <button type="submit" class="btn-primary">
                Simpan
            </button>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const timeInputs = [
        document.getElementById('jam_mulai'),
        document.getElementById('menit_mulai'),
        document.getElementById('jam_selesai'),
        document.getElementById('menit_selesai')
    ].filter(Boolean);

    timeInputs.forEach((input, idx) => {
        // Hanya izinkan angka
        input.addEventListener('input', function () {
            this.value = this.value.replace(/\D/g, '');

            const isHour = idx === 0 || idx === 2;
            const maxVal = isHour ? 23 : 59;

            if (this.value.length >= 2) {
                let num = parseInt(this.value, 10);
                if (num > maxVal) {
                    this.value = String(maxVal);
                }
                // Otomatis pindah ke input berikutnya jika 2 digit sudah diisi
                if (idx < timeInputs.length - 1) {
                    timeInputs[idx + 1].focus();
                    timeInputs[idx + 1].select();
                }
            }
        });

        // Format padding 0 saat keluar dari input (blur)
        input.addEventListener('blur', function () {
            if (this.value.length === 1) {
                this.value = '0' + this.value;
            }
        });

        // Dukung tombol Backspace untuk pindah mundur jika kosong
        input.addEventListener('keydown', function (e) {
            if (e.key === 'Backspace' && this.value === '' && idx > 0) {
                timeInputs[idx - 1].focus();
            }
        });
    });
});
</script>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
