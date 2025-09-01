<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once __DIR__ . "/../lib/GestorBD.php";
include_once __DIR__ . "/servicios/servicioPublicaciones.php";
include_once __DIR__ . "/../config/cargarEnv.php";


session_start();

// Verificar si el usuario está autenticado
if (isset($_SESSION["usuario"])) {
    $usuario = $_SESSION["usuario"];
} else {
    echo "<script>
        alert('Debes autenticarte para crear una publicación');
        window.location.href = '../vistas/login.php';
        </script>";
    exit();
}

// Validar y sanitizar los datos de entrada
$titulo = isset($_POST["titulo"]) ? htmlspecialchars($_POST["titulo"]) : null;
$descripcion = isset($_POST["descripcion"]) ? htmlspecialchars($_POST["descripcion"]) : null;
$fecha = date("Y-m-d H:i:s");


// Conexión a la base de datos
$conexion = GestorBD::conectar();
if (!$conexion) {
    die("Error al conectar con la base de datos");
}

// Obtener el ID del usuario autenticado
$query = "SELECT user_id FROM usuario WHERE user_name = ?";
$stmt = $conexion->prepare($query);
$stmt->bind_param("s", $usuario);
$stmt->execute();
$resultado = $stmt->get_result();
$fila = $resultado->fetch_assoc();

if (!$fila) {
    die("Error: No se encontró el usuario en la base de datos.");
}

$usuario_id = $fila["user_id"];

// Crear la publicación usando el servicio
$publicacion = new servicioPublicaciones();
if ($publicacion->crearPublicacion($usuario_id, $titulo, $descripcion, $fecha)) {
    echo "<script>
        window.location.href = '/vistas/perfilUser.php';
        </script>";
} else {
    echo "<script>
        alert('Error al crear la publicación');
        </script>";
}
