<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . "/../../lib/GestorBD.php";
require_once __DIR__ . "/../../config/cargarEnv.php";


class ServicioRegistro
{
    public function registroUsuario($nombreUsuario, $nombre, $contrasena, $apellidos, $edad, $email, $genero)
    {
        $errores = [];

        // Validar que los datos no estén vacíos
        if (empty($nombreUsuario) || empty($nombre) || empty($contrasena) || empty($apellidos) || empty($edad) || empty($email) || empty($genero)) {
            $errores[] = "Error: Alguno de los campos está vacío.";
            exit();
        }

        // Validar longitud del nombre de usuario
        if (strlen($nombreUsuario) > 10) {
            $errores[] = "Error: El nombre de usuario no puede contener más de 10 caracteres.";
        }

        // Validar formato del nombre de usuario (solo letras y números, sin espacios)
        if (!preg_match("/^[a-zA-Z0-9]+$/", $nombreUsuario)) {
            $errores[] = "Error: El nombre de usuario solo puede contener letras y números, sin espacios.";
        }

        // Validar que el nombre y los apellidos contengan solo letras y espacios
        if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/", $nombre)) {
            $errores[] = "Error: El nombre solo puede contener letras y espacios.";
        }

        if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/", $apellidos)) {
            $errores[] = "Error: Los apellidos solo pueden contener letras y espacios.";
        }

        // Validar que la edad sea un número entero y mayor o igual a 18
        if (!filter_var($edad, FILTER_VALIDATE_INT) || $edad < 18) {
            $errores[] = "Error: La edad mínima es 18 años.";
        }

        // Validar formato del correo electrónico
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errores[] = "Error: El formato del correo electrónico es inválido.";
        }

        // Verificar si el nombre de usuario ya existe
        $consultaUsuario = "SELECT COUNT(*) as count FROM usuario WHERE user_name = ?";
        $resultadoUsuario = GestorBD::consultaLectura($consultaUsuario, $nombreUsuario);

        if ($resultadoUsuario[0]['count'] > 0) {
            $errores[] = "Error: El nombre de usuario ya está en uso.";
        }

        // Verificar si el correo electrónico ya existe
        $consultaEmail = "SELECT COUNT(*) as count FROM usuario WHERE email = ?";
        $resultadoEmail = GestorBD::consultaLectura($consultaEmail, $email);

        if ($resultadoEmail[0]['count'] > 0) {
            $errores[] = "Error: El correo electrónico ya está registrado.";
        }

        // Si hay errores después de las verificaciones, redirigir con los errores
        if (!empty($errores)) {
            $errores_encoded = urlencode(json_encode($errores));
            header("Location: ../vistas/registro.php?errores=$errores_encoded");
            exit();
        }

        // Hash de la contraseña
        $hash_contrasena = password_hash($contrasena, PASSWORD_BCRYPT);

        // Insertar el usuario en la base de datos
        $consultaInsertar = "INSERT INTO usuario (user_name, nombre, apellidos, edad, email, genero, contrasena) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $resultadoInsertar = GestorBD::consultaEscritura($consultaInsertar, $nombreUsuario, $nombre, $apellidos, $edad, $email, $genero, $hash_contrasena);

        if ($resultadoInsertar) {
            header("Location: /vistas/login.php");
        } else {
            echo "Error al registrar el usuario.";
        }
    }
}
