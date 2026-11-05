<?php require_once __DIR__ . '/../../layout/header.php'; ?>


<div class="dashboard-container">

    <!-- Informasi Profil -->
    <div class="content-card">
        <div class="profile">

            <div class="profile-picture">
                <?php if (!empty($profile['foto'])) : ?>
                    <img src="<?= BASE_URL . '/' . htmlspecialchars($profile['foto']) ?>" alt="Foto profil">
                <?php else : ?>
                    <i class="bi bi-person"></i>
                <?php endif; ?>
            </div>

            <div class="profile-info">
                <h2><?= htmlspecialchars($profile['nama']) ?></h2>

                <p>
                    <?= htmlspecialchars($profile['label']) ?>:
                    <?= htmlspecialchars($profile['nomor_identitas']) ?>
                </p>

                <?php if ($profile['role'] === 'mahasiswa') : ?>
                    <p><?= htmlspecialchars($profile['prodi']) ?></p>
                <?php endif; ?>

                <div class="profile-contact">
                    <?php if (isset($profile['email'])) : ?>
                        <span>
                            <i class="bi bi-envelope-at"></i>
                            <p><?= htmlspecialchars($profile['email']) ?></p>
                        </span>
                    <?php endif; ?>

                    <?php if (isset($profile['no_hp'])) : ?>
                        <span>
                            <i class="bi bi-whatsapp"></i>
                            <p><?= htmlspecialchars($profile['no_hp']) ?></p>
                        </span>
                    <?php endif; ?>
                </div>
            </div>

            <a href="<?= BASE_URL ?>/profil/edit" class="btn-primary">
                Edit
            </a>

        </div>
    </div>

    <!-- Pengaturan Akun -->
    <div class="content-card">

        <div class="card-header border-b" style="width: 100%;">
            <h2>Pengaturan Akun & Keamanan</h2>
        </div>

        <div style="display: flex; flex-direction: column; gap: 0.5rem; margin-top: 18px;">

            <div class="profile-setting-card">
                <h3>Notifikasi Email</h3>

                <label class="toggle-switch" aria-label="Aktifkan notifikasi email">
                    <input type="checkbox" id="emailNotification" name="email_notification">
                    <span class="toggle-slider"></span>
                </label>
            </div>

            <div class="profile-setting-card">
                <h3>Password Akun</h3>

                <a href="<?= BASE_URL ?>/profil/reset-password" class="btn-danger" style="width: 150px; text-align: center;">
                    Reset Password
                </a>
            </div>

            <div class="profile-setting-card">
                <h3>Logout</h3>

                <a href="<?= BASE_URL ?>/login/logout" class="btn-danger" style="width: 150px; text-align: center;" onclick="return confirm('Apakah Anda yakin ingin keluar?')">
                    Keluar
                </a>
            </div>

        </div>
    </div>

</div>

<?php require_once __DIR__ . '/../../layout/footer.php'; ?>