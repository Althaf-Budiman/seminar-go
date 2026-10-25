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
        <div class="logbook-toolbar">
            <div class="logbook-search">
                <i class="bi bi-search"></i>
                <input type="text" id="logbookSearch" placeholder="Cari jenis dokumen atau nama...">
            </div>
            <div class="logbook-filter-group">
                <button class="logbook-filter-btn" id="filterDropdownBtn" data-value="">
                    <i class="bi bi-funnel"></i>
                    <span id="filterLabel">Semua Jenis</span>
                    <i class="bi bi-chevron-down" style="font-size:0.7rem;"></i>
                </button>
                <div class="logbook-filter-dropdown" id="filterDropdown">
                    <div class="filter-option active" data-value="">Semua Jenis</div>
                    <div class="filter-option" data-value="Bimbingan Proposal">Bimbingan Proposal</div>
                    <div class="filter-option" data-value="Logbook Mingguan">Logbook Mingguan</div>
                    <div class="filter-option" data-value="Bimbingan Skripsi">Bimbingan Skripsi</div>
                </div>
            </div>
            <button class="logbook-filter-btn" id="sortBtn">
                <i class="bi bi-sort-down-alt"></i>
                <span id="sortLabel">Terbaru</span>
            </button>
            <button class="logbook-filter-btn" id="btnUnduhSemua">
                <i class="bi bi-download"></i>
                Unduh Semua
            </button>
        </div>

        <!-- Table -->
        <div class="logbook-table-wrap">
            <table class="logbook-table">
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
                <tbody id="logbookTbody">
                    <?php foreach ($logbooks as $lb): ?>
                        <tr class="logbook-row"
                            data-jenis="<?= htmlspecialchars($lb['jenis']) ?>"
                            data-search="<?= strtolower(htmlspecialchars($lb['jenis'] . ' ' . $lb['nama_mahasiswa'] . ' ' . $lb['file'])) ?>">
                            <td class="td-no"><?= (int)$lb['id'] ?></td>
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
            <div class="logbook-empty" id="logbookEmpty" style="display:none;">
                <i class="bi bi-inbox"></i>
                <p>Tidak ada data yang ditemukan</p>
            </div>
        </div>

        <!-- Pagination Footer -->
        <div class="logbook-pagination-bar">
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
<script>
    (() => {
        const ELLIPSIS = '…';

        const rows = [...document.querySelectorAll('#logbookTbody .logbook-row')];

        const el = {
            search: document.getElementById('logbookSearch'),
            filterBtn: document.getElementById('filterDropdownBtn'),
            filterLabel: document.getElementById('filterLabel'),
            filterDropdown: document.getElementById('filterDropdown'),
            filterOptions: document.querySelectorAll('#filterDropdown .filter-option'),
            sortBtn: document.getElementById('sortBtn'),
            sortLabel: document.getElementById('sortLabel'),
            sortIcon: document.querySelector('#sortBtn i'),
            rowsPerPage: document.getElementById('rowsPerPage'),
            pageInfo: document.getElementById('pagInfo'),
            first: document.getElementById('pagFirst'),
            prev: document.getElementById('pagPrev'),
            next: document.getElementById('pagNext'),
            last: document.getElementById('pagLast'),
            numbers: document.getElementById('pagNumbers'),
            empty: document.getElementById('logbookEmpty'),
        };

        const state = {
            filter: '',
            search: '',
            sortAsc: false,
            page: 1,
            perPage: Number(el.rowsPerPage.value),
        };

        /* ---------- Data ---------- */
        function getFilteredRows() {
            const result = rows.filter(row => {
                const matchesFilter = !state.filter || row.dataset.jenis === state.filter;
                const matchesSearch = row.dataset.search.includes(state.search);
                return matchesFilter && matchesSearch;
            });

            return state.sortAsc ? result.reverse() : result;
        }

        const getMaxPage = (total) => Math.max(1, Math.ceil(total / state.perPage));

        const range = (from, to) => Array.from({
            length: to - from + 1
        }, (_, i) => from + i);

        function getPageNumbers(current, max) {
            if (max <= 7) return range(1, max);
            if (current <= 4) return [...range(1, 5), ELLIPSIS, max];
            if (current >= max - 3) return [1, ELLIPSIS, ...range(max - 4, max)];
            return [1, ELLIPSIS, ...range(current - 1, current + 1), ELLIPSIS, max];
        }

        /* ---------- Render ---------- */
        function createPageItem(page) {
            if (page === ELLIPSIS) {
                const dots = document.createElement('span');
                dots.className = 'pag-btn';
                dots.textContent = ELLIPSIS;
                dots.style.cssText = 'cursor: default; pointer-events: none;';
                return dots;
            }

            const button = document.createElement('button');
            button.className = 'pag-btn';
            button.classList.toggle('active', page === state.page);
            button.textContent = page;
            button.addEventListener('click', () => goToPage(page));
            return button;
        }

        function renderRows(pageRows, start) {
            rows.forEach(row => {
                row.style.display = 'none';
            });

            pageRows.forEach((row, index) => {
                row.style.display = '';
                row.querySelector('.td-no').textContent = start + index + 1;
            });
        }

        function renderPagination(total, maxPage, start, end) {
            const from = total === 0 ? 0 : start + 1;
            const to = Math.min(end, total);
            const isFirstPage = state.page === 1;
            const isLastPage = state.page === maxPage;

            el.pageInfo.textContent = `Menampilkan ${from}–${to} dari ${total} entri`;

            el.first.disabled = isFirstPage;
            el.prev.disabled = isFirstPage;
            el.next.disabled = isLastPage;
            el.last.disabled = isLastPage;

            el.numbers.replaceChildren(...getPageNumbers(state.page, maxPage).map(createPageItem));
        }

        function render() {
            const filteredRows = getFilteredRows();
            const total = filteredRows.length;
            const maxPage = getMaxPage(total);

            state.page = Math.min(Math.max(state.page, 1), maxPage);

            const start = (state.page - 1) * state.perPage;
            const end = start + state.perPage;

            renderRows(filteredRows.slice(start, end), start);
            renderPagination(total, maxPage, start, end);
            el.empty.style.display = total === 0 ? 'flex' : 'none';
        }

        function goToPage(page) {
            state.page = page;
            render();
        }

        function resetAndRender() {
            goToPage(1);
        }

        /* ---------- Events ---------- */
        function bindEvents() {
            el.search.addEventListener('input', () => {
                state.search = el.search.value.toLowerCase().trim();
                resetAndRender();
            });

            el.filterBtn.addEventListener('click', (event) => {
                event.stopPropagation();
                el.filterDropdown.classList.toggle('open');
            });
            document.addEventListener('click', () => el.filterDropdown.classList.remove('open'));

            el.filterOptions.forEach(option => {
                option.addEventListener('click', () => {
                    el.filterOptions.forEach(other => other.classList.toggle('active', other === option));
                    state.filter = option.dataset.value;
                    el.filterLabel.textContent = option.textContent;
                    el.filterBtn.classList.toggle('active-filter', Boolean(state.filter));
                    el.filterDropdown.classList.remove('open');
                    resetAndRender();
                });
            });

            el.sortBtn.addEventListener('click', () => {
                state.sortAsc = !state.sortAsc;
                el.sortLabel.textContent = state.sortAsc ? 'Terlama' : 'Terbaru';
                el.sortIcon.className = state.sortAsc ? 'bi bi-sort-up-alt' : 'bi bi-sort-down-alt';
                resetAndRender();
            });

            el.rowsPerPage.addEventListener('change', () => {
                state.perPage = Number(el.rowsPerPage.value);
                resetAndRender();
            });

            el.first.addEventListener('click', () => goToPage(1));
            el.prev.addEventListener('click', () => goToPage(state.page - 1));
            el.next.addEventListener('click', () => goToPage(state.page + 1));
            el.last.addEventListener('click', () => goToPage(getMaxPage(getFilteredRows().length)));
        }

        bindEvents();
        render();
    })();
</script>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>