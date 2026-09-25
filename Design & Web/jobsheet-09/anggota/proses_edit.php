<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: list.php');
    exit;
}

$id = filter_var($_POST['id'] ?? null, FILTER_VALIDATE_INT);
$name = trim($_POST['name'] ?? '');
$member_number = trim($_POST['member_number'] ?? '');
$address = trim($_POST['address'] ?? '');
$mobile_number = trim($_POST['mobile_number'] ?? '');
$email = trim($_POST['email'] ?? '');
$errors = [];

if (!$id || $id < 1) $errors[] = 'A valid member ID is required.';
if ($name === '') $errors[] = 'Name is required.';
if ($member_number === '') $errors[] = 'Member number is required.';
if ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Email format is invalid.';

if ($errors) {
    $_SESSION['flash'] = ['type' => 'error', 'message' => implode(' ', $errors)];
    header('Location: edit.php?id=' . urlencode((string) ($id ?: '')));
    exit;
}

require __DIR__ . '/../includes/koneksi.php';

$check = $pdo->prepare('SELECT id FROM anggota WHERE id = :id');
$check->execute(['id' => $id]);
if (!$check->fetchColumn()) {
    $_SESSION['flash'] = ['type' => 'error', 'message' => 'Member not found.'];
    header('Location: list.php');
    exit;
}

try {
    $stmt = $pdo->prepare(
        'UPDATE anggota
         SET name = :name, member_number = :member_number, address = :address,
             mobile_number = :mobile_number, email = :email
         WHERE id = :id'
    );
    $stmt->execute([
        'name' => $name,
        'member_number' => $member_number,
        'address' => $address !== '' ? $address : null,
        'mobile_number' => $mobile_number !== '' ? $mobile_number : null,
        'email' => $email !== '' ? $email : null,
        'id' => $id,
    ]);
    $_SESSION['flash'] = ['type' => 'success', 'message' => 'Member updated successfully.'];
} catch (PDOException $exception) {
    $_SESSION['flash'] = $exception->getCode() === '23505'
        ? ['type' => 'error', 'message' => 'Member number is already in use. Choose another number.']
        : ['type' => 'error', 'message' => 'Member could not be updated.'];
}

header('Location: list.php');
exit;
