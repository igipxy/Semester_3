<?php
require_once __DIR__ . '/../includes/csrf.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: login.php');
    exit;
}
if (isset($_SESSION['user_id'])) {
    header('Location: ../index.php');
    exit;
}
if (!csrf_token_is_valid($_POST['csrf_token'] ?? null)) {
    $_SESSION['flash'] = ['type' => 'error', 'message' => 'The form expired. Please try again.'];
    header('Location: login.php');
    exit;
}

$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';
try {
    require __DIR__ . '/../includes/koneksi.php';
    $statement = $pdo->prepare(
        'SELECT id, name, username, password, role FROM users WHERE username = :username'
    );
    $statement->execute(['username' => $username]);
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        // Change the session ID after authentication to reduce session-fixation risk.
        session_regenerate_id(true);
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['name'] = $user['name'];
        $_SESSION['role'] = $user['role'];
        header('Location: ../index.php');
        exit;
    }
} catch (PDOException $exception) {
    $_SESSION['flash'] = ['type' => 'error', 'message' => 'Login is temporarily unavailable. Check the database setup and try again.'];
    header('Location: login.php');
    exit;
}

$_SESSION['flash'] = ['type' => 'error', 'message' => 'Username or password is incorrect.'];
header('Location: login.php');
exit;
