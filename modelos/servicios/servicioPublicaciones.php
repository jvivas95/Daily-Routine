<?php

require_once __DIR__ . "/../../lib/GestorBD.php";

class servicioPublicaciones
{

    public function crearPublicacion($id_usuario, $titulo, $descripcion, $fecha)
    {

        // Consulta SQL para insertar la rutina en la base de datos
        $sql = "INSERT INTO rutina (user_id, titulo, descripcion, fechaHora) VALUES (?, ?, ?, ?)";
        return GestorBD::consultaEscritura($sql, $id_usuario, $titulo, $descripcion, $fecha);
    }

    public function listarPublicaciones()
    {
        // Consulta SQL para listar las rutinas junto con el nombre del usuario y ordenar por fecha descendente
        $sql = "SELECT rutina.*, usuario.nombre AS usuario 
            FROM rutina 
            JOIN usuario ON rutina.user_id = usuario.user_id
            ORDER BY rutina.fechaHora DESC";

        return GestorBD::consultaLectura($sql);
    }


    public function listarPublicacionesUsuario($nombreUsuario)
    {
        // Consulta SQL para listar las publicaciones del usuario con el nombre especificado
        $sql = "SELECT rutina.* FROM rutina 
                    INNER JOIN usuario ON rutina.user_id = usuario.user_id 
                    WHERE usuario.user_name = ?
                    ORDER BY rutina.fechaHora DESC";

        return GestorBD::consultaLectura($sql, $nombreUsuario);
    }

    public function borrarPublicacion($id_publicacion)
    {
        // Consulta SQL para borrar la publicación en la base de datos
        $sql = "DELETE FROM rutina WHERE rutina_id = ?";

        return GestorBD::consultaEscritura($sql, $id_publicacion);
    }

    public function modificarPublicacion($publicacion)
    {
        // Consulta SQL para actualizar la publicación en la base de datos
        $sql = "UPDATE rutina SET titulo = ?, descripcion = ?, fechaHora = ? WHERE rutina_id = ?";

        return GestorBD::consultaEscritura(
            $sql,
            $publicacion->getTitulo(),
            $publicacion->getDescripcion(),
            $publicacion->getFechaHora(),
            $publicacion->getId()
        );
    }

    public function obtenerPublicacionPorId($id)
    {
        // Consulta SQL para obtener la publicación por ID y usuario
        $sql = "SELECT * FROM rutina WHERE rutina_id = ?";

        $resultado = GestorBD::consultaLectura($sql, $id);

        if (count($resultado) > 0) {
            $publicacion = $resultado[0];
            return new Publicacion(
                $publicacion['rutina_id'],
                $publicacion['titulo'],
                $publicacion['descripcion'],
                $publicacion['fechaHora'],
                $publicacion['user_id'],
            );
        }

        return null;
    }
}
