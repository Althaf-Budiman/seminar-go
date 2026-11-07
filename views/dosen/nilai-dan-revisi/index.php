<?php require_once __DIR__ . '/../../layout/header.php'; ?>


<div class="dashboard-container">

    <!-- Welcome Banner -->
    <div class="content-card">
        <div class="card-header">
            <h2>Nilai dan Revisi</h2>
            <span class="badge primary">Semester Ganjil 2026/2027</span>
        </div>
    </div>

    <div class="content-card">
        <div class="card-header">
            <h2>Daftar Mahasiswa</h2>
        </div>
        <div class="jadwal-toolbar">
            <div class="documents-search">
                <i class="bi bi-search"></i>
                <input type="text" id="jadwalSearch" placeholder="Cari nama atau NIM mahasiswa">
            </div>
        </div>


        <div class="grid">
            <?php foreach ($mahasiswa as $mhs) : ?>
                <div class="mahasiswa-card" style="margin-top: 1rem;">
                    <img src="<?= htmlspecialchars($mhs['foto']) ?>" alt="foto <?= htmlspecialchars($mhs['nama']) ?>" class="mahasiswa-avatar">
                    <h3 class="border-b"><?= htmlspecialchars($mhs['nama']) ?></h3>
                    <a class="btn-link" href="<?= BASE_URL ?>/nilai-dan-revisi/<?= (int) $mhs['id'] ?>">
                        Lihat Rekap <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="form-actions">
            <a href="<?= BASE_URL ?>/nilai-dan-revisi/tambah" class="btn btn-primary">Tambah Nilai Sidang Skripsi</a>
        </div>
    </div>

</div>

<?php require_once __DIR__ . '/../../layout/footer.php'; ?>