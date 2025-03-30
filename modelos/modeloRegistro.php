<?php

include_once __DIR__ . "/servicios/servicioRegistro.php";

    $nombreUsuario = $_POST["nombre_usuario"];
    $nombre = $_POST["nombre"];
    $contrasena = $_POST["contrasena"];
    $apellidos = $_POST["apellidos"];
    $edad = $_POST["edad"];
    $email = $_POST["email"];
    $genero = $_POST["genero"];

    $registro = new ServicioRegistro();

    $registro->registroUsuario($nombreUsuario, $nombre, $contrasena, $apellidos, $edad, $email, $genero);












?>