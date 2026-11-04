(() => {
        const ELLIPSIS = '…';

        const rows = [...document.querySelectorAll('.documents-row')];

        const el = {
            search: document.getElementById('documentSearch'),
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