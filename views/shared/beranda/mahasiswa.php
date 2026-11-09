<?php require_once __DIR__ . '/../../layout/header.php';

$namaLengkap = $_SESSION['user']['nama_lengkap'] ?? 'Mahasiswa';
$anggotaKelompokSempro = $sempro['anggotaKelompok'] ?? [];
$anggotaKelompokSkripsi = $skripsi['anggotaKelompok'] ?? [];

?>



<!-- Tab: Seminar Proposal -->
<div id="tab-sempro" class="tab-panel dashboard-container" data-title="Seminar Proposal">
    <!-- Status Seminar Proposal Banner -->
    <div class="content-card">
        <div class="card-header">
            <h2>Selamat Datang, <?= htmlspecialchars($namaLengkap) ?></h2>
            <span class="badge warning">
                <span class="dot"></span>
                <?= htmlspecialchars($sempro['status'] ?? 'Tahap Pengajuan Topik') ?>
            </span>
        </div>
    </div>

    <!-- Alur Progres Seminar Proposal -->
    <div class="content-card">
        <div class="card-header">
            <div>
                <h2>Alur Progres Seminar Proposal</h2>
                <p>Tahapan wajib proses pengajuan dan pelaksanaan seminar proposal</p>
            </div>
            <span class="badge primary">
                Tahap <?= (int)($sempro['progress']['currentStep'] ?? 1) ?> dari <?= (int)($sempro['progress']['totalSteps'] ?? 7) ?> Aktif
            </span>
        </div>

        <div class="list">
            <?php
            $steps = $sempro['progress']['steps'] ?? [];
            foreach ($steps as $step) :
                $isCurrentActive = ($step['status'] ?? '') === 'active';
                $isConditional = ($step['status'] ?? '') === 'conditional';
            ?>
                <div class="list-item <?= htmlspecialchars($step['status'] ?? 'locked') ?>">
                    <div class="list-item-left">
                        <span class="list-item-num"><?= htmlspecialchars($step['number']) ?></span>
                        <div>
                            <h3><?= htmlspecialchars($step['title']) ?></h3>
                        </div>
                    </div>

                    <div>
                        <?php if ($isCurrentActive) : ?>
                            <span class="badge primary">
                                <?= htmlspecialchars($step['badgeText'] ?? 'Tahap Aktif') ?>
                            </span>
                        <?php elseif ($isConditional) : ?>
                            <span class="badge neutral">
                                <i class="bi bi-card-checklist"></i>
                                <?= htmlspecialchars($step['badgeText'] ?? 'Kondisional') ?>
                            </span>
                        <?php else : ?>
                            <span class="badge neutral">
                                <i class="bi bi-lock"></i>
                                <?= htmlspecialchars($step['badgeText'] ?? 'Terkunci') ?>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>


    <!-- Progress Anggota Kelompok -->
    <?php if (!empty($anggotaKelompokSempro)) : ?>
        <div class="content-card">
            <div class="card-header">
                <div>
                    <h2>Progress Anggota Kelompok</h2>
                </div>
                <span class="badge primary">
                    <?= count($anggotaKelompokSempro) ?> Anggota
                </span>
            </div>

            <div class="list list-lg">
                <?php foreach ($anggotaKelompokSempro as $anggota) :
                    $total = max(1, (int) $anggota['totalTahap']);
                    $selesai = max(0, min($total, (int) $anggota['tahapSelesai']));
                    $progress = round(($selesai / $total) * 100);
                ?>
                    <div class="list-item progress-anggota-item">
                        <div class="list-item-left">
                            <span class="icon-badge">
                                <i class="bi bi-person"></i>
                            </span>

                            <div>
                                <h3><?= htmlspecialchars($anggota['nama']) ?></h3>
                                <p>
                                    <?= htmlspecialchars($anggota['nim']) ?> </p>
                            </div>
                        </div>

                        <span class="badge primary">
                            <span class="dot"></span>
                            <?= htmlspecialchars($anggota['tahap']) ?>
                        </span>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>


    <!-- Pengajuan Topik & Pembimbing -->
    <div class="content-card">
        <div class="card-header border-b">
            <div>
                <h2>Pengajuan Topik & Pembimbing</h2>
            </div>
            <span class="badge warning">
                <?= htmlspecialchars($sempro['detailProposal']['status'] ?? 'Menunggu Review Topik') ?>
            </span>
        </div>

        <div class="detail-list">
            <div class="detail-item">
                <label>Judul Proposal Penelitian</label>
                <h4><?= htmlspecialchars($sempro['detailProposal']['judul'] ?? 'Aplikasi Pencatatan Menu dan Kandungan Gizi untuk Pengelolaan Data MBG') ?></h4>
            </div>

            <div class="detail-item">
                <label>Topik Penelitian</label>
                <p><?= htmlspecialchars($sempro['detailProposal']['topik'] ?? 'Sistem Informasi Kesehatan & Pemantauan Nutrisi Berbasis Web') ?></p>
            </div>

            <div class="detail-item">
                <label>Dosen Pembimbing</label>
                <em><?= htmlspecialchars($sempro['detailProposal']['dosenPembimbing'] ?? 'Belum Ditentukan (Menunggu Persetujuan Koordinator)') ?></em>
                <small><?= htmlspecialchars($sempro['detailProposal']['nipPembimbing'] ?? 'NIP. -') ?></small>
            </div>

            <div class="detail-item">
                <label>Ringkasan Eksekutif</label>
                <p class="desc"><?= nl2br(htmlspecialchars($sempro['detailProposal']['ringkasan'] ?? 'Sistem terintegrasi untuk mendata distribusi makanan bergizi, menghitung estimasi kecukupan makronutrien, dan pelaporan berkala secara terpusat untuk program intervensi gizi nasional.')) ?></p>
            </div>
        </div>
    </div>

    <!-- Kalender Seminar Proposal -->
    <div class="content-card" data-beranda-calendar data-today="<?= htmlspecialchars($today) ?>" data-events="<?= htmlspecialchars(json_encode($sempro['kalender'] ?? [], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT), ENT_QUOTES, 'UTF-8') ?>">
        <div class="card-header">
            <div>
                <h2 data-calendar-title></h2>
                <p>Pilih tanggal untuk melihat agenda kegiatan.</p>
            </div>
            <div class="cal-nav">
                <button type="button" class="cal-nav-btn" data-calendar-prev>
                    <i class="bi bi-chevron-left"></i>
                </button>
                <button type="button" class="cal-nav-btn" data-calendar-next>
                    <i class="bi bi-chevron-right"></i>
                </button>
            </div>
        </div>

        <div class="cal-weekdays" aria-hidden="true">
            <span>Min</span><span>Sen</span><span>Sel</span>
            <span>Rab</span><span>Kam</span><span>Jum</span><span>Sab</span>
        </div>

        <div class="cal-days" data-calendar-days></div>
        <div class="list" data-calendar-list></div>

        <div class="card-empty" data-calendar-empty style="display:none;">
            <span class="empty-icon"><i class="bi bi-calendar-x"></i></span>
            <p>Belum Ada Agenda</p>
            <span class="text-muted">Tidak ada kegiatan pada tanggal yang dipilih.</span>
        </div>
    </div>

    <!-- Jadwal Sidang Sempro -->
    <div class="content-card border-b">
        <div class="card-header">
            <div>
                <h2>Jadwal Sidang Sempro</h2>
            </div>
        </div>

        <?php if (empty($sempro['jadwal'])) : ?>
            <div class="card-empty">
                <div class="empty-icon"><i class="bi bi-lock"></i></div>
                <p>Jadwal Belum Tersedia</p>
            </div>
        <?php endif; ?>
    </div>

    <!-- Catatan Bimbingan Terkini -->
    <div class="content-card border-b">
        <div class="card-header">
            <div>
                <h2>Logbook Bimbingan Sempro</h2>
            </div>
            <span class="badge neutral"><i class="bi bi-lock"></i> Terkunci</span>
        </div>

        <?php if (empty($sempro['catatanBimbingan'])) : ?>
            <div class="card-empty">
                <div class="empty-icon"><i class="bi bi-lock"></i></div>
                <p>Belum Ada Bimbingan</p>
            </div>
        <?php endif; ?>
    </div>

    <!-- Kelengkapan Berkas Seminar Proposal -->
    <div class="content-card border-b">
        <div class="card-header">
            <div>
                <h2>Kelengkapan Berkas Sempro</h2>
            </div>
            <span class="badge neutral"><i class="bi bi-lock"></i> Terkunci</span>
        </div>

        <?php if (empty($sempro['pendaftaranDokumen'])) : ?>
            <div class="card-empty">
                <div class="empty-icon"><i class="bi bi-lock"></i></div>
                <p>Pendaftaran Belum Dibuka</p>
            </div>
        <?php endif; ?>
    </div>

    <!-- Hasil Sidang -->
    <div class="content-card border-b">
        <div class="card-header">
            <div>
                <h2>Hasil Sidang Sempro</h2>
            </div>
        </div>

        <?php if (empty($sempro['hasilSidang'])) : ?>
            <div class="card-empty">
                <div class="empty-icon"><i class="bi bi-lock"></i></div>
                <p>Belum ada hasil</p>
            </div>
        <?php endif; ?>
    </div>

    <!-- Revisi Sempro -->
    <div class="content-card">
        <div class="card-header">
            <div>
                <h2>Revisi Sempro</h2>
            </div>
        </div>

        <?php if (empty($sempro['revisi'])) : ?>
            <div class="card-empty">
                <div class="empty-icon"><i class="bi bi-lock"></i></div>
                <p>Belum ada catatan revisi</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Tab: Skripsi -->
<div id="tab-skripsi" class="tab-panel dashboard-container" data-title="Skripsi &amp; Sidang" style="display:none">

    <!-- Header Info Skripsi -->
    <div class="content-card skripsi-header-card">
        <h2 class="skripsi-title"><?= htmlspecialchars($skripsi['judul'] ?? 'Aplikasi Pencatatan Menu dan Kandungan Gizi untuk Pengelolaan Data MBG') ?></h2>
        <div class="skripsi-meta">
            <span class="skripsi-meta-item">
                <i class="bi bi-person-workspace"></i>
                <span>Dosen Pembimbing: <strong><?= htmlspecialchars($skripsi['dosenPembimbing'] ?? 'Dr. Eng. Resbob, M.Kom.') ?></strong></span>
            </span>
            <span class="skripsi-meta-item">
                <i class="bi bi-mortarboard"></i>
                <span>Mahasiswa: <strong><?= htmlspecialchars($skripsi['mahasiswa'] ?? 'Mahasiswa') ?></strong></span>
            </span>
        </div>
        <div class="skripsi-progress-bar-wrap">
            <div class="skripsi-progress-label">
                <span>Progres Pembimbingan</span>
                <span><?= (int)($skripsi['logbookDisetujui'] ?? 0) ?> dari <?= (int)($skripsi['totalPersetujuan'] ?? 8) ?> Logbook Disetujui</span>
            </div>
            <div class="skripsi-progress-track">
                <?php
                $pct = ($skripsi['totalPersetujuan'] ?? 8) > 0
                    ? round((($skripsi['logbookDisetujui'] ?? 0) / ($skripsi['totalPersetujuan'] ?? 8)) * 100)
                    : 0;
                ?>
                <div class="skripsi-progress-fill" style="width: <?= $pct ?>%"></div>
            </div>
        </div>
    </div>

    <!-- Kalender Skripsi -->
    <!-- <div class="content-card" data-beranda-calendar data-today="<?= htmlspecialchars($today) ?>" data-events="<?= htmlspecialchars(json_encode($kalender['skripsi'] ?? [], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT), ENT_QUOTES, 'UTF-8') ?>">

        <div class="card-header">
            <div>
                <h2 data-calendar-title></h2>
                <p>Pilih tanggal untuk melihat agenda kegiatan.</p>
            </div>
            <div class="cal-nav">
                <button type="button" class="cal-nav-btn" data-calendar-prev>
                    <i class="bi bi-chevron-left"></i>
                </button>
                <button type="button" class="cal-nav-btn" data-calendar-next>
                    <i class="bi bi-chevron-right"></i>
                </button>
            </div>
        </div>

        <div class="cal-weekdays" aria-hidden="true">
            <span>Min</span><span>Sen</span><span>Sel</span>
            <span>Rab</span><span>Kam</span><span>Jum</span><span>Sab</span>
        </div>

        <div class="cal-days" data-calendar-days></div>
        <div class="list" data-calendar-list></div>

        <div class="card-empty" data-calendar-empty style="display:none;">
            <span class="empty-icon"><i class="bi bi-calendar-x"></i></span>
            <p>Belum Ada Agenda</p>
            <span class="text-muted">Tidak ada kegiatan pada tanggal yang dipilih.</span>
        </div>
    </div> -->

    <!-- Alur Penyelesaian Skripsi & Sidang -->
    <div class="content-card">
        <div class="card-header">
            <h2>Alur Penyelesaian Skripsi &amp; Sidang</h2>
        </div>
        <div class="list">
            <?php
            $skripsiSteps = $skripsi['steps'] ?? [];
            foreach ($skripsiSteps as $step) :
                $isActive    = ($step['status'] ?? '') === 'active';
                $isNext      = ($step['status'] ?? '') === 'next';
                $isDone      = ($step['status'] ?? '') === 'done';
                $isConditional = ($step['status'] ?? '') === 'conditional';
            ?>
                <div class="list-item <?= htmlspecialchars($step['status'] ?? 'locked') ?>">
                    <div class="list-item-left">
                        <span class="list-item-num">
                            <?php if ($isDone) : ?>
                                <i class="bi bi-check" style="font-size:0.85rem"></i>
                            <?php else : ?>
                                <?= htmlspecialchars($step['number']) ?>
                            <?php endif; ?>
                        </span>
                        <div>
                            <h3><?= htmlspecialchars($step['title']) ?></h3>
                            <?php if (!empty($step['subtitle'])) : ?>
                                <p><?= htmlspecialchars($step['subtitle']) ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div>
                        <?php if ($isActive) : ?>
                            <span class="badge primary"><?= htmlspecialchars($step['badgeText'] ?? 'Tahap Aktif') ?></span>
                        <?php elseif ($isNext) : ?>
                            <span class="badge next"><?= htmlspecialchars($step['badgeText'] ?? 'Berikutnya') ?></span>
                        <?php elseif ($isDone) : ?>
                            <span class="badge success"><?= htmlspecialchars($step['badgeText'] ?? 'Selesai') ?></span>
                        <?php elseif ($isConditional) : ?>
                            <span class="badge neutral"><i class="bi bi-card-checklist"></i> <?= htmlspecialchars($step['badgeText'] ?? 'Kondisional') ?></span>
                        <?php else : ?>
                            <span class="badge neutral"><i class="bi bi-lock"></i> <?= htmlspecialchars($step['badgeText'] ?? 'Terkunci') ?></span>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Progress Anggota Kelompok -->
    <?php if (!empty($anggotaKelompokSkripsi)) : ?>
        <div class="content-card">
            <div class="card-header">
                <div>
                    <h2>Progress Anggota Kelompok</h2>
                </div>
                <span class="badge primary">
                    <?= count($anggotaKelompokSkripsi) ?> Anggota
                </span>
            </div>

            <div class="list list-lg">
                <?php foreach ($anggotaKelompokSkripsi as $anggota) :
                    $total = max(1, (int) $anggota['totalTahap']);
                    $selesai = max(0, min($total, (int) $anggota['tahapSelesai']));
                    $progress = round(($selesai / $total) * 100);
                ?>
                    <div class="list-item progress-anggota-item">
                        <div class="list-item-left">
                            <span class="icon-badge">
                                <i class="bi bi-person"></i>
                            </span>

                            <div>
                                <h3><?= htmlspecialchars($anggota['nama']) ?></h3>
                                <p>
                                    <?= htmlspecialchars($anggota['nim']) ?> </p>
                            </div>
                        </div>

                        <span class="badge primary">
                            <span class="dot"></span>
                            <?= htmlspecialchars($anggota['tahap']) ?>
                        </span>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>

    <!-- Logbook Bimbingan -->
    <div class="content-card">
        <div class="card-header">
            <h2>Logbook Bimbingan Skripsi</h2>
        </div>
        <?php if (empty($skripsi['riwayatBimbingan'])) : ?>
            <div class="card-empty">
                <p>Belum Ada Logbook</p>
            </div>
        <?php else : ?>
            <div class="bimbingan-list">
                <?php foreach ($skripsi['riwayatBimbingan'] as $b) : ?>
                    <div class="bimbingan-item">
                        <span class="bimbingan-tanggal"><?= htmlspecialchars($b['tanggal']) ?></span>
                        <span class="bimbingan-catatan"><?= htmlspecialchars($b['catatan']) ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Kelengkapan Berkas Skripsi -->
    <div class="content-card border-b">
        <div class="card-header">
            <div>
                <h2>Kelengkapan Berkas Skripsi</h2>
            </div>
            <span class="badge neutral"><i class="bi bi-lock"></i> Terkunci</span>
        </div>

        <?php if (empty($skripsi['pendaftaranDokumen'])) : ?>
            <div class="card-empty">
                <div class="empty-icon"><i class="bi bi-lock"></i></div>
                <p>Pendaftaran Belum Dibuka</p>
            </div>
        <?php endif; ?>
    </div>

    <!-- Hasil Sidang -->
    <div class="content-card border-b">
        <div class="card-header">
            <div>
                <h2>Hasil Sidang Skripsi</h2>
            </div>
        </div>

        <?php if (empty($skripsi['hasilSidang'])) : ?>
            <div class="card-empty">
                <div class="empty-icon"><i class="bi bi-lock"></i></div>
                <p>Belum ada hasil</p>
            </div>
        <?php endif; ?>
    </div>

    <!-- Revisi Sempro -->
    <div class="content-card">
        <div class="card-header">
            <div>
                <h2>Revisi Skripsi</h2>
            </div>
        </div>

        <?php if (empty($skripsi['revisi'])) : ?>
            <div class="card-empty">
                <div class="empty-icon"><i class="bi bi-lock"></i></div>
                <p>Belum ada catatan revisi</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php require_once __DIR__ . '/../../layout/footer.php'; ?>
<script src="<?= BASE_URL ?>/scripts/beranda-calendar.js"></script>