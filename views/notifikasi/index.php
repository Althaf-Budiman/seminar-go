<?php require_once __DIR__ . '/../layout/header.php'; ?>

<?php
$unreadCount = count(array_filter($notifikasi, function ($n) {
    return !$n['dibaca'];
}));
?>

<div class="dashboard-container">
    <div class="content-card notif-card">

        <!-- Tabs + aksi -->
        <div class="notif-toolbar">
            <div class="notif-tabs" role="tablist" aria-label="Filter notifikasi">
                <button type="button" class="notif-tab active" data-filter="all" role="tab" aria-selected="true">
                    Semua
                </button>
                <button type="button" class="notif-tab" data-filter="unread" role="tab" aria-selected="false">
                    Belum dibaca (<span id="unreadCount"><?= $unreadCount ?></span>)
                </button>
            </div>
            <button type="button" class="notif-mark-all" id="markAllRead">Tandai semua dibaca</button>
        </div>

        <!-- Daftar -->
        <ul class="notif-list" id="notifList">
            <?php foreach ($notifikasi as $n): ?>
                <li>
                    <button type="button"
                            class="notif-item<?= $n['dibaca'] ? '' : ' is-unread' ?>"
                            data-id="<?= (int)$n['id'] ?>">
                        <span class="notif-icon"><i class="bi <?= htmlspecialchars($n['icon']) ?>"></i></span>
                        <span class="notif-body">
                            <span class="notif-title"><?= htmlspecialchars($n['judul']) ?></span>
                            <span class="notif-message"><?= htmlspecialchars($n['pesan']) ?></span>
                        </span>
                        <span class="notif-meta">
                            <span class="notif-time"><?= htmlspecialchars($n['waktu']) ?></span>
                            <span class="notif-dot" aria-label="Belum dibaca"></span>
                        </span>
                    </button>
                </li>
            <?php endforeach; ?>
        </ul>

        <div class="notif-empty" id="notifEmpty" hidden>
            <i class="bi bi-bell-slash"></i>
            <p>Tidak ada notifikasi</p>
        </div>
    </div>
</div>

<script>
(() => {
    const items = [...document.querySelectorAll('.notif-item')];

    const el = {
        tabs: document.querySelectorAll('.notif-tab'),
        unreadCount: document.getElementById('unreadCount'),
        markAll: document.getElementById('markAllRead'),
        empty: document.getElementById('notifEmpty'),
        bellDot: document.querySelector('.notification-dot'),
    };

    const state = { filter: 'all' };

    const isUnread = (item) => item.classList.contains('is-unread');

    function render() {
        const unread = items.filter(isUnread).length;
        let visible = 0;

        items.forEach(item => {
            const show = state.filter === 'all' || isUnread(item);
            item.parentElement.hidden = !show;
            if (show) visible++;
        });

        el.unreadCount.textContent = unread;
        el.markAll.disabled = unread === 0;
        el.bellDot?.toggleAttribute('hidden', unread === 0);
        el.empty.hidden = visible > 0;
    }

    function setFilter(filter) {
        state.filter = filter;

        el.tabs.forEach(tab => {
            const isActive = tab.dataset.filter === filter;
            tab.classList.toggle('active', isActive);
            tab.setAttribute('aria-selected', isActive);
        });

        render();
    }

    // TODO: kirim ke server supaya status dibaca tersimpan
    function markAsRead(item) {
        item.classList.remove('is-unread');
        render();
    }

    function markAllAsRead() {
        items.forEach(item => item.classList.remove('is-unread'));
        render();
    }

    el.tabs.forEach(tab => {
        tab.addEventListener('click', () => setFilter(tab.dataset.filter));
    });

    items.forEach(item => {
        item.addEventListener('click', () => markAsRead(item));
    });

    el.markAll.addEventListener('click', markAllAsRead);

    render();
})();
</script>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>