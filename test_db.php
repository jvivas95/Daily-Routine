<?php

$host = "sql306.infinityfree.com"; // Cambia según tu host
$user = "if0_38609258"; // Usuario de la base de datos
$pass = "UAOxxTFwo5"; // Contraseña de la base de datos
$db = "if0_38609258_dailyroutine"; // Nombre de la base de datos

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("❌ Conexión fallida: " . $conn->connect_error);
} else {
    echo "✅ Conexión exitosa a la base de datos";
}

$conn->close();
?>
