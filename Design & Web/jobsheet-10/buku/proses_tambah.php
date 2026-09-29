<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: tambah.php');
    exit;
}

$title = trim($_POST['title'] ?? '');
$author = trim($_POST['author'] ?? '');
$year = $_POST['year'] ?? '';
$isbn = trim($_POST['isbn'] ?? '');
$stock = $_POST['stock'] ?? '';
$category = trim($_POST['category'] ?? '');
$errors = [];

if ($title === '') $errors[] = 'Title is required.';
if ($author === '') $errors[] = 'Author is required.';
if (filter_var($year, FILTER_VALIDATE_INT) === false || (int) $year < 1900 || (int) $year > 2026) $errors[] = 'Year must be between 1900 and 2026.';
if (filter_var($stock, FILTER_VALIDATE_INT) === false || (int) $stock < 0) $errors[] = 'Stock must be zero or greater.';

if ($errors) {
    $_SESSION['flash'] = ['type' => 'error', 'message' => implode(' ', $errors)];
    header('Location: tambah.php');
    exit;
}

require __DIR__ . '/../includes/koneksi.php';

try {
    $statement = $pdo->prepare(
        'INSERT INTO buku (title, author, year, isbn, stock, category)
         VALUES (:title, :author, :year, :isbn, :stock, :category)
         RETURNING id'
    );
    $statement->execute([
        'title' => $title,
        'author' => $author,
        'year' => (int) $year,
        'isbn' => $isbn !== '' ? $isbn : null,
        'stock' => (int) $stock,
        'category' => $category !== '' ? $category : null,
    ]);
    $statement->fetchColumn();
    $_SESSION['flash'] = ['type' => 'success', 'message' => 'Book added successfully.'];
} catch (PDOException $exception) {
    $_SESSION['flash'] = ['type' => 'error', 'message' => 'Book could not be saved. Check the database setup and try again.'];
    header('Location: tambah.php');
    exit;
}

header('Location: list.php');
exit;
