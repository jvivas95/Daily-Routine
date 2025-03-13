<?php 
include_once __DIR__."/../modelos/servicios/servicioAutenticacion.php";
include_once __DIR__."/../config/config.php";


class Autenticacion{

    const claveUsuario = "usuario";
    const cookieUsuario = "usuario";

    public static function estaAutenticado(){
        // Debugging: Mostrar si el usuario está autenticado
        if (session_status() === PHP_SESSION_NONE){
        session_start();
        }
        if(!isset($_SESSION['usuario'])){
            header("Location: ".BASE_URL."/vistas/login.php");
            exit();
        }
        return isset($_SESSION[self::claveUsuario]);
    }

    public static function obtenerUsuario(){

        if (self::estaAutenticado()){
            // Debugging: Mostrar el usuario obtenido
            //echo "Usuario obtenido: " . $_SESSION[self::claveUsuario] . "<br>";
            return $_SESSION[self::claveUsuario];
        }
        else{
            // Debugging: Indicar que no hay usuario autenticado
            //echo "No hay usuario autenticado.<br>";
            return '';


        }
    }

    public static function autenticar($nombre, $contrasena){
        // Debugging: Mostrar los datos de inicio de sesión
        //echo "Intentando autenticar con nombre de usuario: $nombre, contraseña: $contrasena<br>";

        if (ServicioAutenticacion::validarUsuarioContrasena($nombre, $contrasena)){
            // Debugging: Indicar que la autenticación fue exitosa
            //echo "Autenticación exitosa<br>";

            // Establecer la sesión y la cookie del usuario autenticado
            $_SESSION[self::claveUsuario] = $nombre;
            setcookie(self::cookieUsuario, $nombre);

            return true;
        }
        else{
            // Debugging: Indicar que la autenticación falló
            //echo "Autenticación fallida<br>";
            return false;
        }
    }
    
    public static function obtenerCookieUsuario(){

        if (isset($_COOKIE[self::cookieUsuario])){
            // Debugging: Mostrar la cookie del usuario obtenida
            //echo "Cookie del usuario obtenida: " . $_COOKIE[self::cookieUsuario] . "<br>";
            return $_COOKIE[self::cookieUsuario];
        }
        else{
            // Debugging: Indicar que no se encontró la cookie del usuario
            //echo "No se encontró la cookie del usuario.<br>";
            return '';
        }
    }

    public static function cerrarSesion(){
        if (session_status() == PHP_SESSION_NONE){
            session_start();
        }
        session_unset();
        session_destroy();
        header("Location: ".BASE_URL."/index.php");
    }
}
?> 
