<?php
include_once __DIR__ . ("/../lib/autenticacion.php");
include_once __DIR__ . "/../config/cargarEnv.php";

//VERIFICAR SI EL USUARIO ESTA AUTENTICADO
if (!Autenticacion::estaAutenticado()) {
  header("Location: /vistas/login.php");
}

include_once __DIR__ . ("/inc/header.php");
include_once __DIR__ . ("/inc/navigatorColum.php");

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
  <title>Publicar</title>

  <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/sidebars/">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet">

  <script src="../assets/js/contact.js"></script>

  <!-- Custom styles for this template -->
  <link href="../assets/css/crearRutina.css" rel="stylesheet">

</head>

<body> <!-- CABECERA CREAR PUBLICACIONES -->
  <div id="contenedorPublicaciones">
    <div id="tituloCrearRutinas">NUEVA PUBLICACION</div>
    <form method="POST" action="/modelos/modeloCrearPubli.php">
      <div id="container">
        <div class="caja">
          <div id="cabeceraPublicacion">
            <div id="infoCabecera">
              <div>
                <select id="tituloPublicacion" name="categoria">
                  <option value="Bienestar">-Bienestar</option>
                  <option value="Productividad">-Productividad</option>
                  <option value="Crecimiento">-Crecimiento</option>
                </select>
              </div>
              <div id="nUsuario" name="usuarioId"></div>
            </div>
            <div id="separadorCabecera"></div>
          </div>
          <div id="publicacion">
            <textarea id="textoPublicacion" name="descripcion" placeholder="Introducir texto de la publicación"></textarea>
          </div>
          <div id="fechaPublicacion" name="fechaHora"></div>
        </div>
        <div id="contenedorBotones">
          <button id="publicar" type="submit">¡PUBLICAR!</button>
        </div>
      </div>
    </form>
  </div>
  <script>
    // Evento al hacer scroll en la página
    window.addEventListener("scroll", function() {
      // Verificar si el usuario ha llegado al final de la página
      if (window.innerHeight + window.scrollY >= document.body.offsetHeight) {
        cargarMasPublicaciones();
      }
    });

    /* SCRIPT PARA AÑADIR LA FECHA EN LA TABLA DE crearRutina.php */
    document.addEventListener('DOMContentLoaded', function() {
      const fechaPublicacion = document.getElementById('fechaPublicacion');
      const fechaActual = new Date();
      const opcionesFecha = {
        day: 'numeric',
        month: 'numeric',
        year: 'numeric'
      };
      fechaPublicacion.textContent = fechaActual.toLocaleDateString('es-ES', opcionesFecha);
    });
  </script>

  <script src="../assets/js/bootstrap.bundle.min.js"></script>

  <script src="../assets/js/sidebars.js"></script>

</body>

</html>