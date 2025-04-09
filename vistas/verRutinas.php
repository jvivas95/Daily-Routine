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
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Boldonse&display=swap" rel="stylesheet">
    <script src="/assets/js/contact.js"></script>

    <!-- Custom styles for this template -->
    <link href="/../assets/css/custom.css" rel="stylesheet">

</head>

<body>
    <div id="paginaPublicaciones">
        <!-- SIDEBAR -->
        <?php
        include_once __DIR__ . "/inc/header.php";
        include_once __DIR__ . "/inc/navigatorColum.php";
        include_once __DIR__ . "/inc/contenedorRutinas.php";
        include_once __DIR__ . "/inc/navigatorFooter.php";
        ?>
        <!-- SE MUESTRAN LAS PUBLICACIONES DE LA BASE DE DATOS  -->
    </div>


    <script>
        // Optimización del evento scroll con debounce
        let isFetching = false;

        function debounce(func, wait) {
            let timeout;
            return function(...args) {
                clearTimeout(timeout);
                timeout = setTimeout(() => func.apply(this, args), wait);
            };
        }

        const cargarMasPublicaciones = debounce(() => {
            if (isFetching) return;
            isFetching = true;

            // Simulación de carga de publicaciones
            console.log("Cargando más publicaciones...");
            setTimeout(() => {
                isFetching = false;
            }, 1000);
        }, 200);

        window.addEventListener("scroll", function() {
            if (window.innerHeight + window.scrollY >= document.body.offsetHeight) {
                cargarMasPublicaciones();
            }
        });
    </script>

    <script src="https://unpkg.com/@lottiefiles/dotlottie-wc@0.3.0/dist/dotlottie-wc.js" type="module"></script>
    <script src="/../assets/js/bootstrap.bundle.min.js"></script>
    <script src="/../assets/js/sidebars.js"></script>
</body>

</html>