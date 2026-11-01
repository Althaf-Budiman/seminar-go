(() => {
    const MONTHS = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    const SHORT_MONTHS = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];

    const today = document.getElementById('jadwalApp').dataset.today; // YYYY-MM-DD
    const groups = [...document.querySelectorAll('.jadwal-group')];
    const eventDates = new Set(groups.map(group => group.dataset.date));

    const el = {
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
    const calendar = {
        year: todayYear,
        month: todayMonth - 1
    };

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
        const {
            year,
            month
        } = calendar;
        const firstWeekday = new Date(year, month, 1).getDay(); // 0 = Sunday
        const totalDays = new Date(year, month + 1, 0).getDate();

        el.calTitle.textContent = `${MONTHS[month]} ${year}`;
        el.calDays.replaceChildren();

        for (let i = 0; i < firstWeekday; i++) {
            el.calDays.append(createCell());
        }
        for (let day = 1; day <= totalDays; day++) {
            el.calDays.append(createCell(createDayButton(day)));
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
        el.clearBtn.hidden = !key;
        if (key) el.clearLabel.textContent = formatShortDate(key);

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
        sorted.forEach(group => el.list.insertBefore(group, el.empty));
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

        el.empty.style.display = total === 0 ? 'flex' : 'none';
    }

    function updateSortButton() {
        el.sortIcon.className = state.sortAsc ? 'bi bi-sort-down-alt' : 'bi bi-sort-up-alt';
        el.sortBtn.setAttribute(
            'aria-label',
            state.sortAsc ? 'Urutkan tanggal, terdekat dulu' : 'Urutkan tanggal, terjauh dulu'
        );
    }

    /* ---------- Events ---------- */
    function bindEvents() {
        el.calPrev.addEventListener('click', () => changeMonth(-1));
        el.calNext.addEventListener('click', () => changeMonth(1));

        el.search.addEventListener('input', () => {
            state.search = el.search.value.toLowerCase().trim();
            renderTimeline();
        });

        el.rangeBtn.addEventListener('click', (event) => {
            event.stopPropagation();
            el.rangeDropdown.classList.toggle('open');
        });
        document.addEventListener('click', () => el.rangeDropdown.classList.remove('open'));

        el.rangeOptions.forEach(option => {
            option.addEventListener('click', () => {
                el.rangeOptions.forEach(other => other.classList.toggle('active', other === option));
                state.range = Number(option.dataset.value);
                el.rangeLabel.textContent = option.textContent;
                el.rangeDropdown.classList.remove('open');
                renderTimeline();
            });
        });

        el.sortBtn.addEventListener('click', () => {
            state.sortAsc = !state.sortAsc;
            updateSortButton();
            renderTimeline();
        });

        el.clearBtn.addEventListener('click', () => selectDate(''));
    }

    bindEvents();
    renderCalendar();
    renderTimeline();
})();