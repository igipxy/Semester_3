<?php
// Local development credentials. Change these values for your own PostgreSQL installation.
$host = 'localhost';
$port = '5432';
$db = 'web';
$user = 'postgres';
$pass = 'postgres';

try {
    $pdo = new PDO(
        "pgsql:host=$host;port=$port;dbname=$db",
        $user,
        $pass,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]
    );
} catch (PDOException $exception) {
    die('Database connection failed. Check PostgreSQL, the database name, credentials, and pdo_pgsql.');
}
