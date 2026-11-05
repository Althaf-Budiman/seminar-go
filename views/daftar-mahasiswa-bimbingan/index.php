<?php require_once __DIR__ . '/../layout/header.php'; ?>

<div class="dashboard-container">
    <div class="content-card">
        <div class="card-header">
            <div>
                <h2>Daftar Mahasiswa Bimbingan</h2>
            </div>
            <span class="badge primary">
                <?= count($mahasiswa) ?> Mahasiswa
            </span>

        </div>

        <div style="display: flex; justify-content: space-between; align-items: center; gap: 1rem; margin-top: 1rem;">
            <div class="documents-search">
                <i class="bi bi-search"></i>
                <input type="text" id="documentSearch" placeholder="Cari nama, nim, atau email...">
            </div>
            <div class="documents-filter-group">
                <button class="documents-filter-btn" id="filterDropdownBtn" data-value="">
                    <i class="bi bi-funnel"></i>
                    <span id="filterLabel">Semua Status</span>
                    <i class="bi bi-chevron-down" style="font-size:0.7rem;"></i>
                </button>
                <div class="documents-filter-dropdown" id="filterDropdown">
                    <div class="filter-option active" data-value="">Semua Status</div>
                    <div class="filter-option" data-value="aktif">Aktif</div>
                    <div class="filter-option" data-value="nonaktif">Nonaktif</div>
                </div>
            </div>
            <button class="documents-filter-btn" id="sortBtn">
                <i class="bi bi-sort-down-alt"></i>
                <span id="sortLabel">Terbaru</span>
            </button>
        </div>

        <div class="list">
            <?php
            foreach ($mahasiswa as $index => $mhs) :
            ?>
                <div class="list-item">
                    <div class="list-item-left">
                        <span class="list-item-num"><?= $index + 1 ?></span>
                        <div>
                            <h3 style="color: black; font-weight: bold;"><?= htmlspecialchars($mhs['nama']) ?> - <?= htmlspecialchars($mhs['identification_number']) ?></h3>
                        </div>
                    </div>

                    <div style="display: flex; gap: 0.5rem; align-items: center;">
                        <span class="badge neutral"><?= htmlspecialchars($mhs['tahap']) ?></span>
                        <span class="badge <?= $mhs['status'] === 'Berlangsung' ? 'success' : 'secondary' ?>">
                            <?= htmlspecialchars($mhs['status']) ?>
                        </span>
                        <a class="btn-secondary" href="<?= BASE_URL ?>/daftar-mahasiswa-bimbingan/<?= htmlspecialchars($mhs['id']) ?>/detail">
                            Lihat Logbook
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<script src="<?= BASE_URL ?>/scripts/table.js"></script>


<?php require_once __DIR__ . '/../layout/footer.php'; ?>
