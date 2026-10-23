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
(function () {
    var rows       = Array.from(document.querySelectorAll('#logbookTbody .logbook-row'));
    var searchEl   = document.getElementById('logbookSearch');
    var filterBtn  = document.getElementById('filterDropdownBtn');
    var filterLbl  = document.getElementById('filterLabel');
    var filterDD   = document.getElementById('filterDropdown');
    var filterOpts = document.querySelectorAll('.filter-option');
    var sortBtn    = document.getElementById('sortBtn');
    var sortLbl    = document.getElementById('sortLabel');
    var rowsSel    = document.getElementById('rowsPerPage');
    var pagInfo    = document.getElementById('pagInfo');
    var pagFirst   = document.getElementById('pagFirst');
    var pagPrev    = document.getElementById('pagPrev');
    var pagNext    = document.getElementById('pagNext');
    var pagLast    = document.getElementById('pagLast');
    var pagNums    = document.getElementById('pagNumbers');
    var emptyEl    = document.getElementById('logbookEmpty');

    var state = {
        filter: '',
        search: '',
        sortAsc: false,
        page: 1,
        perPage: parseInt(rowsSel.value)
    };

    function filtered() {
        var r = rows.filter(function(row) {
            var jOk = !state.filter || row.dataset.jenis === state.filter;
            var sOk = !state.search || row.dataset.search.includes(state.search);
            return jOk && sOk;
        });
        if (state.sortAsc) r = r.slice().reverse();
        return r;
    }

    function pageRange(cur, max) {
        if (max <= 7) {
            var p = []; for (var i = 1; i <= max; i++) p.push(i); return p;
        }
        var pages = [];
        if (cur <= 4) {
            for (var i = 1; i <= 5; i++) pages.push(i);
            pages.push('…'); pages.push(max);
        } else if (cur >= max - 3) {
            pages.push(1); pages.push('…');
            for (var i = max - 4; i <= max; i++) pages.push(i);
        } else {
            pages.push(1); pages.push('…');
            for (var i = cur - 1; i <= cur + 1; i++) pages.push(i);
            pages.push('…'); pages.push(max);
        }
        return pages;
    }

    function render() {
        var f      = filtered();
        var total  = f.length;
        var maxPg  = Math.max(1, Math.ceil(total / state.perPage));
        if (state.page > maxPg) state.page = maxPg;

        var start = (state.page - 1) * state.perPage;
        var end   = start + state.perPage;
        var slice = f.slice(start, end);

        rows.forEach(function(r) { r.style.display = 'none'; });
        slice.forEach(function(r, i) {
            r.style.display = '';
            r.querySelector('.td-no').textContent = start + i + 1;
        });

        emptyEl.style.display = total === 0 ? 'flex' : 'none';

        var from = total === 0 ? 0 : start + 1;
        var to   = Math.min(end, total);
        pagInfo.textContent = 'Menampilkan ' + from + '\u2013' + to + ' dari ' + total + ' entri';

        pagFirst.disabled = state.page === 1;
        pagPrev.disabled  = state.page === 1;
        pagNext.disabled  = state.page === maxPg;
        pagLast.disabled  = state.page === maxPg;

        pagNums.innerHTML = '';
        pageRange(state.page, maxPg).forEach(function(p) {
            if (p === '…') {
                var sp = document.createElement('span');
                sp.className = 'pag-btn'; sp.textContent = '…';
                sp.style.cursor = 'default'; sp.style.pointerEvents = 'none';
                pagNums.appendChild(sp);
            } else {
                var btn = document.createElement('button');
                btn.className = 'pag-btn' + (p === state.page ? ' active' : '');
                btn.textContent = p;
                btn.addEventListener('click', (function(pg) {
                    return function() { state.page = pg; render(); };
                })(p));
                pagNums.appendChild(btn);
            }
        });
    }

    // Search
    searchEl.addEventListener('input', function() {
        state.search = searchEl.value.toLowerCase().trim();
        state.page = 1; render();
    });

    // Filter dropdown
    filterBtn.addEventListener('click', function(e) {
        e.stopPropagation();
        filterDD.classList.toggle('open');
    });
    document.addEventListener('click', function() { filterDD.classList.remove('open'); });

    filterOpts.forEach(function(opt) {
        opt.addEventListener('click', function() {
            filterOpts.forEach(function(o) { o.classList.remove('active'); });
            opt.classList.add('active');
            state.filter = opt.dataset.value;
            filterLbl.textContent = opt.textContent;
            filterDD.classList.remove('open');
            if (state.filter) filterBtn.classList.add('active-filter');
            else filterBtn.classList.remove('active-filter');
            state.page = 1; render();
        });
    });

    // Sort
    sortBtn.addEventListener('click', function() {
        state.sortAsc = !state.sortAsc;
        sortLbl.textContent = state.sortAsc ? 'Terlama' : 'Terbaru';
        var icon = sortBtn.querySelector('i');
        icon.className = state.sortAsc ? 'bi bi-sort-up-alt' : 'bi bi-sort-down-alt';
        state.page = 1; render();
    });

    // Rows per page
    rowsSel.addEventListener('change', function() {
        state.perPage = parseInt(rowsSel.value);
        state.page = 1; render();
    });

    // Pagination buttons
    pagFirst.addEventListener('click', function() { state.page = 1; render(); });
    pagPrev.addEventListener('click',  function() { if (state.page > 1) { state.page--; render(); } });
    pagNext.addEventListener('click',  function() { state.page++; render(); });
    pagLast.addEventListener('click',  function() {
        state.page = Math.max(1, Math.ceil(filtered().length / state.perPage));
        render();
    });

    render();
})();
</script>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>