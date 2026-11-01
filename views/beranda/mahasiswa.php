<?php require_once __DIR__ . '/../layout/header.php'; ?>

<!-- Tab: Seminar Proposal -->
<div id="tab-sempro" class="tab-panel dashboard-container" data-title="Seminar Proposal">
    <!-- Status Seminar Proposal Banner -->
    <div class="content-card">
        <div class="card-header">
            <h2>Status Seminar Proposal</h2>
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
                Tahap <?= (int)($sempro['progres']['currentStep'] ?? 1) ?> dari <?= (int)($sempro['progres']['totalSteps'] ?? 7) ?> Aktif
            </span>
        </div>

        <div class="list">
            <?php
            $steps = $sempro['progres']['steps'] ?? [];
            foreach ($steps as $step):
                $isCurrentActive = ($step['status'] ?? '') === 'active';
                $isConditional = ($step['status'] ?? '') === 'conditional';
            ?>
                <div class="list-item <?= htmlspecialchars($step['status'] ?? 'locked') ?>">
                    <div class="list-item-left">
                        <span class="list-item-num"><?= htmlspecialchars($step['number']) ?></span>
                        <div>
                            <h3><?= htmlspecialchars($step['title']) ?></h3>
                            <?php if (!empty($step['subtitle'])): ?>
                                <p><?= htmlspecialchars($step['subtitle']) ?></p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div>
                        <?php if ($isCurrentActive): ?>
                            <span class="badge primary">
                                <?= htmlspecialchars($step['badgeText'] ?? 'Tahap Aktif') ?>
                            </span>
                        <?php elseif ($isConditional): ?>
                            <span class="badge neutral">
                                <i class="bi bi-card-checklist"></i>
                                <?= htmlspecialchars($step['badgeText'] ?? 'Kondisional') ?>
                            </span>
                        <?php else: ?>
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

    <!-- Detail Proposal Mahasiswa -->
    <div class="content-card">
        <div class="card-header">
            <div>
                <h2>Detail Proposal Mahasiswa</h2>
                <p>Data pengajuan topik tercatat pada sistem SeminarGo</p>
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

    <!-- Jadwal Sempro -->
    <div class="content-card">
        <div class="card-header">
            <div>
                <h2>Jadwal Sempro</h2>
                <p>Informasi agenda pelaksanaan sidang</p>
            </div>
        </div>

        <?php if (empty($sempro['jadwal'])): ?>
            <div class="card-empty">
                <div class="empty-icon"><i class="bi bi-lock"></i></div>
                <p>Jadwal Belum Tersedia</p>
            </div>
        <?php endif; ?>
    </div>

    <!-- Catatan Bimbingan Terkini -->
    <div class="content-card">
        <div class="card-header">
            <div>
                <h2>Catatan Bimbingan Terkini</h2>
                <p>Riwayat asistensi naskah bersama dosen pembimbing</p>
            </div>
            <span class="badge neutral"><i class="bi bi-lock"></i> Terkunci</span>
        </div>

        <?php if (empty($sempro['catatanBimbingan'])): ?>
            <div class="card-empty">
                <div class="empty-icon"><i class="bi bi-lock"></i></div>
                <p>Belum Ada Bimbingan</p>
            </div>
        <?php endif; ?>
    </div>

    <!-- Pendaftaran & Dokumen Sempro -->
    <div class="content-card">
        <div class="card-header">
            <div>
                <h2>Pendaftaran & Dokumen Sempro</h2>
                <p>Berkas proposal lengkap yang diajukan ke panitia seminar</p>
            </div>
            <span class="badge neutral"><i class="bi bi-lock"></i> Terkunci</span>
        </div>

        <?php if (empty($sempro['pendaftaranDokumen'])): ?>
            <div class="card-empty">
                <div class="empty-icon"><i class="bi bi-lock"></i></div>
                <p>Pendaftaran Belum Dibuka</p>
            </div>
        <?php endif; ?>
    </div>

    <!-- Hasil Penilaian -->
    <div class="content-card">
        <div class="card-header">
            <div>
                <h2>Hasil Penilaian</h2>
                <p>Kalkulasi nilai seminar dewan penguji</p>
            </div>
        </div>

        <div class="card-empty">
            <small>STATUS KALKULASI</small>
            <p class="text-warning"><?= htmlspecialchars($sempro['hasilPenilaian']['statusKalkulasi'] ?? 'Dalam Proses Penilaian') ?></p>
        </div>
    </div>

    <!-- Revisi Sempro -->
    <div class="content-card">
        <div class="card-header">
            <div>
                <h2>Revisi Sempro</h2>
                <p>Catatan perbaikan & pengunggahan lembar revisi</p>
            </div>
        </div>

        <div class="card-empty">
            <p class="text-muted">Status: <?= htmlspecialchars($sempro['revisi']['status'] ?? 'Belum Ada Catatan Revisi') ?></p>
        </div>
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
                <span><?= (int)($skripsi['sesiTerpenuhi'] ?? 0) ?> dari <?= (int)($skripsi['totalSesi'] ?? 8) ?> Sesi Terpenuhi</span>
            </div>
            <div class="skripsi-progress-track">
                <?php
                $pct = ($skripsi['totalSesi'] ?? 8) > 0
                    ? round((($skripsi['sesiTerpenuhi'] ?? 0) / ($skripsi['totalSesi'] ?? 8)) * 100)
                    : 0;
                ?>
                <div class="skripsi-progress-fill" style="width: <?= $pct ?>%"></div>
            </div>
        </div>
    </div>

    <!-- Alur Penyelesaian Skripsi & Sidang -->
    <div class="content-card">
        <div class="card-header">
            <h2>Alur Penyelesaian Skripsi &amp; Sidang</h2>
        </div>
        <div class="list">
            <?php
            $skripsiSteps = $skripsi['steps'] ?? [];
            foreach ($skripsiSteps as $step):
                $isActive    = ($step['status'] ?? '') === 'active';
                $isNext      = ($step['status'] ?? '') === 'next';
                $isDone      = ($step['status'] ?? '') === 'done';
                $isConditional = ($step['status'] ?? '') === 'conditional';
            ?>
                <div class="list-item <?= htmlspecialchars($step['status'] ?? 'locked') ?>">
                    <div class="list-item-left">
                        <span class="list-item-num">
                            <?php if ($isDone): ?>
                                <i class="bi bi-check" style="font-size:0.85rem"></i>
                            <?php else: ?>
                                <?= htmlspecialchars($step['number']) ?>
                            <?php endif; ?>
                        </span>
                        <div>
                            <h3><?= htmlspecialchars($step['title']) ?></h3>
                            <?php if (!empty($step['subtitle'])): ?>
                                <p><?= htmlspecialchars($step['subtitle']) ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div>
                        <?php if ($isActive): ?>
                            <span class="badge primary"><?= htmlspecialchars($step['badgeText'] ?? 'Tahap Aktif') ?></span>
                        <?php elseif ($isNext): ?>
                            <span class="badge next"><?= htmlspecialchars($step['badgeText'] ?? 'Berikutnya') ?></span>
                        <?php elseif ($isDone): ?>
                            <span class="badge success"><?= htmlspecialchars($step['badgeText'] ?? 'Selesai') ?></span>
                        <?php elseif ($isConditional): ?>
                            <span class="badge neutral"><i class="bi bi-card-checklist"></i> <?= htmlspecialchars($step['badgeText'] ?? 'Kondisional') ?></span>
                        <?php else: ?>
                            <span class="badge neutral"><i class="bi bi-lock"></i> <?= htmlspecialchars($step['badgeText'] ?? 'Terkunci') ?></span>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Riwayat Bimbingan Skripsi -->
    <div class="content-card">
        <div class="card-header">
            <h2>Riwayat Bimbingan Skripsi</h2>
        </div>
        <?php if (empty($skripsi['riwayatBimbingan'])): ?>
            <div class="card-empty">
                <p>Belum Ada Riwayat Bimbingan</p>
            </div>
        <?php else: ?>
            <div class="bimbingan-list">
                <?php foreach ($skripsi['riwayatBimbingan'] as $b): ?>
                    <div class="bimbingan-item">
                        <span class="bimbingan-tanggal"><?= htmlspecialchars($b['tanggal']) ?></span>
                        <span class="bimbingan-catatan"><?= htmlspecialchars($b['catatan']) ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Pendaftaran Sidang Skripsi -->
    <div class="content-card">
        <div class="card-header">
            <h2>Pendaftaran Sidang Skripsi</h2>
        </div>
        <?php if (!empty($skripsi['pendaftaranTerkunci'])): ?>
            <div class="card-lock-notice">
                <div class="lock-notice-icon"><i class="bi bi-lock-fill"></i></div>
                <div class="lock-notice-body">
                    <strong>Persyaratan Terkunci Sebelum Sesi Bimbingan Selesai</strong>
                    <p><?= htmlspecialchars($skripsi['pendaftaranTerkunci']) ?></p>
                </div>
            </div>
        <?php else: ?>
            <div class="card-empty">
                <p>Pendaftaran Belum Tersedia</p>
            </div>
        <?php endif; ?>
    </div>

    <!-- Jadwal Sidang Akhir -->
    <div class="content-card">
        <div class="card-header">
            <h2>Jadwal Sidang Akhir</h2>
        </div>
        <?php if (empty($skripsi['jadwalSidang'])): ?>
            <div class="card-empty">
                <p class="text-muted"><?= htmlspecialchars($skripsi['jadwalSidangInfo'] ?? 'Jadwal sidang akan ditentukan oleh koordinator sidang setelah pendaftaran skripsi disetujui dan seluruh penguji ditetapkan.') ?></p>
            </div>
        <?php endif; ?>
    </div>

    <!-- Hasil Sidang Skripsi -->
    <div class="content-card">
        <div class="card-header">
            <h2>Hasil Sidang Skripsi</h2>
        </div>
        <div class="list">
            <?php foreach (($skripsi['hasilSidang'] ?? []) as $hasil): ?>
                <div class="list-item">
                    <div class="list-item-left">
                        <span class="icon-badge"><i class="<?= htmlspecialchars($hasil['icon']) ?>"></i></span>
                        <div>
                            <h3><?= htmlspecialchars($hasil['label']) ?></h3>
                        </div>
                    </div>
                    <span class="badge neutral"><?= htmlspecialchars($hasil['value']) ?></span>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Revisi Skripsi -->
    <div class="content-card">
        <div class="card-header">
            <h2>Revisi Skripsi</h2>
        </div>
        <div class="card-empty">
            <p class="text-muted"><?= htmlspecialchars($skripsi['revisi'] ?? 'Revisi belum tersedia') ?></p>
        </div>
    </div>

</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>