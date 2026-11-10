<?php require_once __DIR__ . '/../../layout/header.php';

$namaLengkap = $_SESSION['user']['nama_lengkap'] ?? 'Mahasiswa';

$tabs = [
    'sempro' => [
        'id'        => 'tab-sempro',
        'key'       => 'Sempro',
        'label'     => 'Seminar Proposal',
        'dataTitle' => 'Seminar Proposal',
        'active'    => true,
        'data'      => $sempro,
        'steps'     => $sempro['progress']['steps'] ?? [],
        'alurTitle' => 'Alur Progres Seminar Proposal',
        'alurSub'   => 'Tahapan wajib proses pengajuan dan pelaksanaan seminar proposal',
        'alurBadge' => 'Tahap ' . (int)($sempro['progress']['currentStep'] ?? 1) . ' dari ' . (int)($sempro['progress']['totalSteps'] ?? 7) . ' Aktif',
    ],
    'skripsi' => [
        'id'        => 'tab-skripsi',
        'key'       => 'Skripsi',
        'label'     => 'Skripsi & Sidang',
        'dataTitle' => 'Skripsi & Sidang',
        'active'    => false,
        'data'      => $skripsi,
        'steps'     => $skripsi['steps'] ?? [],
        'alurTitle' => 'Alur Penyelesaian Skripsi & Sidang',
        'alurSub'   => '',
        'alurBadge' => '',
    ],
];
?>

<?php foreach ($tabs as $programKey => $tab) : 
    $d = $tab['data'];
    $key = $tab['key'];
    $anggotaKelompok = $d['anggotaKelompok'] ?? [];
    $steps = $tab['steps'];
?>
<!-- =========================================================================
     Tab: <?= htmlspecialchars($tab['label']) ?>
     ========================================================================= -->
<div id="<?= $tab['id'] ?>" class="tab-panel dashboard-container" data-title="<?= htmlspecialchars($tab['dataTitle']) ?>" <?= !$tab['active'] ? 'style="display: none;"' : '' ?>>

    <?php if ($programKey === 'sempro') : ?>
        <!-- Status Seminar Proposal Banner -->
        <div class="content-card">
            <div class="card-header">
                <h2>Selamat Datang, <?= htmlspecialchars($namaLengkap) ?></h2>
                <span class="badge warning">
                    <span class="dot"></span>
                    <?= htmlspecialchars($d['status'] ?? 'Tahap Pengajuan Topik') ?>
                </span>
            </div>
        </div>
    <?php else : ?>
        <!-- Header Info Skripsi -->
        <div class="content-card skripsi-header-card">
            <h2 class="skripsi-title"><?= htmlspecialchars($d['judul'] ?? 'Aplikasi Pencatatan Menu dan Kandungan Gizi untuk Pengelolaan Data MBG') ?></h2>
            <div class="skripsi-meta">
                <span class="skripsi-meta-item">
                    <i class="bi bi-person-workspace"></i>
                    <span>Dosen Pembimbing: <strong><?= htmlspecialchars($d['dosenPembimbing'] ?? 'Dr. Eng. Resbob, M.Kom.') ?></strong></span>
                </span>
                <span class="skripsi-meta-item">
                    <i class="bi bi-mortarboard"></i>
                    <span>Mahasiswa: <strong><?= htmlspecialchars($d['mahasiswa'] ?? 'Mahasiswa') ?></strong></span>
                </span>
            </div>
            <div class="skripsi-progress-bar-wrap">
                <div class="skripsi-progress-label">
                    <span>Progres Pembimbingan</span>
                    <span><?= (int)($d['logbookDisetujui'] ?? 0) ?> dari <?= (int)($d['totalPersetujuan'] ?? 8) ?> Logbook Disetujui</span>
                </div>
                <div class="skripsi-progress-track">
                    <?php
                    $pct = ($d['totalPersetujuan'] ?? 8) > 0
                        ? round((($d['logbookDisetujui'] ?? 0) / ($d['totalPersetujuan'] ?? 8)) * 100)
                        : 0;
                    ?>
                    <div class="skripsi-progress-fill" style="width: <?= $pct ?>%"></div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- Alur Progres -->
    <div class="content-card">
        <div class="card-header">
            <div>
                <h2><?= htmlspecialchars($tab['alurTitle']) ?></h2>
                <?php if (!empty($tab['alurSub'])) : ?>
                    <p><?= htmlspecialchars($tab['alurSub']) ?></p>
                <?php endif; ?>
            </div>
            <?php if (!empty($tab['alurBadge'])) : ?>
                <span class="badge primary">
                    <?= htmlspecialchars($tab['alurBadge']) ?>
                </span>
            <?php endif; ?>
        </div>

        <div class="list">
            <?php foreach ($steps as $step) :
                $isActive      = ($step['status'] ?? '') === 'active';
                $isNext        = ($step['status'] ?? '') === 'next';
                $isDone        = ($step['status'] ?? '') === 'done';
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
                            <span class="badge primary">
                                <?= htmlspecialchars($step['badgeText'] ?? 'Tahap Aktif') ?>
                            </span>
                        <?php elseif ($isNext) : ?>
                            <span class="badge next">
                                <?= htmlspecialchars($step['badgeText'] ?? 'Berikutnya') ?>
                            </span>
                        <?php elseif ($isDone) : ?>
                            <span class="badge success">
                                <?= htmlspecialchars($step['badgeText'] ?? 'Selesai') ?>
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
    <?php if (!empty($anggotaKelompok)) : ?>
        <div class="content-card">
            <div class="card-header">
                <div>
                    <h2>Progress Anggota Kelompok</h2>
                </div>
                <span class="badge primary">
                    <?= count($anggotaKelompok) ?> Anggota
                </span>
            </div>

            <div class="list list-lg">
                <?php foreach ($anggotaKelompok as $anggota) : ?>
                    <div class="list-item progress-anggota-item">
                        <div class="list-item-left">
                            <span class="icon-badge">
                                <i class="bi bi-person"></i>
                            </span>

                            <div>
                                <h3><?= htmlspecialchars($anggota['nama']) ?></h3>
                                <p><?= htmlspecialchars($anggota['nim']) ?></p>
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

    <!-- Pengajuan Topik & Pembimbing (Khusus Sempro bila ada datanya) -->
    <?php if (!empty($d['detailProposal'])) : ?>
        <div class="content-card">
            <div class="card-header border-b">
                <div>
                    <h2>Pengajuan Topik & Pembimbing</h2>
                </div>
                <span class="badge warning">
                    <?= htmlspecialchars($d['detailProposal']['status'] ?? 'Menunggu Review Topik') ?>
                </span>
            </div>

            <div class="detail-list">
                <div class="detail-item">
                    <label>Judul Proposal Penelitian</label>
                    <h4><?= htmlspecialchars($d['detailProposal']['judul'] ?? 'Aplikasi Pencatatan Menu dan Kandungan Gizi untuk Pengelolaan Data MBG') ?></h4>
                </div>

                <div class="detail-item">
                    <label>Topik Penelitian</label>
                    <p><?= htmlspecialchars($d['detailProposal']['topik'] ?? 'Sistem Informasi Kesehatan & Pemantauan Nutrisi Berbasis Web') ?></p>
                </div>

                <div class="detail-item">
                    <label>Dosen Pembimbing</label>
                    <em><?= htmlspecialchars($d['detailProposal']['dosenPembimbing'] ?? 'Belum Ditentukan (Menunggu Persetujuan Koordinator)') ?></em>
                    <small><?= htmlspecialchars($d['detailProposal']['nipPembimbing'] ?? 'NIP. -') ?></small>
                </div>

                <div class="detail-item">
                    <label>Ringkasan Eksekutif</label>
                    <p class="desc"><?= nl2br(htmlspecialchars($d['detailProposal']['ringkasan'] ?? '')) ?></p>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- Kalender (Khusus Sempro bila ada agenda) -->
    <?php if (!empty($d['kalender'])) : ?>
        <div class="content-card" data-beranda-calendar data-today="<?= htmlspecialchars($today ?? date('Y-m-d')) ?>" data-events="<?= htmlspecialchars(json_encode($d['kalender'], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT), ENT_QUOTES, 'UTF-8') ?>">
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
    <?php endif; ?>

    <!-- Jadwal Sidang (Bila di Sempro) -->
    <?php if ($programKey === 'sempro') : ?>
        <div class="content-card border-b">
            <div class="card-header">
                <div>
                    <h2>Jadwal Sidang Sempro</h2>
                </div>
            </div>

            <?php if (empty($d['jadwal'])) : ?>
                <div class="card-empty">
                    <div class="empty-icon"><i class="bi bi-lock"></i></div>
                    <p>Jadwal Belum Tersedia</p>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <!-- Logbook Bimbingan -->
    <div class="content-card <?= $programKey === 'sempro' ? 'border-b' : '' ?>">
        <div class="card-header">
            <div>
                <h2>Logbook Bimbingan <?= htmlspecialchars($key) ?></h2>
            </div>
            <?php if ($programKey === 'sempro') : ?>
                <span class="badge neutral"><i class="bi bi-lock"></i> Terkunci</span>
            <?php endif; ?>
        </div>

        <?php if (!empty($d['riwayatBimbingan'])) : ?>
            <div class="bimbingan-list">
                <?php foreach ($d['riwayatBimbingan'] as $b) : ?>
                    <div class="bimbingan-item">
                        <span class="bimbingan-tanggal"><?= htmlspecialchars($b['tanggal']) ?></span>
                        <span class="bimbingan-catatan"><?= htmlspecialchars($b['catatan']) ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php elseif (empty($d['catatanBimbingan'])) : ?>
            <div class="card-empty">
                <?php if ($programKey === 'sempro') : ?>
                    <div class="empty-icon"><i class="bi bi-lock"></i></div>
                <?php endif; ?>
                <p><?= $programKey === 'skripsi' ? 'Belum Ada Logbook' : 'Belum Ada Bimbingan' ?></p>
            </div>
        <?php endif; ?>
    </div>

    <!-- Kelengkapan Berkas -->
    <div class="content-card border-b">
        <div class="card-header">
            <div>
                <h2>Kelengkapan Berkas <?= htmlspecialchars($key) ?></h2>
            </div>
            <span class="badge neutral"><i class="bi bi-lock"></i> Terkunci</span>
        </div>

        <?php if (empty($d['pendaftaranDokumen'])) : ?>
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
                <h2>Hasil Sidang <?= htmlspecialchars($key) ?></h2>
            </div>
        </div>

        <?php if (empty($d['hasilSidang'])) : ?>
            <div class="card-empty">
                <div class="empty-icon"><i class="bi bi-lock"></i></div>
                <p>Belum ada hasil</p>
            </div>
        <?php endif; ?>
    </div>

    <!-- Revisi -->
    <div class="content-card">
        <div class="card-header">
            <div>
                <h2>Revisi <?= htmlspecialchars($key) ?></h2>
            </div>
        </div>

        <?php if (empty($d['revisi'])) : ?>
            <div class="card-empty">
                <div class="empty-icon"><i class="bi bi-lock"></i></div>
                <p>Belum ada catatan revisi</p>
            </div>
        <?php endif; ?>
    </div>

</div>
<?php endforeach; ?>

<?php require_once __DIR__ . '/../../layout/footer.php'; ?>
<script src="<?= BASE_URL ?>/scripts/beranda-calendar.js"></script>
