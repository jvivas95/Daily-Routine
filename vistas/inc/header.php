<?php 
  
  include_once "./config/config.php";
  
?>
<!doctype html>
<html lang="es" data-bs-theme="auto">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.122.0">
  <title>DAYLY ROUTINE</title>

  <link href="<?php echo(BASE_URL) ?>/assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo(BASE_URL) ?>/assets/css/carousel.css" rel="stylesheet">
</head>
<body>
<!-- CABECERA -->    
<header data-bs-theme="dark">
  <nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container-fluid">
      <img src="<?php echo (BASE_URL) ?>/assets/img/logo.png" style="width: 10%; padding: 5px;"/>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav me-auto mb-2 mb-md-0">
          <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="/rutinasApp-proyecto/index.php">HOME</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/rutinasApp-proyecto/vistas/contact.php">CONTACTO</a>
          </li>
          <li class="nav-item">
            <a class="nav-link disabled" aria-disabled="true">SOCIAL</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</header>