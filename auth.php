<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function login($inputUsername, $inputPassword)
{
    $username = 'bapakbaim';
    $password = '$2y$10$19NpphTCi1JCL5MLiTCVuePvoP7Ebd0foeIEPEPSCzHOW4INS1ICa';

    if ($inputUsername === $username && password_verify($inputPassword, $password)) {
        session_regenerate_id(true);
        $_SESSION['login'] = true;
        $_SESSION['username'] = $inputUsername;
        return true;
    }

    return false;
}

function logout()
{
    $_SESSION = [];
    if (ini_get('session.use_cookies')) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000, $params['path'],
            $params['domain'], $params['secure'], $params['httponly']);
    }
    session_destroy();
}

function wajibLogin($loginPath = 'login.php')
{
    if (empty($_SESSION['login'])) {
        header('Location: ' . $loginPath);
        exit;
    }
}
?>