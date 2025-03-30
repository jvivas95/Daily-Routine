<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once __DIR__ . "/../../config/config.php";

class ServicioRegistro
{


    public function registroUsuario($nombreUsuario, $nombre, $contrasena, $apellidos, $edad, $email, $genero)
    {
        $errores = array();

        // Realizar la conexión a la base de datos
        $conexion = new mysqli("localhost", "root", "", "dailyroutine");

        // Verificar la conexión
        if ($conexion->connect_error) {
            die("Error de conexión: " . $conexion->connect_error);
        }

        // Verifica si se recibieron los datos del formulario
        if (isset($_POST["nombre_usuario"]) && isset($_POST["nombre"]) && isset($_POST["contrasena"]) && isset($_POST["apellidos"]) && isset($_POST["edad"]) && isset($_POST["email"]) && isset($_POST["genero"])) {


            // Realiza cualquier validación adicional aquí
            if (empty($nombreUsuario) || empty($nombre) || empty($contrasena) || empty($apellidos) || empty($edad) || empty($email) || empty($genero)) {
                $errores[] = "Error: Alguno de los campos está vacío.";
                exit();
            }

            if (strlen($nombreUsuario) > 10) {
                $errores[] = "Error: El nombre de usuario no puede contener más de 10 carácteres";
            }

            // Consulta a la base de datos para verificar si el usuario ya está registrado
            $sqlUserName = "SELECT COUNT(*) as count FROM usuario WHERE user_name = ?";
            $preparacion = $conexion->prepare($sqlUserName);
            $preparacion->bind_param("s", $nombreUsuario);
            $preparacion->execute();
            $result = $preparacion->get_result();
            $userName_existente = $result->fetch_assoc();

            // Verificar si ya existe un usuario con el mismo nombre de usuario
            if ($userName_existente['count'] > 0) {
                // El nombre de usuario ya está registrado, mostrar mensaje de error
                $errores[] = "Nombre de usuario ya está en uso";
            }

            // Validar que el nombre de usuario, el nombre y los apellidos contengan solo letras y espacios y no estén vacíos
            $nombreUsuario = trim($nombreUsuario);

            if (preg_match("/^[a-zA-Z ]+$/", $nombreUsuario)) {
                $errores[] = "Error: El nombre de usuario solo puede contener letras y sin espacios en blanco";
            }

            // Consulta a la base de datos para verificar si el correo electrónico ya está registrado
            $sqlEmail = "SELECT COUNT(*) as count FROM usuario WHERE email = ?";
            $preparacion = $conexion->prepare($sqlEmail);
            $preparacion->bind_param("s", $email);
            $preparacion->execute();
            $result = $preparacion->get_result();
            $usuario_existente = $result->fetch_assoc();

            // Verificar si ya existe un usuario con el mismo correo electrónico
            if ($usuario_existente['count'] > 0) {
                // El correo electrónico ya está registrado, mostrar mensaje de error
                $errores[] = "El correo electrónico ya está registrado en nuestra base de datos.";
            }

            if (!preg_match("/^[a-zA-Z ]+$/", $nombre)) {
                $errores[] = "Error: El nombre solo puede contener letras.";
            }

            if (!preg_match("/^[a-zA-Z ]+$/", $apellidos)) {
                $errores[] = "Error: Los apellidos solo pueden contener letras.";
            }

            //Validar que el usuario sea mayor de edad

            if ($edad < 18) {
                $errores[] = "La edad mínima es 18 años";
            }

            // Validar que el email contenga al menos una arroba
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errores[] = "Error: El formato del correo electrónico es inválido.";
            }

            if (!empty($errores)) {
                // Redirigir a registro.php con los errores como parámetro GET
                $errores_encoded = urlencode(json_encode($errores)); // Codificar los errores como URL
                header("Location: ../vistas/registro.php?errores=$errores_encoded");
                exit();
            }


            // Hash de la contraseña
            $hash_contrasena = hash('sha256', $contrasena);



            // Consulta SQL para insertar el usuario y la contraseña en la base de datos
            $sql = "INSERT INTO usuario (user_name, nombre, apellidos, edad, email, genero, contrasena) VALUES (?, ?, ?, ?, ?, ?, ?)";

            // Preparar la consulta
            $statement = $conexion->prepare($sql);
            if (!$statement) {
                die("Error al preparar la consulta: " . $conexion->error);
            }

            // Vincular los parámetros y ejecutar la consulta
            $statement->bind_param("ssissss", $nombreUsuario, $nombre, $apellidos, $edad, $email, $genero, $hash_contrasena);
            if ($statement->execute()) {

                header("location: /vistas/login.php");
            } else {
                echo "Error al registrar el usuario: " . $statement->error . "<br>";
            }

            // Cerrar la conexión a la base de datos
            $statement->close();
            $conexion->close();
        } else {
            echo "Error: No se recibieron los datos del formulario.";
        }
    }
}
