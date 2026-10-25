<?php require_once __DIR__ . '/../layout/header.php'; ?>

<div class="dashboard-container">
    <div class="content-card">
        <div class="card-header">
            <h2>Pengajuan Topik & Pembimbing</h2>
            <span class="badge warning">
                <span class="dot"></span>
                Menunggu Review Topik
            </span>
        </div>
    </div>

    <!-- Progress step -->
    <div class="content-card">
        <div class="progress-steps">
            <div class="progress-step active">
                <span class="list-item-num">1</span>
                <p>
                    Topik
                </p>
            </div>
            <div class="progress-step ">
                <span class="list-item-num">2</span>
                <p>
                    Bimbingan
                </p>
            </div>
            <div class="progress-step ">
                <span class="list-item-num">3</span>
                <p>
                    Berkas
                </p>
            </div>
            <div class="progress-step ">
                <span class="list-item-num">4</span>
                <p>
                    Jadwal
                </p>
            </div>
            <div class="progress-step ">
                <span class="list-item-num">5</span>
                <p>
                    Sidang
                </p>
            </div>
            <div class="progress-step ">
                <span class="list-item-num">6</span>
                <p>
                    Nilai
                </p>
            </div>
            <div class="progress-step ">
                <span class="list-item-num">7</span>
                <p>
                    Revisi
                </p>
            </div>
        </div>

    </div>

    <!-- Formulir pengajuan topik penelitian -->
    <div class="content-card">
        <div class="card-header">
            <div>
                <h2>Formulir Pengajuan Topik Penelitian</h2>
            </div>
            <span class="badge neutral">
                Draft </span>
        </div>

        <div class="detail-list">
            <div class="detail-item">
                <label>Judul Proposal Penelitian</label>
                <h4>Aplikasi Pencatatan Menu dan Kandungan Gizi untuk Pengelolaan Data MBG</h4>
            </div>

            <div class="detail-item-row">
                <div>
                    <label>Topik Penelitian</label>
                    <p>Sistem Informasi Kesehatan & Pemantauan Nutrisi Berbasis Web</p>
                </div>
                <div>
                    <label>Bidang Peminatan</label>
                    <p>Rekayasa Perangkat Lunak</p>
                </div>
            </div>


            <div class="detail-item">
                <label>Ringkasan Eksekutif</label>
                <p class="desc"><?= nl2br(htmlspecialchars($sempro['detailProposal']['ringkasan'] ?? 'Sistem terintegrasi untuk mendata distribusi makanan bergizi, menghitung estimasi kecukupan makronutrien, dan pelaporan berkala secara terpusat untuk program intervensi gizi nasional.')) ?></p>
            </div>
        </div>
    </div>

    <!-- Usulan Dosen Pembimbing -->
    <div class="content-card">
        <div class="card-header border-b">
            <div>
                <h2>Usulan Dosen Pembimbing</h2>
            </div>
            <span class="badge primary">
                3 usulan
            </span>
        </div>

        <div class="list">
            <div class="list-item active">
                <div class="list-item-left">
                    <span class="list-item-num">1</span>
                    <div>
                        <h3>Dosen, M.T.</h3>
                    </div>
                </div>
                <div>
                    <span class="badge primary">Prioritas 1</span>
                </div>
            </div>
            <div class="list-item locked">
                <div class="list-item-left">
                    <span class="list-item-num">2</span>
                    <div>
                        <h3>Dosen, M.Kom.</h3>
                    </div>
                </div>
                <div>
                    <span class="badge neutral">Prioritas 2</span>
                </div>
            </div>
            <div class="list-item locked">
                <div class="list-item-left">
                    <span class="list-item-num">3</span>
                    <div>
                        <h3>Dosen, M.Eng.</h3>
                    </div>
                </div>
                <div>
                    <span class="badge neutral">Prioritas 3</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Status Penelaahan -->
    <div class="content-card">
        <div class="card-header border-b">
            <div>
                <h2>Status Penelaahan</h2>
            </div>
        </div>

        <div class="list">
            <div class="list-item done">
                <div class="list-item-left">
                    <span class="list-item-num">1</span>
                    <div>
                        <h3>Pengajuan Terkirim</h3>
                    </div>
                </div>
                <div>
                    <span class="badge primary">Selesai</span>
                </div>
            </div>
            <div class="list-item active">
                <div class="list-item-left">
                    <span class="list-item-num">2</span>
                    <div>
                        <h3>Review Koordinator</h3>
                    </div>
                </div>
                <div>
                    <span class="badge warning">Menunggu</span>
                </div>
            </div>
            <div class="list-item locked">
                <div class="list-item-left">
                    <span class="list-item-num">3</span>
                    <div>
                        <h3>Penetapan Dosen Pembimbing</h3>
                    </div>
                </div>
                <div>
                    <span class="badge neutral">Terkunci</span>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>