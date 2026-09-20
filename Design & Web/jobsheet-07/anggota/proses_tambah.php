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

if (!isset($_SESSION['anggota'])) {
    $_SESSION['anggota'] = [];
}
$_SESSION['anggota'][] = ['name' => $name, 'member_number' => $member_number, 'address' => $address, 'mobile_number' => $mobile_number, 'email' => $email];
$_SESSION['flash'] = ['type' => 'success', 'message' => 'Member added successfully.'];
header('Location: list.php');
exit;
