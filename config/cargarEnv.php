<?php
// filepath: c:\xampp\htdocs\Daily-Routine\config\cargarEnv.php

$envPath = __DIR__ . '/../.env';
if (!file_exists($envPath)) {
    die("El archivo .env no existe.");
}

// Leer el archivo .env línea por línea
$envVariables = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
foreach ($envVariables as $line) {
    putenv(trim($line)); // Cargar cada línea como variable de entorno
}