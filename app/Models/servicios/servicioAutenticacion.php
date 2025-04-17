<?php

include_once __DIR__ . "/../../lib/GestorBD.php";

class ServicioAutenticacion
{

    public static function validarUsuarioContrasena($nombreUsuario, $contrasena)
    {
        // Consulta para obtener la contraseña encriptada del usuario
        $consulta = "SELECT contrasena FROM usuario WHERE user_name = ?";
        $resultado = GestorBD::consultaLectura($consulta, $nombreUsuario);

        if (count($resultado) > 0) {
            $hash_contrasena = $resultado[0]['contrasena'];

            // Verificar la contraseña ingresada con la almacenada
            if (password_verify($contrasena, $hash_contrasena)) {
                return true; // Contraseña correcta
            }
        }

        return false; // Usuario no encontrado o contraseña incorrecta
    }

    public static function obtenerUsuario() {}
}
