<?php require_once __DIR__ . '/../../layout/header.php'; ?>


<?php
$statusMap = [
    'selesai'       => ['label' => 'Selesai',       'class' => 'finished'],
    'terkonfirmasi' => ['label' => 'Terkonfirmasi', 'class' => 'confirmed'],
];

// Data ringkas untuk popup detail aktivitas (dibaca oleh scripts/jadwal-detail.js)
$detailData = [];
foreach ($jadwal as $tgl => $grup) {
    $detailData[$tgl] = [
        'label' => $grup['label'],
        'items' => array_map(function ($j) {
            return [
                'id'         => (int)$j['id'],
                'waktu'      => $j['mulai'] . ' - ' . $j['selesai'],
                'ruang'      => $j['ruang'],
                'nama'       => $j['nama'],
                'pembimbing' => $j['pembimbing'],
                'penguji'    => $j['dosen_penguji'],
                'jenis'      => $j['jenis'],
            ];
        }, $grup['items']),
    ];
}
?>

<div class="dashboard-container" id="jadwalApp" data-today="<?= htmlspecialchars($today) ?>">

    <!-- List mahasiswa siap dijadwalkan -->
    <div class="content-card">
        <div class="card-header">
            <h2>Mahasiswa Siap Dijadwalkan</h2>
            <div class="badge primary" id="jumlahMahasiswaSiapDijadwalkan"><?= count($mahasiswaSiapDijadwalkan) ?> mahasiswa</div>
        </div>

        <div class="list">
            <?php
            foreach ($mahasiswaSiapDijadwalkan as $index => $mhs) :
            ?>
                <div class="list-item <?= htmlspecialchars($index + 1) == 1 ? 'active' : '' ?>">
                    <div class="list-item-left">
                        <span class="list-item-num"><?= htmlspecialchars($index + 1) ?></span>
                        <div>
                            <h3><?= htmlspecialchars($mhs['nama']) ?> (<?= htmlspecialchars($mhs['nim']) ?>) <?= htmlspecialchars($mhs['jenis']) ?></h3>
                        </div>
                    </div>

                    <div style="display: flex; gap: 1rem; align-items: center;">
                        <div class="badge <?= htmlspecialchars($index + 1) == 1 ? 'primary' : 'neutral' ?>">Syarat Terpenuhi</div>
                        <a href="<?= BASE_URL ?>/manajemen-jadwal/create" class="btn-primary" type="button">Buat Jadwal</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Kalender -->
    <div class="content-card">
        <div class="card-header">
            <div>
                <h2 id="calTitle">Oktober 2026</h2>
                <p>Pilih tanggal untuk melihat detail jadwal.</p>
            </div>
            <div class="cal-nav">
                <button type="button" class="cal-nav-btn" id="calPrev" aria-label="Bulan sebelumnya">
                    <i class="bi bi-chevron-left"></i>
                </button>
                <button type="button" class="cal-nav-btn" id="calNext" aria-label="Bulan berikutnya">
                    <i class="bi bi-chevron-right"></i>
                </button>
            </div>
        </div>

        <div class="cal-weekdays" aria-hidden="true">
            <span>Min</span><span>Sen</span><span>Sel</span><span>Rab</span><span>Kam</span><span>Jum</span><span>Sab</span>
        </div>
        <div class="cal-days" id="calDays"></div>
    </div>

    <!-- Timeline -->
    <div class="content-card">
        <div class="card-header">
            <div>
                <h2>Timeline</h2>
                <p>Daftar agenda pengujian berdasarkan tanggal.</p>
            </div>
        </div>

        <div class="jadwal-toolbar">
            <div class="documents-search jadwal-search">
                <i class="bi bi-search"></i>
                <input type="text" id="jadwalSearch" placeholder="Cari nama atau NIM mahasiswa">
            </div>

            <div class="documents-filter-group">
                <button type="button" class="jadwal-btn" id="rangeBtn">
                    <span id="rangeLabel">30 Hari ke Depan</span>
                </button>
                <div class="documents-filter-dropdown" id="rangeDropdown">
                    <div class="filter-option" data-value="7">7 Hari ke Depan</div>
                    <div class="filter-option active" data-value="30">30 Hari ke Depan</div>
                    <div class="filter-option" data-value="0">Semua Jadwal</div>
                </div>
            </div>

            <button type="button" class="jadwal-btn" id="jadwalSort" aria-label="Urutkan tanggal, terdekat dulu">
                Urutkan Tanggal
                <i class="bi bi-sort-down-alt" id="jadwalSortIcon"></i>
            </button>

            <button type="button" class="jadwal-chip" id="clearDate" hidden>
                <span id="clearDateLabel"></span>
                <i class="bi bi-x-lg"></i>
            </button>
        </div>

        <div id="jadwalList">
            <?php foreach ($jadwal as $tgl => $grup) : ?>
                <section class="jadwal-group" data-date="<?= htmlspecialchars($tgl) ?>">
                    <h3 class="jadwal-group-title">
                        <span><?= htmlspecialchars($grup['label']) ?></span>
                        <button type="button" class="jadwal-btn" data-open-detail data-date="<?= htmlspecialchars($tgl) ?>">Lihat Aktivitas</button>
                    </h3>

                    <?php foreach ($grup['items'] as $j) :
                        $st = $statusMap[$j['status']] ?? ['label' => $j['status'], 'class' => 'finished'];
                    ?>
                        <article class="jadwal-item" data-search="<?= htmlspecialchars(mb_strtolower($j['nama'] . ' ' . $j['nim'])) ?>">
                            <div class="jadwal-item-main">
                                <h4 class="jadwal-nama"><?= htmlspecialchars($j['nama']) ?></h4>
                                <p class="jadwal-sub"><?= htmlspecialchars($j['nim']) ?> &middot; <?= htmlspecialchars($j['jenis']) ?></p>
                                <p class="jadwal-judul"><?= htmlspecialchars($j['judul']) ?></p>
                                <div class="jadwal-info">
                                    <span><i class="bi bi-clock"></i> <?= htmlspecialchars($j['mulai']) ?>&ndash;<?= htmlspecialchars($j['selesai']) ?> WIB</span>
                                    <span><i class="bi bi-geo-alt"></i> <?= htmlspecialchars($j['ruang']) ?></span>
                                    <strong class="jadwal-role ">
                                        Penguji <?= (int)$j['penguji'] ?>
                                    </strong>
                                </div>
                            </div>
                            <div class="jadwal-item-side">
                                <span class="jadwal-status <?= $st['class'] ?>"><?= htmlspecialchars($st['label']) ?></span>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </section>
            <?php endforeach; ?>

            <div class="card-empty" id="jadwalEmpty" style="display:none;">
                <span class="empty-icon"><i class="bi bi-calendar-x"></i></span>
                <p>Tidak ada jadwal yang cocok</p>
                <span class="text-muted">Coba ubah kata kunci, rentang hari, atau tanggal.</span>
            </div>
        </div>
    </div>

    <p class="jadwal-note">
        <i class="bi bi-info-circle"></i>
        Perubahan waktu atau lokasi akan diinformasikan melalui notifikasi oleh koordinator.
    </p>
</div>

<!-- Popup detail aktivitas -->
<dialog class="modal-dialog" id="detailModal" data-base-url="<?= BASE_URL ?>" aria-labelledby="detailModalTitle">
    <div class="content-card tab-panel">
        <div class="card-header border-b">
            <h2 id="detailModalTitle"></h2>
            <button type="button" class="jadwal-btn" id="detailModalClose"><i class="bi bi-x" style="font-size: 1.2rem;"></i></button>
        </div>

        <div class="detail-list">
            <div class="documents-table-wrap">
                <table class="documents-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Waktu</th>
                            <th>Tempat</th>
                            <th>Mahasiswa</th>
                            <th>Dosen Pembimbing</th>
                            <th>Dosen Penguji</th>
                            <th>Jenis Kegiatan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="detailTbody"></tbody>
                </table>
            </div>
        </div>
    </div>
</dialog>

<!-- Popup Konfirmasi Hapus -->
<dialog class="action-confirm-dialog" id="deleteConfirmModal">
    <form id="deleteConfirmForm" method="POST">

        <h3>Hapus kegiatan ini?</h3>

        <p>
            Kegiatan yang dihapus tidak dapat dikembalikan.
        </p>

        <div class="action-confirm-actions">
            <button type="button" class="action-cancel-btn" id="cancelDeleteBtn">
                Batal
            </button>

            <button type="submit" class="action-delete-btn">
                Hapus
            </button>
        </div>

    </form>
</dialog>

<script type="application/json" id="jadwalDetailData">
    <?= json_encode($detailData, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_UNESCAPED_UNICODE) ?>
</script>
<script src="<?= BASE_URL ?>/scripts/jadwal-timeline.js"></script>
<script src="<?= BASE_URL ?>/scripts/jadwal-detail.js"></script>

<?php require_once __DIR__ . '/../../layout/footer.php'; ?>