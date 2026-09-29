<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: tambah.php');
    exit;
}

$name = trim($_POST['name'] ?? '');
$member_number = trim($_POST['member_number'] ?? '');
$address = trim($_POST['address'] ?? '');
$mobile_number = trim($_POST['mobile_number'] ?? '');
$email = trim($_POST['email'] ?? '');
$errors = [];

if ($name === '') $errors[] = 'Name is required.';
if ($member_number === '') $errors[] = 'Member number is required.';
if ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Email format is invalid.';

if ($errors) {
    $_SESSION['flash'] = ['type' => 'error', 'message' => implode(' ', $errors)];
    header('Location: tambah.php');
    exit;
}

require __DIR__ . '/../includes/koneksi.php';

try {
    $statement = $pdo->prepare(
        'INSERT INTO anggota (name, member_number, address, mobile_number, email)
         VALUES (:name, :member_number, :address, :mobile_number, :email)
         RETURNING id'
    );
    $statement->execute([
        'name' => $name,
        'member_number' => $member_number,
        'address' => $address !== '' ? $address : null,
        'mobile_number' => $mobile_number !== '' ? $mobile_number : null,
        'email' => $email !== '' ? $email : null,
    ]);
    $statement->fetchColumn();
    $_SESSION['flash'] = ['type' => 'success', 'message' => 'Member added successfully.'];
} catch (PDOException $exception) {
    $message = $exception->getCode() === '23505'
        ? 'Member number is already in use. Choose another number.'
        : 'Member could not be saved. Check the database setup and try again.';
    $_SESSION['flash'] = ['type' => 'error', 'message' => $message];
    header('Location: tambah.php');
    exit;
}

header('Location: list.php');
exit;
