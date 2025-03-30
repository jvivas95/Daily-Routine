<?php
class GestorBD
{

    public static function conectar()
    {
        $host = $_ENV['DB_HOST'] ?? null;
        $usuario = $_ENV['DB_USER'] ?? null;
        $password = $_ENV['DB_PASS'] ?? null;
        $nombreDB = $_ENV['DB_NAME'] ?? null;

        if (!$host || !$usuario || !$password || !$nombreDB) {
            throw new Exception("Error: Las variables de entorno de la base de datos no están configuradas.");
        }

        $conexion = new mysqli($host, $usuario, $password, $nombreDB);

        if ($conexion->connect_error) {
            die("Error de conexión: " . $conexion->connect_error);
        }

        return $conexion;
    }


    public static function desconectar($conexion)
    {
        if ($conexion) {
            $conexion->close();
        }
    }


    private static function preparar($conexion, $consulta, $parametros)
    {
        $preparada = $conexion->prepare($consulta);

        if ($parametros) {
            $tipos = "";
            foreach ($parametros as $parametro) {
                $tipos .= is_integer($parametro) ? "i" : "s";
            }
            $preparada->bind_param($tipos, ...$parametros);
        }
        return $preparada;
    }

    public static function consultaLectura($consulta, ...$parametros)
    {

        $conexion = self::conectar();
        $retorno = array();
        $preparada = self::preparar($conexion, $consulta, $parametros);
        $preparada->execute();
        $resultado = $preparada->get_result();

        while ($fila = $resultado->fetch_assoc()) {
            array_push($retorno, $fila);
        }

        return $retorno;
    }

    public static function consultaEscritura($consulta, ...$parametros)
    {
        $conexion = self::conectar();

        $preparada = self::preparar($conexion, $consulta, $parametros);
        $resultado = $preparada->execute();

        self::desconectar($conexion);

        return $resultado;
    }
}
