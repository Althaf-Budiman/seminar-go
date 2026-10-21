<?php require_once __DIR__ . '/../layout/header.php'; ?>

<div class="dashboard-container">
    <div class="content-card">
        <div class="profile">
            <div class="profile-picture">
                <i class="bi bi-person"></i>
            </div>
            <div class="profile-info">
                <h2>Mahasiswa</h2>
                <p>NIM: -</p>
                <p>D4 Teknik Informatika</p>
                <div class="profile-contact">
                    <span>
                        <i class="bi bi-envelope-at"></i>
                        <p>-</p>
                    </span>
                    <span>
                        <i class="bi bi-whatsapp"></i>
                        <p>-</p>
                    </span>
                </div>
            </div>
            <button class="btn-primary">Edit</button>
        </div>
    </div>

    <div class="content-card">
        <div class="card-header border-b" style="width: 100%;">
            <h2>Pengaturan Akun & Kemanan</h2>
        </div>
        <div style="display: flex; flex-direction: column; gap: 0.5rem; margin-top: 18px;">

            <div class="profile-setting-card">
                <h3>Notifikasi Email</h3>
                <label class="toggle-switch" aria-label="Aktifkan notifikasi email">
                    <input
                        type="checkbox"
                        id="emailNotification"
                        name="email_notification">
                    <span class="toggle-slider"></span>
                </label>
            </div>
            <div class="profile-setting-card">
                <h3>Password Akun</h3>
                <button class="btn-danger" style="width: 150px;">Reset Password</button>
            </div>
            <div class="profile-setting-card">
                <h3>Logout</h3>
                <button class="btn-danger" style="width: 150px;">Keluar</button>
            </div>
        </div>
    </div>
</div>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>