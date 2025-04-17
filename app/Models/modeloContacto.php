<?php

include_once __DIR__ . "/../lib/GestorBD.php";
include_once __DIR__ . "/servicios/servicioContacto.php";

session_start();

// Conexión a la base de datos
$conexion = GestorBD::conectar();
if (!$conexion) {
    die("Error al conectar con la base de datos");
}

// Verificar si el usuario está autenticado
if (isset($_SESSION["usuario"])) {
    $usuario = $_SESSION["usuario"];
} else {
    echo "<script>
        alert('Debes autenticarte para enviar el formulario');
        window.location.href = '../vistas/login.php';
      </script>";
    exit();
}

// Validar y sanitizar los datos de entrada
$nombre = isset($_POST["nombre"]) ? htmlspecialchars($_POST["nombre"]) : null;
$email = isset($_POST["email"]) ? filter_var($_POST["email"], FILTER_SANITIZE_EMAIL) : null;
$mensaje = isset($_POST["mensaje"]) ? htmlspecialchars($_POST["mensaje"]) : null;
$fecha = date("Y-m-d H:i:s");

if (!$nombre || !$email || !$mensaje) {
    die("Error: Todos los campos son obligatorios.");
}

// Obtener el ID del usuario autenticado
$query = "SELECT user_id FROM usuario WHERE nombre = ?";
$stmt = $conexion->prepare($query);
$stmt->bind_param("s", $usuario);
$stmt->execute();
$resultado = $stmt->get_result();
$fila = $resultado->fetch_assoc();

if (!$fila) {
    die("Error: No se encontró el usuario en la base de datos.");
}

$usuario_id = $fila["user_id"];

// Registrar el contacto usando el servicio
$contacto = new servicioContacto();
if ($contacto->registroContacto($nombre, $email, $mensaje, $fecha, $usuario_id)) {
    echo "<script>
        alert('Formulario enviado correctamente');
        window.location.href = '../vistas/verRutinas.php';
      </script>";
} else {
    echo "<script>
        alert('Error al enviar el formulario');
      </script>";
}