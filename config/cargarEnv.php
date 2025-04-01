<?php
$envPath = __DIR__ . '/../.env';
if (!file_exists($envPath)) {
    die("El archivo .env no existe.");
}

// Leer el archivo .env línea por línea
/* $envVariables = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
foreach ($envVariables as $line) {
    // Dividir la línea en clave y valor
    list($key, $value) = explode('=', $line, 2);
    $key = trim($key);
    $value = trim($value);

    // Cargar en $_ENV y putenv
    $_ENV[$key] = $value;
    putenv("$key=$value");
} */

// Leer el archivo .env línea por línea
$envVariables = file($envPath, FILE_IGNORE_NEW_LINES);
foreach ($envVariables as $line) {
    // Ignorar líneas completamente vacías
    if (trim($line) === '') {
        continue;
    }

    // Dividir la línea en clave y valor
    if (strpos($line, '=') === false) {
        continue; // Ignorar líneas sin el carácter '='
    }

    list($key, $value) = explode('=', $line, 2);
    $key = trim($key);
    $value = isset($value) ? trim($value) : ''; // Si no hay valor, asignar una cadena vacía

    // Cargar en $_ENV y putenv
    $_ENV[$key] = $value;
    putenv("$key=$value");
}