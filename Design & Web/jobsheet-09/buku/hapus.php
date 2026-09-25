<?php
session_start();
require __DIR__ . '/../includes/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: list.php');
    exit;
}

$id = filter_var($_POST['id'] ?? null, FILTER_VALIDATE_INT);
if (!$id || $id < 1) {
    $_SESSION['flash'] = ['type' => 'error', 'message' => 'A valid book ID is required.'];
    header('Location: list.php');
    exit;
}

$stmt = $pdo->prepare('DELETE FROM buku WHERE id = :id');
$stmt->execute(['id' => $id]);

$_SESSION['flash'] = $stmt->rowCount() > 0
    ? ['type' => 'success', 'message' => 'Book deleted successfully.']
    : ['type' => 'error', 'message' => 'Book not found.'];

header('Location: list.php');
exit;
