
<?php require_once __DIR__ . '/../layout/header.php'; ?>

<div class="dashboard-container">

    <!-- Statistik Revisi -->
    <div class="stats">
        <div class="stat-card">
            <span class="stat-label">Total Catatan</span>
            <strong class="stat-value">
                <?= (int) $statistik['total'] ?>
            </strong>
            <p>Dari seluruh dewan penguji</p>
        </div>

        <div class="stat-card">
            <span class="stat-label">Selesai</span>
            <strong class="stat-value success">
                <?= (int) $statistik['selesai'] ?>
            </strong>
            <p>Sudah diperbaiki</p>
        </div>

        <div class="stat-card">
            <span class="stat-label">Batas Revisi</span>
            <strong class="stat-value warning">
                <?= htmlspecialchars($statistik['batas']) ?>
            </strong>
            <p><?= htmlspecialchars($statistik['sisaWaktu']) ?></p>
        </div>
    </div>

    <!-- Daftar Catatan Revisi -->
    <div class="content-card">
        <div class="card-header border-b">
            <h2>Daftar Catatan Revisi</h2>
            <span class="badge warning sm">
                <?= (int) $statistik['belumSelesai'] ?> belum selesai
            </span>
        </div>

        <div class="list list-lg">
            <?php foreach ($revisi as $item): ?>
                <div class="list-item <?= htmlspecialchars($item['state']) ?>">
                    <div class="list-item-left">
                        <span class="list-item-num">
                            <?= (int) $item['nomor'] ?>
                        </span>
                        <h3><?= htmlspecialchars($item['judul']) ?></h3>
                    </div>

                    <span class="badge <?= htmlspecialchars($item['badgeClass']) ?> sm">
                        <?= htmlspecialchars($item['badge']) ?>
                    </span>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Unggah Lembar Revisi -->
    <div class="content-card">
        <div class="card-header border-b">
            <h2>Unggah Lembar Revisi</h2>
        </div>

        <form id="formUnggahRevisi" enctype="multipart/form-data">
            <label for="fileRevisi" class="upload-area">
                <strong id="namaFileRevisi">
                    Seret berkas ke sini atau pilih dari perangkat
                </strong>
                <span class="btn-primary">Pilih Berkas</span>
            </label>

            <input
                type="file"
                id="fileRevisi"
                name="file_revisi"
                accept=".pdf,.doc,.docx"
                hidden
            >
        </form>
    </div>

    <!-- Persetujuan Revisi -->
    <div class="content-card">
        <div class="card-header border-b">
            <h2>Persetujuan Revisi</h2>
        </div>

        <div class="list list-lg">
            <?php foreach ($persetujuan as $item): ?>
                <div class="list-item locked">
                    <div class="list-item-left">
                        <span class="list-item-num">
                            <?= htmlspecialchars($item['inisial']) ?>
                        </span>
                        <h3><?= htmlspecialchars($item['nama']) ?></h3>
                    </div>

                    <span class="badge neutral sm">
                        <?= htmlspecialchars($item['status']) ?>
                    </span>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Aksi -->
    <div class="form-actions">
        <button type="button" class="btn-primary" id="btnKirimRevisi">
            Kirim Revisi untuk Persetujuan
        </button>
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const input = document.getElementById('fileRevisi');
    const namaFile = document.getElementById('namaFileRevisi');
    const area = document.querySelector('.upload-area');

    input.addEventListener('change', () => {
        namaFile.textContent = input.files.length
            ? input.files[0].name
            : 'Seret berkas ke sini atau pilih dari perangkat';
    });

    area.addEventListener('dragover', (event) => {
        event.preventDefault();
    });

    area.addEventListener('drop', (event) => {
        event.preventDefault();

        if (event.dataTransfer.files.length) {
            const file = event.dataTransfer.files[0];
            const allowedExtensions = ['pdf', 'doc', 'docx'];
            const extension = file.name.split('.').pop().toLowerCase();

            if (!allowedExtensions.includes(extension)) {
                alert('Format berkas harus PDF, DOC, atau DOCX.');
                return;
            }

            const transfer = new DataTransfer();
            transfer.items.add(file);
            input.files = transfer.files;
            namaFile.textContent = file.name;
        }
    });

    document.getElementById('btnKirimRevisi').addEventListener('click', () => {
        if (!input.files.length) {
            alert('Silakan pilih lembar revisi terlebih dahulu.');
            input.click();
            return;
        }

        alert('Berkas siap dikirim. Proses penyimpanan perlu dihubungkan ke backend.');
    });
});
</script>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
