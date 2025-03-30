<?php

include_once __DIR__ . "/../lib/GestorBD.php";
include_once __DIR__ . "/servicios/servicioPublicaciones.php";

session_start();

// Verificar si el usuario está autenticado
if (isset($_SESSION["usuario"])) {
    $usuario = $_SESSION["usuario"];
} else {
    echo "<script>
        alert('Debes autenticarte para poder ver las publicaciones');
        window.location.href = '../vistas/login.php';
        </script>";
    exit();
}

// Conexión a la base de datos
$conexion = GestorBD::conectar();
if (!$conexion) {
    die("Error al conectar con la base de datos");
}

// Crear instancia del servicio de publicaciones y listar publicaciones
$publicaciones = new servicioPublicaciones();
$publicaciones->listarPublicaciones();