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
                <p>Daftar agenda seminar dan sidang berdasarkan tanggal.</p>
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
                                    <strong class="jadwal-role">
                                        Penguji <?= (int)$j['penguji'] ?>
                                    </strong>
                                </div>
                            </div>
                            <div class="jadwal-item-side">
                                <span class="jadwal-status <?= htmlspecialchars($st['class']) ?>">
                                    <?= htmlspecialchars($st['label']) ?>
                                </span>
                                <button type="button" class="jadwal-btn <?= $j['status'] === 'terkonfirmasi' ? 'jadwal-btn-active' : '' ?>" data-open-detail data-date="<?= htmlspecialchars($tgl) ?>" data-highlight-id="<?= (int)$j['id'] ?>">
                                    Lihat Aktivitas
                                </button>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </section>
            <?php endforeach; ?>
        </div>
    </div>

</div>

<!-- Popup Detail Aktivitas -->
<dialog class="modal-dialog" id="detailModal">
    <div class="modal-content">
        <div class="modal-header">
            <div>
                <h3 id="modalDateLabel">Aktivitas</h3>
                <p>Jadwal seminar dan sidang pada tanggal ini.</p>
            </div>
            <button type="button" class="modal-close-btn" id="closeModalBtn" aria-label="Tutup popup">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
        <div class="modal-body">
            <div class="modal-table-wrap">
                <table class="modal-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Waktu</th>
                            <th>Tempat</th>
                            <th>Mahasiswa</th>
                            <th>Dosen Pembimbing</th>
                            <th>Dosen Penguji</th>
                            <th>Jenis Kegiatan</th>
                        </tr>
                    </thead>
                    <tbody id="detailTbody"></tbody>
                </table>
            </div>
        </div>
    </div>
</dialog>

<script type="application/json" id="jadwalDetailData">
    <?= json_encode($detailData, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_UNESCAPED_UNICODE) ?>
</script>
<script src="<?= BASE_URL ?>/scripts/jadwal-timeline.js"></script>
<script src="<?= BASE_URL ?>/scripts/jadwal-detail.js"></script>

<?php require_once __DIR__ . '/../../layout/footer.php'; ?>