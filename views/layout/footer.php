</main>
</div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const el = {
            appShell: document.getElementById('appShell'),
            sidebar: document.getElementById('sidebar'),
            backdrop: document.getElementById('sidebarBackdrop'),
            mobileMenuBtn: document.getElementById('mobileMenuBtn'),
            sidebarToggleBtns: document.querySelectorAll('.sidebar-toggle'),
            topbar: document.querySelector('.topbar'),
        };

        const mobileQuery = window.matchMedia('(max-width: 991.98px)');

        /* ---------- Topbar ---------- */
        function updateTopbar() {
            el.topbar.classList.toggle('scrolled', window.scrollY > 20);
        }

        /* ---------- Sidebar ---------- */
        function setMobileSidebar(isOpen) {
            el.sidebar.classList.toggle('open', isOpen);
            el.backdrop.classList.toggle('show', isOpen);
            document.body.classList.toggle('overflow-hidden', isOpen);
        }

        function toggleDesktopSidebar() {
            el.appShell.classList.toggle('sidebar-collapsed');
        }

        /* ---------- Events ---------- */
        window.addEventListener('scroll', updateTopbar, {
            passive: true
        });

        el.mobileMenuBtn?.addEventListener('click', () => {
            setMobileSidebar(!el.sidebar.classList.contains('open'));
        });

        el.backdrop?.addEventListener('click', () => setMobileSidebar(false));

        el.sidebarToggleBtns.forEach(button => {
            button.addEventListener('click', () => {
                if (mobileQuery.matches) setMobileSidebar(false);
                else toggleDesktopSidebar();
            });
        });


        // toggle
        document.querySelectorAll('.nav-group-toggle').forEach(button => {
            const group = button.closest('.nav-group');
            const submenu = group?.querySelector('.nav-submenu');

            if (!group || !submenu) return;

            function syncSubmenu() {
                const isOpen = group.classList.contains('is-open');

                button.setAttribute('aria-expanded', String(isOpen));
                submenu.toggleAttribute('inert', !isOpen);
            }

            syncSubmenu();

            button.addEventListener('click', () => {
                group.classList.toggle('is-open');
                syncSubmenu();
            });
        });

        /* ---------- Browser History Navigation ---------- */
        const backBtn = document.getElementById('historyBackBtn');
        const forwardBtn = document.getElementById('historyForwardBtn');

        function updateHistoryButtons() {
            // Navigation API
            if ('navigation' in window) {
                backBtn.disabled = !window.navigation.canGoBack;
                forwardBtn.disabled = !window.navigation.canGoForward;
            } else {
                backBtn.disabled = window.history.length <= 1;
                forwardBtn.disabled = true;
            }

            backBtn.classList.toggle('disabled', backBtn.disabled);
            forwardBtn.classList.toggle('disabled', forwardBtn.disabled);
        }

        updateHistoryButtons();

        window.addEventListener('pageshow', updateHistoryButtons);
        window.addEventListener('popstate', updateHistoryButtons);

        if ('navigation' in window) {
            window.navigation.addEventListener(
                'currententrychange',
                updateHistoryButtons
            );
        }

        /* ---------- Real-time Clock ---------- */
        const clockEl = document.getElementById('topbarClock');
        if (clockEl) {
            const pad = n => String(n).padStart(2, '0');
            const tickClock = () => {
                const now = new Date();
                clockEl.textContent = `${pad(now.getHours())}:${pad(now.getMinutes())}:${pad(now.getSeconds())}`;
            };
            setInterval(tickClock, 1000);
            tickClock();
        }

        /* ---------- Unified Program Switcher (Sempro / Skripsi) ---------- */
        const STORAGE_KEY = 'seminargo_active_program';
        const segmentButtons = document.querySelectorAll('.segmented-control .segment-btn');

        function getActiveProgram() {
            const params = new URLSearchParams(window.location.search);
            const queryProgram = params.get('program');
            if (queryProgram === 'skripsi' || queryProgram === 'sempro') {
                return queryProgram;
            }
            return localStorage.getItem(STORAGE_KEY) || sessionStorage.getItem('activeBerandaTab') || 'sempro';
        }

        function switchProgram(tab) {
            localStorage.setItem(STORAGE_KEY, tab);
            sessionStorage.setItem('activeBerandaTab', tab);

            segmentButtons.forEach(btn => {
                btn.classList.toggle('active', btn.dataset.tab === tab);
            });

            const panelSempro = document.getElementById('tab-sempro');
            const panelSkripsi = document.getElementById('tab-skripsi');
            const topbarTitle = document.querySelector('.topbar-title');

            if (panelSempro && panelSkripsi) {
                panelSempro.style.display = tab === 'sempro' ? '' : 'none';
                panelSkripsi.style.display = tab === 'skripsi' ? '' : 'none';

                const activePanel = tab === 'sempro' ? panelSempro : panelSkripsi;
                if (activePanel && activePanel.dataset.title && topbarTitle) {
                    topbarTitle.textContent = activePanel.dataset.title;
                    document.title = `${activePanel.dataset.title} - SeminarGo`;
                }
            }
        }

        if (segmentButtons.length > 0) {
            segmentButtons.forEach(btn => {
                btn.addEventListener('click', () => switchProgram(btn.dataset.tab));
            });
            switchProgram(getActiveProgram());
        }

        /* ---------- Sidebar Menu Search ---------- */
        const sidebarSearch = document.getElementById('sidebarSearchInput');
        const sidebarNavItems = document.querySelectorAll('#sidebarNavList li');
        if (sidebarSearch) {
            sidebarSearch.addEventListener('input', (e) => {
                const q = e.target.value.toLowerCase().trim();
                sidebarNavItems.forEach(item => {
                    const match = item.textContent.toLowerCase().includes(q);
                    item.style.display = match ? '' : 'none';
                });
            });
        }

        updateTopbar();
    });
</script>
</body>

</html>