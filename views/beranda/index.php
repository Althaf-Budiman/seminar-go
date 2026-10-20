<?php require_once __DIR__ . '/../layout/header.php'; ?>

<div class="dashboard-container">
    <!-- Status Seminar Proposal Banner -->
    <div class="content-card">
        <div class="card-header">
            <h2>Status Seminar Proposal</h2>
            <span class="badge warning">
                <span class="dot"></span>
                <?= htmlspecialchars($statusProposal ?? 'Tahap Pengajuan Topik') ?>
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
                Tahap <?= (int)($progres['currentStep'] ?? 1) ?> dari <?= (int)($progres['totalSteps'] ?? 7) ?> Aktif
            </span>
        </div>

        <div class="steps-list">
            <?php 
            $steps = $progres['steps'] ?? [];
            foreach ($steps as $step): 
                $isCurrentActive = ($step['status'] ?? '') === 'active';
                $isConditional = ($step['status'] ?? '') === 'conditional';
            ?>
                <div class="step <?= htmlspecialchars($step['status'] ?? 'locked') ?>">
                    <div class="step-left">
                        <span class="step-num"><?= htmlspecialchars($step['number']) ?></span>
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
                <?= htmlspecialchars($detailProposal['status'] ?? 'Menunggu Review Topik') ?>
            </span>
        </div>

        <div class="detail-list">
            <div class="detail-item">
                <label>Judul Proposal Penelitian</label>
                <h4><?= htmlspecialchars($detailProposal['judul'] ?? 'Aplikasi Pencatatan Menu dan Kandungan Gizi untuk Pengelolaan Data MBG') ?></h4>
            </div>

            <div class="detail-item">
                <label>Topik Penelitian</label>
                <p><?= htmlspecialchars($detailProposal['topik'] ?? 'Sistem Informasi Kesehatan & Pemantauan Nutrisi Berbasis Web') ?></p>
            </div>

            <div class="detail-item">
                <label>Dosen Pembimbing</label>
                <em><?= htmlspecialchars($detailProposal['dosenPembimbing'] ?? 'Belum Ditentukan (Menunggu Persetujuan Koordinator)') ?></em>
                <small><?= htmlspecialchars($detailProposal['nipPembimbing'] ?? 'NIP. -') ?></small>
            </div>

            <div class="detail-item">
                <label>Ringkasan Eksekutif</label>
                <p class="desc"><?= nl2br(htmlspecialchars($detailProposal['ringkasan'] ?? 'Sistem terintegrasi untuk mendata distribusi makanan bergizi, menghitung estimasi kecukupan makronutrien, dan pelaporan berkala secara terpusat untuk program intervensi gizi nasional.')) ?></p>
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

        <?php if (empty($jadwalSempro)): ?>
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
            <span class="icon-badge" title="Terkunci"><i class="bi bi-lock"></i></span>
        </div>

        <?php if (empty($catatanBimbingan)): ?>
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

        <?php if (empty($pendaftaranDokumen)): ?>
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
            <p class="text-warning"><?= htmlspecialchars($hasilPenilaian['statusKalkulasi'] ?? 'Dalam Proses Penilaian') ?></p>
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
            <p class="text-muted">Status: <?= htmlspecialchars($revisiSempro['status'] ?? 'Belum Ada Catatan Revisi') ?></p>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>