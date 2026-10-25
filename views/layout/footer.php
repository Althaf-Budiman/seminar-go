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

        updateTopbar();
    });
</script>
</body>

</html>