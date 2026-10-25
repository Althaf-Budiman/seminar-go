<?php
global $page;
$currentPage = !empty($page) ? $page : 'beranda';
$activeTitle = $pageTitle ?? $title ?? 'Seminar Proposal';

$activeMenu = $activeMenu ?? $currentPage;

$menu = [
    ['key' => 'beranda', 'label' => 'Beranda', 'url' => '/beranda'],
    [
        'label'    => 'Pengajuan Dosen Pembimbing',
        'children' => [
            ['key' => 'pengajuan-topik', 'label' => 'Pengajuan Topik & Pembimbing', 'url' => '/pengajuan-topik-pembimbing'],
            ['key' => 'formulir-topik',  'label' => 'Formulir Pengajuan Topik',     'url' => '/formulir-pengajuan-topik'],
        ],
    ],
    [
        'key' => 'logbook',
        'label' => 'Logbook',
        'children' => [
            ['key' => 'dokumen-logbook', 'label' => 'Dokumen Logbook', 'url' => '/dokumen-logbook'],
            ['key' => 'bimbingan-proposal', 'label' => 'Bimbingan Proposal', 'url' => '/bimbingan-proposal'],
        ],
    ],
    [
        'key' => 'jadwal',
        'label' => 'Jadwal Seminar dan Sidang',
        'children' => [
            ['key' => 'kelengkapan-berkas-seminar-proposal', 'label' => 'Kelengkapan Berkas Seminar Proposal', 'url' => '/kelengkapan-berkas-seminar-proposal'],
            ['key' => 'jadwal-sidang', 'label' => 'Jadwal Sidang', 'url' => '/jadwal-sidang'],
            ['key' => 'sidang', 'label' => 'Sidang', 'url' => '/sidang'],
        ],
    ],
    [
        'key' => 'nilai-revisi',
        'label' => 'Nilai dan Revisi',
        'children' => [
            ['key' => 'nilai-seminar-proposal', 'label' => 'Nilai Seminar Proposal', 'url' => '/nilai-seminar-proposal'],
            ['key' => 'nilai-sidang-akhir', 'label' => 'Nilai Sidang Akhir', 'url' => '/nilai-sidang-akhir'],
        ],
    ],
];
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
                    <span>SeminarGo</span>
                </a>
                <button type="button" class="sidebar-toggle" title="Tutup Sidebar" aria-label="Tutup Sidebar">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <rect width="18" height="18" x="3" y="3" rx="2.5"></rect>
                        <line x1="9.5" y1="3" x2="9.5" y2="21"></line>
                        <polygon points="15.5,9 12,12 15.5,15" fill="currentColor"></polygon>
                    </svg>
                </button>
            </div>

            <!-- Search Bar -->
            <div class="sidebar-search">
                <i class="bi bi-search"></i>
                <input type="text" id="sidebarSearchInput" placeholder="Search" autocomplete="off" aria-label="Search Menu">
            </div>

            <!-- Nav Items -->
            <nav class="sidebar-nav-wrapper">
                <ul class="sidebar-nav" id="sidebarNavList">
                    <?php foreach ($menu as $item): ?>
                        <?php if (!empty($item['children'])):
                            $isOpen = in_array($activeMenu, array_column($item['children'], 'key'), true);
                        ?>
                            <li class="nav-group<?= $isOpen ? ' is-open' : '' ?>">
                                <button type="button" class="nav-group-toggle" aria-expanded="<?= $isOpen ? 'true' : 'false' ?>">
                                    <i class="bi bi-chevron-right"></i>
                                    <span><?= htmlspecialchars($item['label']) ?></span>
                                </button>
                                <div class="nav-submenu" <?= $isOpen ? '' : ' inert' ?>>
                                    <ul>
                                        <?php foreach ($item['children'] as $child): ?>
                                            <li>
                                                <a href="<?= BASE_URL . $child['url'] ?>"
                                                    class="<?= $activeMenu === $child['key'] ? 'active' : '' ?>"
                                                    title="<?= htmlspecialchars($child['label']) ?>">
                                                    <span><?= htmlspecialchars($child['label']) ?></span>
                                                </a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </li>
                        <?php else: ?>
                            <li>
                                <a href="<?= BASE_URL . $item['url'] ?>"
                                    class="<?= $activeMenu === $item['key'] ? 'active' : '' ?>"
                                    title="<?= htmlspecialchars($item['label']) ?>">
                                    <span><?= htmlspecialchars($item['label']) ?></span>
                                </a>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            </nav>

            <!-- Bottom User Profile Card -->
            <div class="sidebar-footer">
                <a href="<?= BASE_URL ?>/profil" class="user-card">
                    <div class="avatar">sa</div>
                    <div class="user-info">
                        <strong>Mahasiswa</strong>
                        <small title="mahasiswa.rilo35@mhs.unj.ac.id">mahasiswa.rilo35@mhs.unj.ac.id</small>
                    </div>
                </a>
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

                    <div class="topbar-brand">
                        <a href="<?= BASE_URL ?>/beranda" class="sidebar-brand">SeminarGo</a>
                        <button type="button" class="sidebar-toggle" title="Buka Sidebar" aria-label="Buka Sidebar">
                            <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <rect width="18" height="18" x="3" y="3" rx="2.5"></rect>
                                <line x1="9.5" y1="3" x2="9.5" y2="21"></line>
                                <polygon points="15.5,9 12,12 15.5,15" fill="currentColor"></polygon>
                            </svg>
                        </button>
                    </div>

                    <div class="topbar-navigation">
                        <button type="button" class="nav-arrow-btn" onclick="window.history.back()" title="Kembali">
                            <i class="bi bi-chevron-left"></i>
                        </button>
                        <button type="button" class="nav-arrow-btn" onclick="window.history.forward()" title="Maju">
                            <i class="bi bi-chevron-right"></i>
                        </button>
                    </div>

                    <div class="topbar-divider"></div>

                    <h1 class="topbar-title"><?= htmlspecialchars($activeTitle) ?></h1>
                </div>
                <div class="topbar-right">
                    <?php if ($currentPage === 'beranda'): ?>
                        <!-- Segmented Switcher Pill -->
                        <div class="segmented-control" role="tablist" aria-label="Jenis Program">
                            <button type="button" class="segment-btn active" data-tab="sempro">
                                Seminar Proposal
                            </button>
                            <button type="button" class="segment-btn" data-tab="skripsi">
                                Skripsi
                            </button>
                        </div>
                    <?php endif; ?>

                    <!-- Notification Button -->
                    <button type="button" class="notification-btn" title="Notifikasi" aria-label="Notifikasi">
                        <i class="bi bi-bell"></i>
                        <span class="notification-dot"></span>
                    </button>
                </div>
            </header>

            <!-- Page Content Body -->
            <main class="content">