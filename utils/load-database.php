<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/utils/load-env.php');

/**
 * Establishes and returns a reusable PDO database connection.
 * 
 * @return PDO
 * @throws PDOException
 */
function get_db_connection(): PDO {
    $dsn = sprintf(
        'mysql:host=%s;dbname=%s;charset=utf8mb4',
        $_ENV['DB_HOST'],
        $_ENV['DB_NAME']
    );

    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    return new PDO($dsn, $_ENV['DB_USER'], $_ENV['DB_PASS'], $options);
}