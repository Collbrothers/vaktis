<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

// getenv() is not used here to ensure consistency over different environments.
// This file will only be used by require_once, therefor there is no need to check if $_ENV contains keys.
function loadEnv(string $path): void {
    if (!file_exists($path)) {
        throw new RuntimeException(".env file not found at: $path");
    }

    foreach (file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
        if (str_starts_with(trim($line), '#') || !str_contains($line, '=')) continue;
        [$key, $value] = explode('=', $line, 2);
        $_ENV[trim($key)] = trim($value);
    }
}
loadEnv(__DIR__ . '/../.env');

try {
    $db_driver = $_ENV['DB_DRIVER'] ?? 'mysql';
    $dsn = "{$db_driver}:host={$_ENV['DB_HOST']};dbname={$_ENV['DB_NAME']};charset=utf8mb4";
    $pdo = new PDO($dsn, $_ENV['DB_USER'], $_ENV['DB_PASSWORD'], [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ]);
} catch (PDOException $e) {
    http_response_code(500);
    exit('Database connection failed.');
}