<?php require_once __DIR__ . '/../layout/header.php'; ?>

<?php
$avatarStyle = !empty($profil['foto'])
    ? ' style="background: url(\'' . htmlspecialchars(BASE_URL . '/' . $profil['foto'], ENT_QUOTES) . '\') center / cover no-repeat"'
    : '';
?>

<form class="dashboard-container" method="post" action="<?= BASE_URL ?>/profil/update" enctype="multipart/form-data">
    <div class="content-card">

        <!-- Foto + aksi -->
        <div class="card-header">
            <div class="profile-picture" id="avatarPreview" <?= $avatarStyle ?>>
                <?php if (empty($profil['foto'])): ?>
                    <i class="bi bi-person"></i>
                <?php endif; ?>
            </div>

            <div class="profile-info profile-actions" id="profileActions">
                <button type="submit" class="btn-primary">Save</button>
                <button type="button" class="btn-primary" id="btnEditFoto">Edit Foto</button>
                <input type="file" id="fotoInput" name="foto" accept="image/jpeg,image/png,image/webp" hidden>
            </div>
        </div>

        <!-- Data profil -->
        <div class="profile-setting-list">
            <div class="profile-setting-card">
                <h3>Nama</h3>
                <p class="profile-value"><?= htmlspecialchars($profil['nama']) ?></p>
            </div>

            <div class="profile-setting-card">
                <h3>NIM</h3>
                <p class="profile-value"><?= htmlspecialchars($profil['nim']) ?></p>
            </div>

            <div class="profile-setting-card">
                <h3>Program Studi</h3>
                <p class="profile-value"><?= htmlspecialchars($profil['prodi']) ?></p>
            </div>

            <div class="profile-setting-card">
                <h3>Email</h3>
                <p class="profile-value"><?= htmlspecialchars($profil['email']) ?></p>
            </div>

            <div class="profile-setting-card">
                <h3><label for="telepon">Nomor Telp.</label></h3>
                <input type="tel" id="telepon" name="telepon" class="form-input"
                       value="<?= htmlspecialchars($profil['telepon']) ?>"
                       maxlength="20" autocomplete="tel" required>
            </div>

            <div class="profile-setting-card">
                <h3><label for="alamat">Alamat</label></h3>
                <input type="text" id="alamat" name="alamat" class="form-input"
                       value="<?= htmlspecialchars($profil['alamat']) ?>"
                       maxlength="255" autocomplete="street-address" required>
            </div>
        </div>
    </div>
</form>

<script>
(() => {
    const MAX_SIZE = 2 * 1024 * 1024; // 2 MB
    const ALLOWED_TYPES = ['image/jpeg', 'image/png', 'image/webp'];

    const el = {
        avatar: document.getElementById('avatarPreview'),
        actions: document.getElementById('profileActions'),
        editPhotoBtn: document.getElementById('btnEditFoto'),
        photoInput: document.getElementById('fotoInput'),
    };

    let previewUrl = null;

    function showPhotoError(message) {
        el.actions.querySelector('.photo-error')?.remove();
        if (!message) return;

        const error = document.createElement('span');
        error.className = 'badge warning sm photo-error';
        error.textContent = message;
        el.actions.append(error);
    }

    function renderPreview(file) {
        if (previewUrl) URL.revokeObjectURL(previewUrl);

        previewUrl = URL.createObjectURL(file);
        el.avatar.style.background = `url("${previewUrl}") center / cover no-repeat`;
        el.avatar.replaceChildren();
    }

    function handlePhotoChange() {
        const [file] = el.photoInput.files;
        if (!file) return;

        if (!ALLOWED_TYPES.includes(file.type)) {
            el.photoInput.value = '';
            showPhotoError('Format harus JPG, PNG, atau WebP');
            return;
        }

        if (file.size > MAX_SIZE) {
            el.photoInput.value = '';
            showPhotoError('Ukuran maksimal 2 MB');
            return;
        }

        showPhotoError('');
        renderPreview(file);
    }

    el.editPhotoBtn.addEventListener('click', () => el.photoInput.click());
    el.photoInput.addEventListener('change', handlePhotoChange);
})();
</script>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>