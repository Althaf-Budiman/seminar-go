
(() => {
    const MONTHS = [
        'Januari', 'Februari', 'Maret', 'April',
        'Mei', 'Juni', 'Juli', 'Agustus',
        'September', 'Oktober', 'November', 'Desember'
    ];

    const pad = value => String(value).padStart(2, '0');
    const formatKey = (year, month, day) => `${year}-${pad(month + 1)}-${pad(day)}`;
    const parseDate = key => {
        const [year, month, day] = key.split('-').map(Number);
        return new Date(year, month - 1, day);
    };

    document.querySelectorAll('[data-beranda-calendar]').forEach(root => {
        let events = [];

        try {
            events = JSON.parse(root.dataset.events || '[]');
        } catch (error) {
            console.error('Data kalender tidak valid:', error);
        }

        const today = root.dataset.today;
        const eventsByDate = new Map();

        events.forEach(event => {
            const start = event.tanggal_mulai || event.tanggal;
            const end = event.tanggal_selesai || start;

            if (!start || !end || !/^\d{4}-\d{2}-\d{2}$/.test(start) ||
                !/^\d{4}-\d{2}-\d{2}$/.test(end) || end < start) return;

            const startDate = parseDate(start);
            const endDate = parseDate(end);

            for (
                let date = new Date(startDate);
                date <= endDate;
                date.setDate(date.getDate() + 1)
            ) {
                const key = formatKey(date.getFullYear(), date.getMonth(), date.getDate());

                if (!eventsByDate.has(key)) {
                    eventsByDate.set(key, []);
                }

                eventsByDate.get(key).push(event);
            }
        });

        const upcomingDate = [...eventsByDate.keys()]
            .filter(date => date >= today)
            .sort()[0];

        let selectedDate = eventsByDate.has(today) ? today : (upcomingDate || today);

        const initialDate = parseDate(selectedDate);
        const calendar = {
            year: initialDate.getFullYear(),
            month: initialDate.getMonth()
        };

        const el = {
            title: root.querySelector('[data-calendar-title]'),
            days: root.querySelector('[data-calendar-days]'),
            prev: root.querySelector('[data-calendar-prev]'),
            next: root.querySelector('[data-calendar-next]'),
            list: root.querySelector('[data-calendar-list]'),
            empty: root.querySelector('[data-calendar-empty]')
        };

        function createCell(child = null) {
            const cell = document.createElement('span');
            cell.className = 'cal-cell';
            if (child) cell.append(child);
            return cell;
        }

        function renderCalendar() {
            const { year, month } = calendar;
            const firstWeekday = new Date(year, month, 1).getDay();
            const totalDays = new Date(year, month + 1, 0).getDate();

            el.title.textContent = `${MONTHS[month]} ${year}`;
            el.days.replaceChildren();

            for (let i = 0; i < firstWeekday; i++) {
                el.days.append(createCell());
            }

            for (let day = 1; day <= totalDays; day++) {
                const key = formatKey(year, month, day);
                const hasEvent = eventsByDate.has(key);

                const button = document.createElement('button');
                button.type = 'button';
                button.className = 'cal-day';
                button.textContent = day;
                button.disabled = !hasEvent;

                button.classList.toggle('has-event', hasEvent);
                button.classList.toggle('is-today', key === today);
                button.classList.toggle('is-selected', key === selectedDate);

                if (hasEvent) {
                    button.setAttribute('aria-pressed', key === selectedDate);
                    button.setAttribute('aria-label', `${day}, ada kegiatan`);

                    button.addEventListener('click', () => {
                        selectedDate = key;
                        renderCalendar();
                        renderEvents();
                    });
                }

                el.days.append(createCell(button));
            }
        }

        function renderEvents() {
            const selectedEvents = eventsByDate.get(selectedDate) || [];

            el.list.replaceChildren();
            el.empty.style.display = selectedEvents.length ? 'none' : 'flex';

            const emptyText = el.empty.querySelector('p');
            const emptyDescription = el.empty.querySelector('.text-muted');

            if (emptyText) {
                emptyText.textContent = events.length
                    ? 'Tidak Ada Kegiatan'
                    : 'Belum Ada Agenda';
            }

            if (emptyDescription) {
                emptyDescription.textContent = events.length
                    ? 'Tidak ada kegiatan pada tanggal yang dipilih.'
                    : 'Jadwal kegiatan akan muncul di sini setelah tersedia.';
            }

            selectedEvents.forEach(event => {
                const item = document.createElement('div');
                item.className = 'list-item';

                const left = document.createElement('div');
                left.className = 'list-item-left';

                const icon = document.createElement('span');
                icon.className = 'icon-badge';
                icon.innerHTML = '<i class="bi bi-calendar-event"></i>';

                const info = document.createElement('div');
                const title = document.createElement('h3');
                const description = document.createElement('p');

                title.textContent = event.judul || event.jenis || 'Kegiatan';
                description.textContent = event.periode ||
                    [event.jenis, event.waktu, event.tempat]
                        .filter(Boolean)
                        .join(' · ');

                info.append(title, description);
                left.append(icon, info);
                item.append(left);

                if (event.status) {
                    const status = document.createElement('span');
                    const value = event.status.toLowerCase();

                    const badgeClass = value.includes('selesai')
                        ? 'success'
                        : value.includes('menunggu')
                            ? 'warning'
                            : 'primary';

                    status.className = `badge ${badgeClass}`;
                    status.textContent = event.status;
                    item.append(status);
                }

                el.list.append(item);
            });
        }

        function changeMonth(step) {
            const date = new Date(calendar.year, calendar.month + step, 1);

            calendar.year = date.getFullYear();
            calendar.month = date.getMonth();

            renderCalendar();
        }

        el.prev.addEventListener('click', () => changeMonth(-1));
        el.next.addEventListener('click', () => changeMonth(1));

        renderCalendar();
        renderEvents();
    });
})();
