<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SeminarGO</title>

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <link href="<?= BASE_URL ?>/assets/css/login.css" rel="stylesheet">
    <link href="<?= BASE_URL ?>/assets/css/style.css" rel="stylesheet">
</head>

<body class="login-page">

    <!-- Mascot Plushie Character -->
    <div class="login-mascot" aria-hidden="true">
        <img src="<?= BASE_URL ?>/public/assets/mascot-yellow.svg" alt="Mascot">
    </div>

    <!-- Login Floating Card -->
    <div class="login-card">
        <span class="brand">SeminarGO</span>
        <h1>Selamat Datang!</h1>

        <form action="<?= BASE_URL ?>/login/store" method="POST">
            <div class="form-group">
                <label for="identification_number">NIM/NIP/EMAIL</label>
                <input type="identification_number" id="identification_number" name="identification_number" required autocomplete="identification_number">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required autocomplete="current-password">
            </div>

            <div class="form-row">
                <label class="checkbox-label">
                    <input type="checkbox" name="remember" checked>
                    <span>Ingat saya</span>
                </label>
                <a href="#">Lupa Password?</a>
            </div>

            <button type="submit">Login</button>
        </form>
    </div>

</body>

</html>