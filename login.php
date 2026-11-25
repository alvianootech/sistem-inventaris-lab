<?php
require_once "auth.php";
if (!empty($_SESSION['login'])) {
    header("Location: index.php");
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $inputUsername = trim($_POST['username'] ?? '');
    $inputPassword = $_POST['password'] ?? '';
    if (login($inputUsername, $inputPassword)) {
        header("Location: index.php");
        exit;
    }
    $error = "username / password tidak sesuai";
}

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Sistem Inventaris</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="login-page">
    <main class="login-card" aria-labelledby="login-title">
        <h1 id="login-title">Login Sistem Inventaris</h1>
        <?php if ($error !== ''): ?>
            <p class="login-error" role="alert"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>
        <form action="login.php" method="post">
            <div class="login-field">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" autocomplete="username" required>
            </div>
            <div class="login-field">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" autocomplete="current-password" required>
            </div>
            <div class="login-actions">
                <button type="submit">Login</button>
            </div>
        </form>
    </main>
</body>
</html>
