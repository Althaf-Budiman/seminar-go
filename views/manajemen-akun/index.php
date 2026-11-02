<?php require_once __DIR__ . '/../layout/header.php'; ?>

<div class="dashboard-container">

    <!-- Header halaman -->
    <div style="display: flex; justify-content: space-between; ">
        <h1>Manajemen Akun</h1>
        <button class="btn-primary" id="btnTambahAkun">
            Tambah Akun
        </button>
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
                    <span id="filterLabel">Semua Role</span>
                    <i class="bi bi-chevron-down" style="font-size:0.7rem;"></i>
                </button>
                <div class="documents-filter-dropdown" id="filterDropdown">
                    <div class="filter-option active" data-value="">Semua Role</div>
                    <div class="filter-option" data-value="Mahasiswa">Mahasiswa</div>
                    <div class="filter-option" data-value="Dosen Pembimbing">Dosen Pembimbing</div>
                    <div class="filter-option" data-value="Dosen Penguji">Dosen Penguji</div>
                    <div class="filter-option" data-value="Admin">Admin</div>
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
            <table class="documents-table" style="width: 100%;">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>NIM/NIP</th>
                        <th>NAMA</th>
                        <th>EMAIL</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($accounts as $index => $account): ?>
                        <tr class="documents-row"
                            data-search="<?= strtolower(htmlspecialchars($account['nama'])); ?>">
                            <td class="td-no"><?= $index + 1 ?></td>
                            <td>
                                <span class="td-jenis"><?= htmlspecialchars($account['identification_number']) ?></span>
                            </td>
                            <td>
                                <span class="td-date"><?= htmlspecialchars($account['nama']) ?></span>
                            </td>
                            <td><?= htmlspecialchars($account['email']) ?></td>

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

<?php require_once __DIR__ . '/../layout/footer.php'; ?>