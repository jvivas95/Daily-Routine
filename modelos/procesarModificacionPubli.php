<?php
include_once __DIR__ . "/../lib/GestorBD.php";
include_once __DIR__ . "/servicios/servicioPublicaciones.php";
include_once __DIR__ . "/modeloPublicacion.php";
include_once __DIR__ . "/../config/cargarEnv.php";


session_start();

if (!isset($_SESSION["usuario"])) {
  echo "<script>
        alert('Debes autenticarte para realizar esta acción');
        window.location.href = '../vistas/login.php';
      </script>";
  exit;
}

if (!isset($_POST["rutina_id"]) || !isset($_POST["titulo"]) || !isset($_POST["descripcion"])) {
  echo "<script>
        alert('Faltan datos para modificar la publicación');
        window.location.href = '../vistas/perfilUser.php';
      </script>";
  exit;
}

$rutina_id = $_POST["rutina_id"];
$titulo = htmlspecialchars($_POST["titulo"]);
$descripcion = htmlspecialchars($_POST["descripcion"]);

// Crear una instancia de la publicación
$publicacion = new Publicacion($rutina_id, $titulo, $descripcion, date("Y-m-d H:i:s"));

// Crear una instancia del servicio
$servicioPublicaciones = new servicioPublicaciones();

// Llamar al método para modificar la publicación
$resultado = $servicioPublicaciones->modificarPublicacion($publicacion);

if ($resultado) {
  echo "<script>
        window.location.href = '../vistas/perfilUser.php';
      </script>";
} else {
  echo "<script>
        window.location.href = '../vistas/perfilUser.php';
      </script>";
}
