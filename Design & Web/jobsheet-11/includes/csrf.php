<?php
require_once __DIR__ . '/session.php';
require_once __DIR__ . '/helpers.php';

function csrf_token(): string
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }

    return $_SESSION['csrf_token'];
}

function csrf_field(): string
{
    return '<input type="hidden" name="csrf_token" value="' . e(csrf_token()) . '">';
}

function csrf_verify(): void
{
    $submittedToken = $_POST['csrf_token'] ?? null;
    if (!is_string($submittedToken)
        || !isset($_SESSION['csrf_token'])
        || !hash_equals($_SESSION['csrf_token'], $submittedToken)) {
        http_response_code(403);
        exit('Request denied: CSRF token is invalid or expired.');
    }
}
