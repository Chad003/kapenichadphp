<?php

function loadEnv(string $filePath): bool
{
    if (!file_exists($filePath) || !is_readable($filePath)) {
        return false;
    }

    $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    if ($lines === false) {
        return false;
    }

    foreach ($lines as $line) {
        $line = trim($line);

        // Ignore empty lines and comments
        if ($line === '' || str_starts_with($line, '#')) {
            continue;
        }

        // Split key and value by the first '=' sign
        if (strpos($line, '=') === false) {
            continue;
        }

        [$name, $value] = explode('=', $line, 2);

        $name = trim($name);
        $value = trim($value);

        // Skip invalid or empty environment variable names
        if ($name === '') {
            continue;
        }

        // Remove surrounding single or double quotes
        if (
            strlen($value) >= 2 &&
            (($value[0] === '"' && substr($value, -1) === '"') ||
             ($value[0] === "'" && substr($value, -1) === "'"))
        ) {
            $value = substr($value, 1, -1);
        }

        // Set environment variables
        putenv(sprintf('%s=%s', $name, $value));
        $_ENV[$name] = $value;
        $_SERVER[$name] = $value;
    }

    return true;
}

// Usage
loadEnv(__DIR__ . '/../.env');
