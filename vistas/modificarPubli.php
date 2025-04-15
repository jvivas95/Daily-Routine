<?php
include_once __DIR__ . "/../modelos/servicios/servicioPublicaciones.php";
include_once __DIR__ . "/../modelos/modeloPublicacion.php";
include_once __DIR__ . "/../lib/autenticacion.php";

// Crear una instancia del servicio
$servicioPublicaciones = new servicioPublicaciones();

if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

if (!isset($_SESSION["usuario"])) {
  echo "<script>
        alert('Debes autenticarte para realizar esta acción');
        window.location.href = '/vistas/login.php';
      </script>";
  exit;
}

$usuarioId = $_SESSION["usuario"];

if (!isset($_GET["rutina_id"])) {
  echo "<script>
        alert('No se proporcionó el ID de la publicación');
        window.location.href = '/vistas/perfilLoggin.php';
      </script>";
  exit;
}

$rutina_id = $_GET["rutina_id"];
$publicacion = $servicioPublicaciones->obtenerPublicacionPorId($rutina_id, $usuarioId);
?>
<div id="contenedorPublicaciones">
  <div id="tituloRutinas">
    <p>MODIFICAR PUBLICACION</p>
  </div>
  <div id="container">

    <form method="POST" action="/modelos/procesarModificacionPubli.php">
      <input type="hidden" name="rutina_id" value="<?php echo htmlspecialchars($publicacion->getId()); ?>">
      <div class="mb-3">
        <label for="titulo" class="form-label">Título</label>
        <input type="text" class="form-control" id="titulo" name="titulo" value="<?php echo htmlspecialchars($publicacion->getTitulo()); ?>" required>
      </div>
      <div class="mb-3">
        <label for="descripcion" class="form-label">Descripción</label>
        <textarea class="form-control" id="descripcion" name="descripcion" required><?php echo htmlspecialchars($publicacion->getDescripcion()); ?></textarea>
      </div>
      <div id="botones">
        <button id="botonModificar" class="boton" type="submit">Guardar cambios</button>
        <a href="/../vistas/perfilUser.php" id="botonCancelar" class="boton">Cancelar</a>
      </div>

    </form>
  </div>
</div>

<script src="../assets/js/perfilUser.js"></script>