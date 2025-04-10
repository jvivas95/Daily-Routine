<?php
include_once __DIR__ . "/../../lib/autenticacion.php";

if (!isset($_SESSION["usuario"]) && basename($_SERVER['SCRIPT_NAME']) != 'index.php') {
  header("Location: /vistas/login.php");
  exit();
}

?>
<!doctype html>
<html lang="es" data-bs-theme="auto">

<head>
  <!-- Scripts -->
  <script src="/assets/js/color-modes.js"></script>

  <!-- Meta Tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.122.0">
  <title>DAILY ROUTINE</title>

  <!-- Canonical Link -->
  <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/carousel/">

  <!-- Stylesheets -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
  <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="/assets/css/carousel.css" rel="stylesheet">
</head>

<body>
  <!-- SVG Symbols -->
  <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
  </svg>
  <!-- Header -->
  <header data-bs-theme="dark">
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
      <div class="container-fluid">
        <a href="/index.php">
          <img src="/assets/img/logo.png" style="width: 25%; padding: 5px;" alt="Logo" />
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav ms-auto mb-2 mb-md-0">
            <?php if (Autenticacion::estaAutenticado()) { ?>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="/vistas/verRutinas.php">
                  <?php echo Autenticacion::obtenerUsuario(); ?>
                </a>
              </li>
              <li class="nav-item">
                <div style="border-top: 1px solid white; width: 100%;"></div>
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="/vistas/logout.php"> Cerrar sesión</a>
              </li>
            <?php } else { ?>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="/vistas/login.php">Iniciar Sesión / </a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="/vistas/registro.php">Registrarse</a>
              </li>
            <?php } ?>
            <!-- AÑADIR MAS ITEMS
          <li class="nav-item">
            <a class="nav-link active" aria-current="page">SOCIAL</a>
          </li>
          -->
          </ul>
        </div>
      </div>
    </nav>
  </header>