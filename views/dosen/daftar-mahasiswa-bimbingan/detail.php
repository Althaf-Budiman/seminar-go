<?php require_once __DIR__ . '/../../layout/header.php'; ?>


<div class="dashboard-container">

    <!-- Info Mahasiswa -->
    <div class="content-card">
        <div class="card-header">
            <div>
                <h2><?= htmlspecialchars($mahasiswa['nama']) ?></h2>
                <p style="font-size: 0.85rem; color: #64748b; margin-top: 0.25rem;">
                    <?= htmlspecialchars($mahasiswa['identification_number']) ?>
                    &nbsp;·&nbsp;
                    <?= htmlspecialchars($mahasiswa['tahap']) ?>
                </p>
            </div>
            <div style="display: flex; align-items: center; gap: 0.5rem;">
                <span class="badge <?= $mahasiswa['status'] === 'Berlangsung' ? 'success' : 'secondary' ?>">
                    <?= htmlspecialchars($mahasiswa['status']) ?>
                </span>
                <a href="<?= BASE_URL ?>/daftar-mahasiswa-bimbingan" class="btn-secondary">
                    <i class="bi bi-arrow-left"></i>
                    Kembali
                </a>
            </div>
        </div>
    </div>

    <!-- Riwayat Logbook -->
    <div class="content-card">
        <div class="card-header border-b">
            <div>
                <h2>Riwayat Logbook</h2>
                <p style="font-size: 0.82rem; color: #64748b; margin-top: 0.2rem;">
                    Catatan bimbingan mahasiswa yang tercatat dalam sistem
                </p>
            </div>
            <span class="badge primary sm"><?= count($logbook) ?> catatan</span>
        </div>

        <?php if (empty($logbook)) : ?>
            <div class="card-empty">
                <div class="empty-icon"><i class="bi bi-journal-text"></i></div>
                <p>Belum ada catatan logbook untuk mahasiswa ini.</p>
            </div>
        <?php else : ?>
            <div class="list list-lg">
                <?php foreach ($logbook as $index => $item) : ?>
                    <div class="list-item <?= htmlspecialchars($item['state']) ?>" style="flex-direction: column; align-items: stretch; gap: 0.75rem; padding: 1rem 1.15rem;">

                        <div style="display: flex; align-items: flex-start; gap: 1rem;">
                            <span class="list-item-num" style="flex-shrink: 0;"><?= $index + 1 ?></span>
                            <div style="flex: 1; min-width: 0;">
                                <h3 style="margin: 0 0 0.3rem;"><?= htmlspecialchars($item['topik']) ?></h3>
                                <div style="display: flex; flex-wrap: wrap; gap: 0.5rem; align-items: center;">
                                    <span style="font-size: 0.78rem; color: #64748b;">
                                        <i class="bi bi-calendar3"></i>
                                        <?= htmlspecialchars($item['tanggal']) ?>
                                    </span>
                                    <span style="font-size: 0.78rem; color: #64748b;">
                                        <i class="bi bi-person"></i>
                                        <?= htmlspecialchars($item['dosen']) ?>
                                    </span>
                                    <span style="font-size: 0.78rem; color: #64748b;">
                                        <i class="bi bi-camera-video"></i>
                                        <?= htmlspecialchars($item['metode']) ?>
                                    </span>
                                </div>
                            </div>
                            <span class="badge <?= htmlspecialchars($item['badgeClass']) ?> sm" style="flex-shrink: 0;">
                                <?= htmlspecialchars($item['badge']) ?>
                            </span>
                        </div>

                        <!-- Catatan -->
                        <?php if (!empty($item['catatan'])) : ?>
                            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 0.75rem 1rem; margin-left: 2.5rem;">
                                <p style="font-size: 0.82rem; color: #475569; line-height: 1.6; margin: 0;">
                                    <?= nl2br(htmlspecialchars($item['catatan'])) ?>
                                </p>
                            </div>
                        <?php endif; ?>

                        <!-- Lampiran & Aksi -->
                        <?php if (!empty($item['lampiran']) || $item['state'] === 'active') : ?>
                            <div style="display: flex; align-items: center; justify-content: space-between; margin-left: 2.5rem; flex-wrap: wrap; gap: 0.5rem;">
                                <div>
                                    <?php if (!empty($item['lampiran'])) : ?>
                                        <a href="#" class="btn-secondary" style="font-size: 0.8rem; padding: 0.3rem 0.7rem;">
                                            <i class="bi bi-paperclip"></i>
                                            <?= htmlspecialchars($item['lampiran']) ?>
                                        </a>
                                    <?php endif; ?>
                                </div>

                                <?php if ($item['state'] === 'active') : ?>
                                    <div style="display: flex; gap: 0.5rem;">
                                        <button type="button" class="btn-secondary btn-sm" style="font-size: 0.8rem; padding: 0.3rem 0.8rem;" onclick="tolakLogbook(<?= (int) $item['id'] ?>)">
                                            Tolak
                                        </button>
                                        <button type="button" class="btn-primary btn-sm" style="font-size: 0.8rem; padding: 0.3rem 0.8rem;" onclick="setujuiLogbook(<?= (int) $item['id'] ?>)">
                                            Setujui
                                        </button>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>

                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

</div>

<script>
    function setujuiLogbook(id) {
        if (confirm('Setujui catatan bimbingan ini?')) {
            // TODO: kirim request ke server
            console.log('Setujui logbook id:', id);
        }
    }

    function tolakLogbook(id) {
        if (confirm('Tolak catatan bimbingan ini?')) {
            // TODO: kirim request ke server
            console.log('Tolak logbook id:', id);
        }
    }
</script>

<?php require_once __DIR__ . '/../../layout/footer.php'; ?>