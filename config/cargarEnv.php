<?php
$envPath = __DIR__ . '/../.env';
if (!file_exists($envPath)) {
    die("El archivo .env no existe.");
}

// Leer el archivo .env línea por línea
$envVariables = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
foreach ($envVariables as $line) {
    // Dividir la línea en clave y valor
    list($key, $value) = explode('=', $line, 2);
    $key = trim($key);
    $value = trim($value);

    // Cargar en $_ENV y putenv
    $_ENV[$key] = $value;
    putenv("$key=$value");
}