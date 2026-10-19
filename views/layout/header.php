<?php
global $page;
$currentPage = !empty($page) ? $page : 'beranda';
$activeTitle = $pageTitle ?? $title ?? 'Seminar Proposal';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($activeTitle) ?> - SeminarGo</title>
    
    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    
    <link href="<?= BASE_URL ?>/assets/css/style.css" rel="stylesheet">
</head>
<body>

    <div class="app-shell" id="appShell">
        <!-- Backdrop for mobile drawer -->
        <div class="sidebar-backdrop" id="sidebarBackdrop"></div>

        <!-- Sidebar -->
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <a href="<?= BASE_URL ?>/beranda" class="sidebar-brand">
                    <span class="brand-text">SeminarGo</span>
                    <span class="brand-mini">SG</span>
                </a>
                <button type="button" class="sidebar-action-btn" id="sidebarToggleBtn" title="Perkecil/Buka Sidebar">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <rect width="18" height="18" x="3" y="3" rx="2.5"></rect>
                        <line x1="9.5" y1="3" x2="9.5" y2="21"></line>
                        <polygon points="15.5,9 12,12 15.5,15" fill="currentColor"></polygon>
                    </svg>
                </button>
            </div>

            <!-- Search Bar -->
            <div class="sidebar-search-container">
                <div class="sidebar-search">
                    <i class="bi bi-search search-icon"></i>
                    <input type="text" id="sidebarSearchInput" placeholder="Search" autocomplete="off" aria-label="Search Menu">
                </div>
            </div>

            <!-- Nav Items -->
            <nav class="sidebar-nav-wrapper">
                <ul class="sidebar-nav" id="sidebarNavList">
                    <li class="sidebar-item">
                        <a href="<?= BASE_URL ?>/beranda" class="sidebar-link <?= in_array($currentPage, ['beranda', '']) ? 'active' : '' ?>" title="Beranda">
                            <i class="bi bi-grid sidebar-icon"></i>
                            <span class="sidebar-text">Beranda</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="<?= BASE_URL ?>/pengajuan-dosen" class="sidebar-link <?= $currentPage === 'pengajuan-dosen' ? 'active' : '' ?>" title="Pengajuan Dosen Pembimbing">
                            <i class="bi bi-person-check sidebar-icon"></i>
                            <span class="sidebar-text">Pengajuan Dosen Pembimbing</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="<?= BASE_URL ?>/logbook" class="sidebar-link <?= $currentPage === 'logbook' ? 'active' : '' ?>" title="Logbook">
                            <i class="bi bi-journal-text sidebar-icon"></i>
                            <span class="sidebar-text">Logbook</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="<?= BASE_URL ?>/jadwal" class="sidebar-link <?= $currentPage === 'jadwal' ? 'active' : '' ?>" title="Jadwal Seminar dan Sidang">
                            <i class="bi bi-calendar-event sidebar-icon"></i>
                            <span class="sidebar-text">Jadwal Seminar dan Sidang</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="<?= BASE_URL ?>/nilai-revisi" class="sidebar-link <?= $currentPage === 'nilai-revisi' ? 'active' : '' ?>" title="Nilai dan Revisi">
                            <i class="bi bi-award sidebar-icon"></i>
                            <span class="sidebar-text">Nilai dan Revisi</span>
                        </a>
                    </li>
                </ul>
            </nav>

            <!-- Bottom User Profile Card -->
            <div class="sidebar-footer">
                <div class="user-profile-card">
                    <div class="user-avatar">sa</div>
                    <div class="user-details">
                        <span class="user-name">Mahasiswa</span>
                        <span class="user-email" title="mahasiswa.rilo35@mhs.unj.ac.id">mahasiswa.rilo35@mhs.unj.ac.id</span>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Content Area -->
        <div class="main">
            <!-- Header / Topbar -->
            <header class="topbar">
                <div class="topbar-left">
                    <button type="button" class="btn-icon mobile-menu-toggle" id="mobileMenuBtn" aria-label="Buka Menu">
                        <i class="bi bi-list"></i>
                    </button>
                    
                    <div class="topbar-navigation">
                        <button type="button" class="nav-arrow-btn" onclick="window.history.back()" title="Kembali">
                            <i class="bi bi-chevron-left"></i>
                        </button>
                        <button type="button" class="nav-arrow-btn disabled" onclick="window.history.forward()" title="Maju">
                            <i class="bi bi-chevron-right"></i>
                        </button>
                    </div>

                    <div class="topbar-divider"></div>

                    <h1 class="topbar-title"><?= htmlspecialchars($activeTitle) ?></h1>
                </div>

                <div class="topbar-right">
                    <!-- Segmented Switcher Pill -->
                    <div class="segmented-control" role="tablist" aria-label="Jenis Program">
                        <button type="button" class="segment-btn active" data-tab="sempro">
                            Seminar Proposal
                        </button>
                        <button type="button" class="segment-btn" data-tab="skripsi">
                            Skripsi
                        </button>
                    </div>

                    <!-- Notification Button -->
                    <button type="button" class="notification-btn" title="Notifikasi" aria-label="Notifikasi">
                        <i class="bi bi-bell"></i>
                        <span class="notification-dot"></span>
                    </button>
                </div>
            </header>

            <!-- Page Content Body -->
            <main class="content">
