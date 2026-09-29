<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

function e($value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

$jobsheet_root = dirname(__DIR__);
$script_dir = dirname($_SERVER['SCRIPT_FILENAME']);
$relative_dir = ltrim(str_replace('\\', '/', substr($script_dir, strlen($jobsheet_root))), '/');
$base = $relative_dir === '' ? '' : str_repeat('../', substr_count($relative_dir, '/') + 1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMPUS-Mini<?php echo isset($page_title) ? ' | ' . e($page_title) : ''; ?> | Jobsheet 8</title>
    <link rel="stylesheet" href="<?php echo $base; ?>assets/css/style.css">
</head>
<body>
    <header>
        <h1>SIMPUS-Mini</h1>
        <button type="button" id="nav-toggle-btn" class="nav-toggle-label" aria-label="Open or close navigation menu" aria-expanded="false" aria-controls="main-nav">&#9776;</button>
        <nav id="main-nav" aria-label="Main navigation">
            <ul>
                <li><a href="<?php echo $base; ?>index.php">Home</a></li>
                <li><a href="<?php echo $base; ?>buku/list.php">Book List</a></li>
                <li><a href="<?php echo $base; ?>buku/tambah.php">Add Book</a></li>
                <li><a href="<?php echo $base; ?>anggota/list.php">Member List</a></li>
                <li><a href="<?php echo $base; ?>anggota/tambah.php">Add Member</a></li>
            </ul>
        </nav>
    </header>
    <main>
