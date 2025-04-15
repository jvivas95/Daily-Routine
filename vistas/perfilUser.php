<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once __DIR__ . "/../modelos/servicios/servicioPublicaciones.php";
include_once __DIR__ . "/../lib/autenticacion.php";
include_once __DIR__ . "/../config/cargarEnv.php";

//VERIFICAR SI EL USUARIO ESTA AUTENTICADO
if (!Autenticacion::estaAutenticado()) {
  header("Location: /vistas/login.php");
}

// Crear una instancia del servicio
$servicioPublicaciones = new servicioPublicaciones();

$usuarioId = Autenticacion::obtenerUsuario();

// Obtener publicaciones
$publicaciones = $servicioPublicaciones->listarPublicacionesUsuario($usuarioId);
?>

<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>
  <script src="../assets/js/color-modes.js"></script>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.122.0">
  <title>Contacto</title>

  <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/sidebars/">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

  <!-- Custom styles for this template -->
  <link href="/../assets/css/custom.css" rel="stylesheet">

</head>

<body>

  <div id="paginaPublicaciones">
    <!-- SIDEBAR -->
    <?php
    include_once __DIR__ . "/inc/header.php";
    include_once __DIR__ . "/inc/navigatorColum.php";
    ?>
    <!-- SE MUESTRAN LAS PUBLICACIONES DE LA BASE DE DATOS  -->
    <div id="contenedorPublicaciones">
      <div id="tituloRutinas">
        <p>MIS RUTINAS</p>
      </div>
      <div id="container">
        <?php if (count($publicaciones) > 0): ?>
          <?php foreach ($publicaciones as $publicacion): ?>
            <div id="caja">
              <div id="tituloPublicacion"><?php echo htmlspecialchars($publicacion['titulo']); ?></div>
              <div id="separadorCabecera"></div>
              <div id="cuerpoPublicacion">
                <p><?php echo htmlspecialchars($publicacion['descripcion']); ?></p>
              </div>
              <div id="fechaPublicacion">
                <small>
                  <?php
                  $fechaHoraPublicacion = new DateTime($publicacion['fechaHora']);
                  $fechaActual = new DateTime();
                  $diferenciaFechaHoraPublicacion = $fechaHoraPublicacion->diff($fechaActual);

                  if ($diferenciaFechaHoraPublicacion->days >= 7) {
                    echo $fechaHoraPublicacion->format('j \d\e F');
                  } elseif ($diferenciaFechaHoraPublicacion->days > 1) {
                    echo 'Hace ' . $diferenciaFechaHoraPublicacion->days . ' días';
                  } elseif ($diferenciaFechaHoraPublicacion->h > 0) {
                    echo 'Hace ' . $diferenciaFechaHoraPublicacion->h . ' horas';
                  } elseif ($diferenciaFechaHoraPublicacion->i > 0) {
                    echo 'Hace ' . $diferenciaFechaHoraPublicacion->i . ' minutos';
                  } else {
                    echo 'Hace un momento';
                  }

                  ?>
                </small>
              </div>
              <div id="botonesModificacion">
                <form method="POST" action="/../modelos/modeloBorrarPubli.php" style="display:inline;" onsubmit="return confirmarBorrado();">
                  <input type="hidden" name="rutina_id" value="<?php echo ($publicacion['rutina_id']); ?>">
                  <button id="botonBorrar" class="boton" type="submit">Borrar rutina</button>
                </form>
                <form method="GET" action="/../modelos/modeloModificarPubli.php" style="display:inline;">
                  <input type="hidden" name="rutina_id" value="<?php echo htmlspecialchars($publicacion['rutina_id']); ?>">
                  <button id="botonModificar" class="boton" type="submit">Modificar rutina</button>
                </form>
              </div>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <div id="dotlottie">
            <dotlottie-wc
              src="https://lottie.host/ec3315fa-42cc-4a0c-9832-72062aed3455/KuI5rkTvGQ.lottie"
              autoplay
              loop>
            </dotlottie-wc>
          </div>
          <p class="text-center">No hay publicaciones disponibles</p>
        <?php endif; ?>
      </div>
      <?php
      include_once __DIR__ . "/inc/navigatorFooter.php";
      ?>
    </div>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/sidebars.js"></script>
    <script src="../assets/js/perfilUser.js"></script>
    <script src="https://unpkg.com/@lottiefiles/dotlottie-wc@0.3.0/dist/dotlottie-wc.js" type="module"></script>


</body>

</html>