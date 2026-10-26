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


        updateTopbar();
    });
</script>
</body>

</html>