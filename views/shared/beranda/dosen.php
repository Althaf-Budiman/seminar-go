<?php require_once __DIR__ . '/../../layout/header.php'; ?>


<div class="dashboard-container">

    <!-- Welcome Banner -->
    <div class="content-card">
        <div class="card-header">
            <h2>Selamat Datang, <?= htmlspecialchars($dosenName) ?>!</h2>
        </div>
    </div>

    <?php if (($dosenRole ?? 'pembimbing') === 'pembimbing') : ?>
        <!-- =============================================================
             TAMPILAN DOSEN PEMBIMBING
             ============================================================= -->

        <!-- Menunggu Tinjauan -->
        <div class="content-card">
            <div class="card-header border-b">
                <h2>Menunggu Tinjauan</h2>
                <a href="<?= BASE_URL ?>/bimbingan" class="btn-primary">Daftar Mahasiswa Bimbingan</a>
            </div>

            <div class="stats" style="grid-template-columns: repeat(2, minmax(0, 1fr)); margin-top: 16px;">
                <div class="stat-card">
                    <span class="stat-label">LOGBOOK</span>
                    <strong class="stat-value"><?= (int)($pendingLogbook ?? 5) ?></strong>
                </div>
                <div class="stat-card">
                    <span class="stat-label">FORM</span>
                    <strong class="stat-value"><?= (int)($pendingForm ?? 5) ?></strong>
                </div>
            </div>
        </div>


    <?php else : ?>
        <!-- =============================================================
             TAMPILAN DOSEN PENGUJI
             ============================================================= -->

        <div class="content-card">
            <div class="card-header border-b">
                <h2>Mahasiswa Diuji Hari Ini</h2>
            </div>
            <div class="list">
                <?php
                foreach ($agendaUjian as $index => $mhs) :
                ?>
                    <div class="list-item <?= htmlspecialchars($index + 1) == 1 ? 'active' : '' ?>">
                        <div class="list-item-left">
                            <span class="list-item-num"><?= htmlspecialchars($index + 1) ?></span>
                            <div>
                                <h3><?= htmlspecialchars($mhs['waktu']) ?> · <?= htmlspecialchars($mhs['nama']) ?> (<?= htmlspecialchars($mhs['nim']) ?>) <?= htmlspecialchars($mhs['jenis']) ?> · <?= htmlspecialchars($mhs['ruang']) ?></h3>
                            </div>
                        </div>

                        <div style="display: flex; gap: 1rem; align-items: center;">
                            <a href="<?= BASE_URL ?>/manajemen-jadwal/create" class="btn-primary" type="button">Beri Nilai</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Agenda Pengujian Singkat -->
        <div class="content-card">
            <div class="card-header border-b">
                <h2>Daftar Antrian Seminar dan Sidang</h2>
                <a href="<?= BASE_URL ?>/jadwal-sidang" class="btn-primary">Daftar Antrian Seminar dan Sidang</a>
            </div>
            <div class="stats" style="grid-template-columns: repeat(2, minmax(0, 1fr)); margin-top: 16px;">
                <div class="stat-card">
                    <span class="stat-label">SEMINAR PROPOSAL</span>
                    <strong class="stat-value">3</strong>
                </div>
                <div class="stat-card">
                    <span class="stat-label">SIDANG SKRIPSI</span>
                    <strong class="stat-value">1</strong>
                </div>
            </div>
        </div>

    <?php endif; ?>

</div>

<?php require_once __DIR__ . '/../../layout/footer.php'; ?>