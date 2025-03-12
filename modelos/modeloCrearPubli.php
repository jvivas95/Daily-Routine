<?php 

include_once __DIR__.("/../lib/GestorBD.php");
include_once __DIR__.("/servicios/servicioPublicaciones.php");
include_once __DIR__.("/../config/config.php");

session_start();
$conexion = new GestorBD();

if (!$conexion->conectar()) {
    die("Error al conectar con la base de datos");
}

if (isset($_SESSION["usuario"])) {
    $usuario = $_SESSION["usuario"];
} else {
    echo "<script>
        alert('Debes autenticarte para crear una publicación');
        window.location.href = '../vistas/login.php';
      </script>";
    exit();
}

$titulo = $_POST["categoria"];
$descripcion = $_POST["descripcion"];
$fecha = date("Y-m-d H:i:s");

$query = "SELECT user_id FROM usuario WHERE nombre = '$usuario'";
$resultado = mysqli_query($conexion->conectar(), $query);

if (!$resultado) {
    die("Error en la consulta: " . mysqli_error($conexion->conectar()));
}

$fila = mysqli_fetch_array($resultado);
if (!$fila) {
    die("Error: No se encontró el usuario en la base de datos.");
}

$usuario_id =  $fila["user_id"];

$publicacion = new servicioPublicaciones();

if ($publicacion->crearPublicacion($usuario_id, $titulo, $descripcion, $fecha)) {
    echo "<script>
        alert('Publicación creada correctamente');
        window.location.href = '../vistas/verRutinas.php';
      </script>";
} else {
    echo "<script>
        alert('Error al crear la publicación');
        window.location.href = '".BASE_URL."/vistas/crearRutina.php';
      </script>";
}

?>