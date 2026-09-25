<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: list.php');
    exit;
}

$id = filter_var($_POST['id'] ?? null, FILTER_VALIDATE_INT);
$title = trim($_POST['title'] ?? '');
$author = trim($_POST['author'] ?? '');
$year = filter_var($_POST['year'] ?? null, FILTER_VALIDATE_INT);
$isbn = trim($_POST['isbn'] ?? '');
$stock = filter_var($_POST['stock'] ?? null, FILTER_VALIDATE_INT);
$category = $_POST['category'] ?? '';
$categories = ['fiction', 'non-fiction', 'reference'];
$errors = [];

if (!$id || $id < 1) $errors[] = 'A valid book ID is required.';
if ($title === '') $errors[] = 'Title is required.';
if ($author === '') $errors[] = 'Author is required.';
if ($year === false || $year < 1900 || $year > 2026) $errors[] = 'Year must be between 1900 and 2026.';
if ($stock === false || $stock < 0) $errors[] = 'Stock must be zero or greater.';
if (!in_array($category, $categories, true)) $errors[] = 'Choose a valid category.';

if ($errors) {
    $_SESSION['flash'] = ['type' => 'error', 'message' => implode(' ', $errors)];
    header('Location: edit.php?id=' . urlencode((string) ($id ?: '')));
    exit;
}

require __DIR__ . '/../includes/koneksi.php';

$check = $pdo->prepare('SELECT id FROM buku WHERE id = :id');
$check->execute(['id' => $id]);
if (!$check->fetchColumn()) {
    $_SESSION['flash'] = ['type' => 'error', 'message' => 'Book not found.'];
    header('Location: list.php');
    exit;
}

try {
    $stmt = $pdo->prepare(
        'UPDATE buku
         SET title = :title, author = :author, year = :year,
             isbn = :isbn, stock = :stock, category = :category
         WHERE id = :id'
    );
    $stmt->execute([
        'title' => $title,
        'author' => $author,
        'year' => $year,
        'isbn' => $isbn !== '' ? $isbn : null,
        'stock' => $stock,
        'category' => $category,
        'id' => $id,
    ]);
    $_SESSION['flash'] = ['type' => 'success', 'message' => 'Book updated successfully.'];
} catch (PDOException $exception) {
    $_SESSION['flash'] = ['type' => 'error', 'message' => 'Book could not be updated.'];
}

header('Location: list.php');
exit;
