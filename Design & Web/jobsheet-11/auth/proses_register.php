<?php
require_once __DIR__ . '/../includes/csrf.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: register.php');
    exit;
}
if (isset($_SESSION['user_id'])) {
    header('Location: ../index.php');
    exit;
}
csrf_verify();

$name = trim(input_string($_POST, 'name'));
$username = trim(input_string($_POST, 'username'));
$password = input_string($_POST, 'password');
$errors = [];

if ($name === '') $errors[] = 'Name is required.';
if (strlen($username) < 3 || strlen($username) > 50) $errors[] = 'Username must be between 3 and 50 characters.';
if (strlen($password) < 6) $errors[] = 'Password must be at least 6 characters.';

if ($errors) {
    $_SESSION['flash'] = ['type' => 'error', 'message' => implode(' ', $errors)];
    header('Location: register.php');
    exit;
}

require __DIR__ . '/../includes/koneksi.php';
try {
    $check = $pdo->prepare('SELECT id FROM users WHERE username = :username');
    $check->execute(['username' => $username]);
    if ($check->fetch()) {
        $_SESSION['flash'] = ['type' => 'error', 'message' => 'That username is already in use.'];
        header('Location: register.php');
        exit;
    }

    $statement = $pdo->prepare(
        "INSERT INTO users (name, username, password, role)
         VALUES (:name, :username, :password, 'petugas')"
    );
    $statement->execute([
        'name' => $name,
        'username' => $username,
        'password' => password_hash($password, PASSWORD_DEFAULT),
    ]);
    $_SESSION['flash'] = ['type' => 'success', 'message' => 'Account created. You can log in now.'];
    header('Location: login.php');
    exit;
} catch (PDOException $exception) {
    // The database UNIQUE constraint also handles simultaneous registrations.
    if ($exception->getCode() === '23505') {
        $_SESSION['flash'] = ['type' => 'error', 'message' => 'That username is already in use.'];
        header('Location: register.php');
        exit;
    }
    $_SESSION['flash'] = ['type' => 'error', 'message' => 'The account could not be created. Check the database setup and try again.'];
    header('Location: register.php');
    exit;
}
