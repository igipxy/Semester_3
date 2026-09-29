<?php
// Include this before the page prints any HTML so redirects can still run.
require_once __DIR__ . '/session.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: ../auth/login.php');
    exit;
}
