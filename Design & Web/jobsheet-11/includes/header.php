<?php
require_once __DIR__ . '/session.php';
require_once __DIR__ . '/helpers.php';
require_once __DIR__ . '/csrf.php';

$jobsheet_root = dirname(__DIR__);
$script_dir = dirname($_SERVER['SCRIPT_FILENAME']);
$relative_dir = ltrim(str_replace('\\', '/', substr($script_dir, strlen($jobsheet_root))), '/');
$base = $relative_dir === '' ? '' : str_repeat('../', substr_count($relative_dir, '/') + 1);
$sudahLogin = isset($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMPUS-Mini<?php echo isset($page_title) ? ' | ' . e($page_title) : ''; ?> | Jobsheet 11</title>
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
                <?php if ($sudahLogin): ?>
                <li><a href="<?php echo $base; ?>buku/tambah.php">Add Book</a></li>
                <li><a href="<?php echo $base; ?>anggota/list.php">Member List</a></li>
                <li><a href="<?php echo $base; ?>anggota/tambah.php">Add Member</a></li>
                <?php endif; ?>
            </ul>
        </nav>
        <div class="auth-status">
            <?php if ($sudahLogin): ?>
                <span><?php echo e($_SESSION['name']); ?></span>
                <form class="logout-form" method="post" action="<?php echo $base; ?>auth/logout.php">
                    <?php echo csrf_field(); ?>
                    <button class="logout-link" type="submit">Logout</button>
                </form>
            <?php else: ?>
                <a href="<?php echo $base; ?>auth/login.php">Login</a>
                <a href="<?php echo $base; ?>auth/register.php">Register</a>
            <?php endif; ?>
        </div>
    </header>
    <main>
