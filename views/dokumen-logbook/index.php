<?php require_once __DIR__ . '/../layout/header.php'; ?>

<div class="dashboard-container">
    <!-- Page Header -->
    <div class="content-card">
        <div class="card-header">
            <div>
                <h1>Logbook</h1>
                <p>Catat bimbingan, pantau progres, dan tindak lanjuti arahan pembimbing.</p>
            </div>
            <span class="badge primary">Semester Ganjil 2026/2027</span>
        </div>
    </div>

    <!-- Dokumen Logbook Table Card -->
    <div class="content-card" style="padding: 0; overflow: hidden;">
        <!-- Card Header -->
        <div class="card-header" style="padding: 1.35rem 1.75rem 1rem;">
            <div>
                <h2>Dokumen Logbook</h2>
                <p>Seluruh dokumen bimbingan yang tercatat atas nama Anda.</p>
            </div>
            <button class="btn-primary" id="btnTambahLogbook">
                <i class="bi bi-plus" style="color: white; font-size: 1.5rem; font-weight: 700;"></i>
                Tambah Logbook
            </button>
        </div>

        <!-- Toolbar -->
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
            <button class="documents-filter-btn" id="btnUnduhSemua">
                <i class="bi bi-download"></i>
                Unduh Semua
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
                    <?php foreach ($logbooks as $index => $lb): ?>
                        <tr class="documents-row"
                            data-jenis="<?= htmlspecialchars($lb['jenis']) ?>"
                            data-search="<?= strtolower(htmlspecialchars($lb['jenis'] . ' ' . $lb['nama_mahasiswa'] . ' ' . $lb['file'])) ?>">
                            <td class="td-no"><?= $index + 1 ?></td>
                            <td>
                                <span class="td-jenis"><?= htmlspecialchars($lb['jenis']) ?></span>
                                <a href="#" class="td-file">
                                    <i class="bi bi-paperclip"></i>
                                    <?= htmlspecialchars($lb['file']) ?>
                                </a>
                            </td>
                            <td>
                                <span class="td-date"><?= htmlspecialchars($lb['tanggal']) ?></span>
                                <span class="td-time"><?= htmlspecialchars($lb['jam']) ?></span>
                            </td>
                            <td><?= htmlspecialchars($lb['nama_mahasiswa']) ?></td>
                            <td><?= htmlspecialchars($lb['nim']) ?></td>
                            <td><?= htmlspecialchars($lb['prodi']) ?></td>
                            <td><?= htmlspecialchars($lb['kelas']) ?></td>
                            <td><?= htmlspecialchars($lb['tahun_ajaran']) ?></td>
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
    
</script>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>