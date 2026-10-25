<?php require_once __DIR__ . '/../layout/header.php'; ?>

<?php
$statusMap = [
    'selesai'       => ['label' => 'Selesai',       'class' => 'finished'],
    'terkonfirmasi' => ['label' => 'Terkonfirmasi', 'class' => 'confirmed'],
];
?>

<div class="dashboard-container" id="jadwalApp" data-today="<?= htmlspecialchars($today) ?>">

    <!-- Kalender -->
    <div class="content-card jadwal-card">
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
    <div class="content-card jadwal-card">
        <div class="card-header jadwal-timeline-head">
            <div>
                <h2>Timeline</h2>
                <p>Daftar agenda pengujian berdasarkan tanggal.</p>
            </div>
        </div>

        <div class="jadwal-toolbar">
            <div class="logbook-search jadwal-search">
                <i class="bi bi-search"></i>
                <input type="text" id="jadwalSearch" placeholder="Cari nama atau NIM mahasiswa">
            </div>

            <div class="logbook-filter-group">
                <button type="button" class="jadwal-btn" id="rangeBtn">
                    <span id="rangeLabel">30 Hari ke Depan</span>
                </button>
                <div class="logbook-filter-dropdown" id="rangeDropdown">
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
            <?php foreach ($jadwal as $tgl => $grup): ?>
            <section class="jadwal-group" data-date="<?= htmlspecialchars($tgl) ?>">
                <h3 class="jadwal-group-title"><?= htmlspecialchars($grup['label']) ?></h3>

                <?php foreach ($grup['items'] as $j):
                    $st = $statusMap[$j['status']] ?? ['label' => $j['status'], 'class' => 'finished'];
                ?>
                <article class="jadwal-item"
                         data-search="<?= htmlspecialchars(mb_strtolower($j['nama'] . ' ' . $j['nim'])) ?>">
                    <div class="jadwal-item-main">
                        <h4 class="jadwal-nama"><?= htmlspecialchars($j['nama']) ?></h4>
                        <p class="jadwal-sub"><?= htmlspecialchars($j['nim']) ?> &middot; <?= htmlspecialchars($j['jenis']) ?></p>
                        <p class="jadwal-judul"><?= htmlspecialchars($j['judul']) ?></p>
                        <div class="jadwal-info">
                            <span><i class="bi bi-clock"></i> <?= htmlspecialchars($j['mulai']) ?>&ndash;<?= htmlspecialchars($j['selesai']) ?> WIB</span>
                            <span><i class="bi bi-geo-alt"></i> <?= htmlspecialchars($j['ruang']) ?></span>
                            <strong class="jadwal-role<?= (int)$j['penguji'] === 1 ? ' is-primary' : '' ?>">
                                Penguji <?= (int)$j['penguji'] ?>
                            </strong>
                        </div>
                    </div>
                    <div class="jadwal-item-side">
                        <span class="jadwal-status <?= $st['class'] ?>"><?= htmlspecialchars($st['label']) ?></span>
                        <!-- TODO: arahkan ke halaman aktivitas, pakai data-id -->
                        <button type="button" class="jadwal-btn" data-id="<?= (int)$j['id'] ?>">Lihat Aktivitas</button>
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

<script>
(() => {
    const MONTHS = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    const SHORT_MONTHS = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];

    const today = document.getElementById('jadwalApp').dataset.today; // YYYY-MM-DD
    const groups = [...document.querySelectorAll('.jadwal-group')];
    const eventDates = new Set(groups.map(group => group.dataset.date));

    const elements = {
        calTitle: document.getElementById('calTitle'),
        calDays: document.getElementById('calDays'),
        calPrev: document.getElementById('calPrev'),
        calNext: document.getElementById('calNext'),
        search: document.getElementById('jadwalSearch'),
        rangeBtn: document.getElementById('rangeBtn'),
        rangeLabel: document.getElementById('rangeLabel'),
        rangeDropdown: document.getElementById('rangeDropdown'),
        rangeOptions: document.querySelectorAll('#rangeDropdown .filter-option'),
        sortBtn: document.getElementById('jadwalSort'),
        sortIcon: document.getElementById('jadwalSortIcon'),
        clearBtn: document.getElementById('clearDate'),
        clearLabel: document.getElementById('clearDateLabel'),
        list: document.getElementById('jadwalList'),
        empty: document.getElementById('jadwalEmpty'),
    };

    const [todayYear, todayMonth] = today.split('-').map(Number);
    const calendar = { year: todayYear, month: todayMonth - 1 };

    const state = {
        search: '',
        range: 30, // 0 = all
        sortAsc: true,
        selectedDate: '',
    };

    /* ---------- Date helpers ---------- */
    const pad = (number) => String(number).padStart(2, '0');

    const formatKey = (year, month, day) => `${year}-${pad(month + 1)}-${pad(day)}`;

    const addDays = (key, days) => {
        const date = new Date(`${key}T00:00:00`);
        date.setDate(date.getDate() + days);
        return formatKey(date.getFullYear(), date.getMonth(), date.getDate());
    };

    const formatShortDate = (key) => {
        const [year, month, day] = key.split('-').map(Number);
        return `${day} ${SHORT_MONTHS[month - 1]} ${year}`;
    };

    /* ---------- Calendar ---------- */
    function createCell(child) {
        const cell = document.createElement('span');
        cell.className = 'cal-cell';
        if (child) cell.append(child);
        return cell;
    }

    function createDayButton(day) {
        const key = formatKey(calendar.year, calendar.month, day);
        const hasEvent = eventDates.has(key);
        const isSelected = key === state.selectedDate;

        const button = document.createElement('button');
        button.type = 'button';
        button.className = 'cal-day';
        button.textContent = day;
        button.disabled = !hasEvent;
        button.classList.toggle('has-event', hasEvent);
        button.classList.toggle('is-today', key === today);
        button.classList.toggle('is-selected', isSelected);

        if (hasEvent) {
            button.setAttribute('aria-pressed', isSelected);
            button.addEventListener('click', () => selectDate(isSelected ? '' : key));
        }

        return button;
    }

    function renderCalendar() {
        const { year, month } = calendar;
        const firstWeekday = new Date(year, month, 1).getDay(); // 0 = Sunday
        const totalDays = new Date(year, month + 1, 0).getDate();

        elements.calTitle.textContent = `${MONTHS[month]} ${year}`;
        elements.calDays.replaceChildren();

        for (let i = 0; i < firstWeekday; i++) {
            elements.calDays.append(createCell());
        }
        for (let day = 1; day <= totalDays; day++) {
            elements.calDays.append(createCell(createDayButton(day)));
        }
    }

    function changeMonth(step) {
        const date = new Date(calendar.year, calendar.month + step, 1);
        calendar.year = date.getFullYear();
        calendar.month = date.getMonth();
        renderCalendar();
    }

    function selectDate(key) {
        state.selectedDate = key;
        elements.clearBtn.hidden = !key;
        if (key) elements.clearLabelements.textContent = formatShortDate(key);

        renderCalendar();
        renderTimeline();
    }

    /* ---------- Timeline ---------- */
    function isDateVisible(date) {
        if (state.selectedDate) return date === state.selectedDate;
        if (state.range === 0) return true;
        return date >= today && date <= addDays(today, state.range);
    }

    function matchesSearch(item) {
        return item.dataset.search.includes(state.search);
    }

    function sortGroups() {
        const sorted = [...groups].sort((a, b) => a.dataset.date.localeCompare(b.dataset.date));
        if (!state.sortAsc) sorted.reverse();
        sorted.forEach(group => elements.list.insertBefore(group, elements.empty));
    }

    function renderTimeline() {
        sortGroups();

        let total = 0;

        groups.forEach(group => {
            const dateVisible = isDateVisible(group.dataset.date);
            let shown = 0;

            group.querySelectorAll('.jadwal-item').forEach(item => {
                item.hidden = !(dateVisible && matchesSearch(item));
                if (!item.hidden) shown++;
            });

            group.hidden = shown === 0;
            total += shown;
        });

        elements.empty.style.display = total === 0 ? 'flex' : 'none';
    }

    function updateSortButton() {
        elements.sortIcon.className = state.sortAsc ? 'bi bi-sort-down-alt' : 'bi bi-sort-up-alt';
        elements.sortBtn.setAttribute(
            'aria-label',
            state.sortAsc ? 'Urutkan tanggal, terdekat dulu' : 'Urutkan tanggal, terjauh dulu'
        );
    }

    /* ---------- Events ---------- */
    function bindEvents() {
        elements.calPrev.addEventListener('click', () => changeMonth(-1));
        elements.calNext.addEventListener('click', () => changeMonth(1));

        elements.search.addEventListener('input', () => {
            state.search = elements.search.value.toLowerCase().trim();
            renderTimeline();
        });

        elements.rangeBtn.addEventListener('click', (event) => {
            event.stopPropagation();
            elements.rangeDropdown.classList.toggle('open');
        });
        document.addEventListener('click', () => elements.rangeDropdown.classList.remove('open'));

        elements.rangeOptions.forEach(option => {
            option.addEventListener('click', () => {
                elements.rangeOptions.forEach(other => other.classList.toggle('active', other === option));
                state.range = Number(option.dataset.value);
                elements.rangeLabelements.textContent = option.textContent;
                elements.rangeDropdown.classList.remove('open');
                renderTimeline();
            });
        });

        elements.sortBtn.addEventListener('click', () => {
            state.sortAsc = !state.sortAsc;
            updateSortButton();
            renderTimeline();
        });

        elements.clearBtn.addEventListener('click', () => selectDate(''));
    }

    bindEvents();
    renderCalendar();
    renderTimeline();
})();
</script>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>