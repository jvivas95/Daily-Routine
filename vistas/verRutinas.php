<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once __DIR__ . "/../modelos/servicios/servicioPublicaciones.php";
include_once __DIR__ . "/../lib/autenticacion.php";
include_once __DIR__ . "/../config/cargarEnv.php";


// Crear una instancia del servicio
$servicioPublicaciones = new servicioPublicaciones();

// Obtener el nombre de usuario
$usuarioId = Autenticacion::obtenerUsuario();

// Obtener publicaciones
$publicaciones = $servicioPublicaciones->listarPublicaciones();
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="auto">
<head>
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

    <script src="../assets/js/contact.js"></script>

    <!-- Custom styles for this template -->
    <link href="../assets/css/verRutinas.css" rel="stylesheet">
</head>

<body>
    <div id="paginaPublicaciones">
        <!-- SIDEBAR -->
        <?php
        include "inc/header.php";
        include("inc/navigatorColum.php");
        ?>
        <!-- SE MUESTRAN LAS PUBLICACIONES DE LA BASE DE DATOS  -->
        <div id="contenedorPublicaciones">
            <div id="tituloRutinas"> <p>RUTINAS</p> </div>
            <div id="container">
                <?php if (count($publicaciones) > 0): ?>
                    <?php foreach ($publicaciones as $publicacion): ?>
                        <div id="caja">
                        <div>Publicado por: <?php echo htmlspecialchars($publicacion['usuario']); ?></div>
                            <div id="tituloPublicacion"><?php echo htmlspecialchars($publicacion['titulo']); ?></div>
                            <div id="separadorCabecera"></div>
                            <div id="cuerpoPublicacion">
                                <p><?php echo htmlspecialchars($publicacion['descripcion']); ?></p>
                            </div>
                            <!-- Mostrar el nombre del usuario -->
                            <div id="piePublicacion">
                                <div id="botonFacebook">
                                    <!-- Botón para compartir en Facebook -->
                                    <a class="share-button facebook" href="https://www.facebook.com/sharer/sharer.php?" target="_blank">
                                    <i class="fab fa-facebook-f" ></i> <!-- Icono de Facebook -->
                                    </a>
                                </div>
                                <div>
                                    <!-- Botón para compartir en Twitter -->
                                    <a class="share-button twitter" href="https://twitter.com/intent/tweet?text=" target="_blank">
                                    <i class="fab fa-twitter"></i> <!-- Icono de Twitter -->
                                    </a>
                                </div>
                                <div id="fechaPublicacion">
                                    <small><?php echo htmlspecialchars($publicacion['fechaHora']); ?></small>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No hay publicaciones disponibles.</p>
                <?php endif; ?>  
            </div>
        </div>
    </div>

    <script>
        // Evento al hacer scroll en la página
        window.addEventListener("scroll", function() {
            // Verificar si el usuario ha llegado al final de la página
            if (window.innerHeight + window.scrollY >= document.body.offsetHeight) {
                cargarMasPublicaciones();
            }
        });
    </script>

    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/sidebars.js"></script>
</body>
</html>
