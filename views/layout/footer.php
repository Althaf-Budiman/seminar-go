            </main>
            </div>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', () => {
                    const sidebar = document.getElementById('sidebar');
                    const sidebarToggleBtn = document.getElementById('sidebarToggleBtn');
                    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
                    const sidebarBackdrop = document.getElementById('sidebarBackdrop');
                    const appShell = document.getElementById('appShell');

                    // Toggle Sidebar
                    function toggleMobileSidebar() {
                        sidebar.classList.toggle('open');
                        sidebarBackdrop.classList.toggle('show');
                        document.body.classList.toggle('overflow-hidden');
                    }

                    function closeMobileSidebar() {
                        sidebar.classList.remove('open');
                        sidebarBackdrop.classList.remove('show');
                        document.body.classList.remove('overflow-hidden');
                    }

                    if (mobileMenuBtn) {
                        mobileMenuBtn.addEventListener('click', () => {
                            if (window.innerWidth <= 992) {
                                toggleMobileSidebar();
                            } else {
                                appShell.classList.toggle('sidebar-collapsed');
                            }
                        });
                    }

                    if (sidebarBackdrop) {
                        sidebarBackdrop.addEventListener('click', closeMobileSidebar);
                    }

                    // Toggle collapsed sidebar on desktop & drawer on mobile
                    if (sidebarToggleBtn) {
                        sidebarToggleBtn.addEventListener('click', () => {
                            if (window.innerWidth <= 992) {
                                closeMobileSidebar();
                            } else {
                                appShell.classList.toggle('sidebar-collapsed');
                            }
                        });
                    }

                    // Segmented Control Switcher
                    const segmentButtons = document.querySelectorAll('.segmented-control .segment-btn');
                    const topbarTitle    = document.querySelector('.topbar-title');
                    const tabPanels      = document.querySelectorAll('.tab-panel');

                    const tabTitles = {
                        sempro : 'Seminar Proposal',
                        skripsi: 'Skripsi & Sidang',
                    };

                    function switchTab(targetTab) {
                        // Update active button
                        segmentButtons.forEach(b => {
                            b.classList.toggle('active', b.dataset.tab === targetTab);
                        });

                        // Show / hide panels with fade
                        tabPanels.forEach(panel => {
                            if (panel.id === 'tab-' + targetTab) {
                                panel.style.display = '';
                                panel.classList.add('tab-visible');
                            } else {
                                panel.style.display = 'none';
                                panel.classList.remove('tab-visible');
                            }
                        });

                        // Update topbar title
                        if (topbarTitle && tabTitles[targetTab]) {
                            topbarTitle.textContent = tabTitles[targetTab];
                        }

                        // Persist choice in sessionStorage
                        sessionStorage.setItem('activeBerandaTab', targetTab);
                    }

                    segmentButtons.forEach(btn => {
                        btn.addEventListener('click', () => switchTab(btn.dataset.tab));
                    });

                    // Restore last active tab on page load
                    const savedTab = sessionStorage.getItem('activeBerandaTab');
                    if (savedTab && document.getElementById('tab-' + savedTab)) {
                        switchTab(savedTab);
                    }

                    // Search menu filter
                    const searchInput = document.getElementById('sidebarSearchInput');
                    const navItems = document.querySelectorAll('#sidebarNavList li');

                    if (searchInput) {
                        searchInput.addEventListener('input', (e) => {
                            const query = e.target.value.toLowerCase().trim();
                            navItems.forEach(item => {
                                const text = item.textContent.toLowerCase();
                                if (text.includes(query)) {
                                    item.style.display = '';
                                } else {
                                    item.style.display = 'none';
                                }
                            });
                        });
                    }
                });
            </script>
            </body>

            </html>