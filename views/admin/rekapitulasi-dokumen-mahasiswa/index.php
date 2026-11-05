<?php require_once __DIR__ . '/../../layout/header.php'; ?>


<div class="dashboard-container">

    <!-- List pendaftaran menunggu verifikasi -->
    <div class="content-card">
        <div class="card-header">
            <h2>Pendaftaran Menunggu Verifikasi</h2>
            <div class="badge primary" id="pendaftaranMenungguVerifikasi"><?= count($pendaftaranMenungguVerifikasi) ?> pendaftaran</div>
        </div>

        <div class="list">
            <?php
            foreach ($pendaftaranMenungguVerifikasi as $index => $pendaftaran) :
            ?>
                <div class="list-item <?= htmlspecialchars($index + 1) == 1 ? 'active' : '' ?>">
                    <div class="list-item-left">
                        <span class="list-item-num"><?= htmlspecialchars($index + 1) ?></span>
                        <div>
                            <h3><?= htmlspecialchars($pendaftaran['nama']) ?> (<?= htmlspecialchars($pendaftaran['nim']) ?>) <?= htmlspecialchars($pendaftaran['jenis']) ?></h3>
                        </div>
                    </div>

                    <div style="display: flex; gap: 1rem; align-items: center;">
                        <div class="badge <?= htmlspecialchars($index + 1) == 1 ? 'primary' : 'neutral' ?>">Syarat Terpenuhi</div>
                        <button class="btn-primary" type="button">Buat Jadwal</button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Dokumen  Table Card -->
    <div class="content-card" style="padding: 1rem 0; overflow: hidden;">
        <!-- Table -->
        <div class="documents-toolbar">
            <div class="documents-search">
                <i class="bi bi-search"></i>
                <input type="text" id="documentSearch" placeholder="Cari jenis dokumen atau nama...">
            </div>
            <div class="documents-filter-group">
                <button class="documents-filter-btn" id="filterDropdownBtn" data-value="">
                    <i class="bi bi-funnel"></i>
                    <span id="filterLabel">Semua Jenis</span>
                    <i class="bi bi-chevron-down" style="font-size:0.7rem;"></i>
                </button>
                <div class="documents-filter-dropdown" id="filterDropdown">
                    <div class="filter-option active" data-value="">Semua Jenis</div>
                    <div class="filter-option" data-value="Bimbingan Proposal">Bimbingan Proposal</div>
                    <div class="filter-option" data-value="Logbook Mingguan">Logbook Mingguan</div>
                    <div class="filter-option" data-value="Bimbingan Skripsi">Bimbingan Skripsi</div>
                </div>
            </div>
            <button class="documents-filter-btn" id="sortBtn">
                <i class="bi bi-sort-down-alt"></i>
                <span id="sortLabel">Terbaru</span>
            </button>
        </div>

        <!-- Table -->
        <div class="documents-table-wrap">
            <table class="documents-table">
                <thead>
                    <tr>
                        <th style="width:48px;">NO</th>
                        <th>JENIS DOKUMEN</th>
                        <th>TANGGAL</th>
                        <th>NAMA MAHASISWA</th>
                        <th>NIM</th>
                        <th>PRODI</th>
                        <th>KELAS</th>
                        <th>TAHUN AJARAN</th>
                        <th style="width:100px;">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($documents as $index => $document) : ?>
                        <tr class="documents-row" data-jenis="<?= htmlspecialchars($document['jenis']) ?>" data-search="<?= strtolower(htmlspecialchars($document['jenis'] . ' ' . $document['nama_mahasiswa'] . ' ' . $document['file'])) ?>">
                            <td class="td-no"><?= $index + 1 ?></td>
                            <td>
                                <span class="td-jenis"><?= htmlspecialchars($document['jenis']) ?></span>
                            </td>
                            <td>
                                <span class="td-date"><?= htmlspecialchars($document['tanggal']) ?></span>
                            </td>
                            <td><?= htmlspecialchars($document['nama_mahasiswa']) ?></td>
                            <td><?= htmlspecialchars($document['nim']) ?></td>
                            <td><?= htmlspecialchars($document['prodi']) ?></td>
                            <td><?= htmlspecialchars($document['kelas']) ?></td>
                            <td><?= htmlspecialchars($document['tahun_ajaran']) ?></td>
                            <td>
                                <button class="btn-unduh">
                                    <i class="bi bi-download"></i> Unduh
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="documents-empty" id="logbookEmpty" style="display:none;">
                <i class="bi bi-inbox"></i>
                <p>Tidak ada data yang ditemukan</p>
            </div>
        </div>

        <!-- Pagination Footer -->
        <div class="documents-pagination-bar">
            <div class="pag-left">
                <span class="pag-label">Baris per halaman:</span>
                <div class="pag-perpage-wrap">
                    <select id="rowsPerPage">
                        <option value="5" selected>5</option>
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                    </select>
                    <i class="bi bi-chevron-down pag-select-arrow"></i>
                </div>
            </div>
            <div class="pag-center">
                <span id="pagInfo">Menampilkan 1–10 dari 0 entri</span>
            </div>
            <div class="pag-right">
                <button class="pag-btn" id="pagFirst">«</button>
                <button class="pag-btn" id="pagPrev">&lt;</button>
                <div id="pagNumbers" class="pag-numbers"></div>
                <button class="pag-btn" id="pagNext">&gt;</button>
                <button class="pag-btn" id="pagLast">»</button>
            </div>
        </div>
    </div>
</div>

<script src="<?= BASE_URL ?>/scripts/table.js"></script>
<?php require_once __DIR__ . '/../../layout/footer.php'; ?>