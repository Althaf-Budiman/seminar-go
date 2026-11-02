(() => {
    const dataElement = document.getElementById('jadwalDetailData');
    const modal = document.getElementById('detailModal');
    if (!dataElement || !modal) {
        console.warn('jadwal-detail.js: #jadwalDetailData atau #detailModal tidak ada di halaman. Pastikan view terbaru yang dipakai.');
        return;
    }

    const detailByDate = JSON.parse(dataElement.textContent);
    const baseUrl = modal.dataset.baseUrl;

    const el = {
        title: document.getElementById('detailModalTitle'),
        tbody: document.getElementById('detailTbody'),
        closeBtn: document.getElementById('detailModalClose'),
        openButtons: document.querySelectorAll('[data-open-detail]'),

        deleteModal: document.getElementById('deleteConfirmModal'),
        deleteForm: document.getElementById('deleteConfirmForm'),
        cancelDeleteBtn: document.getElementById('cancelDeleteBtn'),
    };

    /* ---------- Table ---------- */
    function createCell(value, className = '') {
        const cell = document.createElement('td');
        cell.className = className;
        if (value instanceof Node) cell.append(value);
        else cell.textContent = value ?? '-';
        return cell;
    }

    function createListCell(values) {
        const cell = document.createElement('td');
        const names = values?.length ? values : ['-'];
        names.forEach(value => {
            const line = document.createElement('div');
            line.textContent = value;
            cell.append(line);
        });
        return cell;
    }

    /* ---------- Delete Confirmation ---------- */
    function createDeleteButton(id) {
        const button = document.createElement('button');

        button.type = 'button';
        button.className = 'btn-danger';
        button.textContent = 'Hapus';

        button.addEventListener('click', () => {
            el.deleteForm.action = `${baseUrl}/manajemen-jadwal/${id}/delete`;
            el.deleteModal.showModal();
        });

        return button;
    }

    function createEditLink(id) {
        const link = document.createElement('a');
        link.href = `${baseUrl}/manajemen-jadwal/${id}/edit`;
        link.className = 'btn-secondary';
        link.textContent = 'Edit';
        return link;
    }

    function createRow(item, index) {
        const actions = document.createElement('div');
        actions.className = 'header-actions';
        actions.append(createDeleteButton(item.id), createEditLink(item.id));

        const row = document.createElement('tr');
        row.append(
            createCell(index + 1, 'td-no'),
            createCell(item.waktu),
            createCell(item.ruang),
            createCell(item.nama),
            createCell(item.pembimbing),
            createListCell(item.penguji),
            createCell(item.jenis),
            createCell(actions),
        );
        return row;
    }

    /* ---------- Modal ---------- */
    function openDetail(date) {
        const detail = detailByDate[date];
        if (!detail) {
            console.warn(`jadwal-detail.js: tidak ada data untuk tanggal ${date}`);
            return;
        }

        el.title.textContent = detail.label;
        el.tbody.replaceChildren(...detail.items.map(createRow));

        document.body.classList.add('overflow-hidden');
        modal.showModal();
    }

    function closeDetail() {
        modal.close();
    }

    /* ---------- Events ---------- */
    el.openButtons.forEach(button => {
        button.addEventListener('click', () => openDetail(button.dataset.date));
    });

    el.closeBtn.addEventListener('click', closeDetail);

    el.cancelDeleteBtn.addEventListener('click', () => {
        el.deleteModal.close();
    });

    el.deleteModal.addEventListener('click', (event) => {
        if (event.target === el.deleteModal) {
            el.deleteModal.close();
        }
    });

    // Close modal popup
    modal.addEventListener('click', (event) => {
        if (event.target === modal) closeDetail();
    });

    modal.addEventListener('close', () => {
        document.body.classList.remove('overflow-hidden');
    });
})();