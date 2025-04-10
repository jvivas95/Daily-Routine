<div id="contenedorPublicaciones">
    <div id="tituloRutinas" class="text-center">
        <p>RUTINAS</p>
    </div>
    <div id="container">
        <?php if (count($publicaciones) > 0): ?>
            <?php foreach ($publicaciones as $publicacion): ?>
                <div id="caja">
                    <div id="tituloPublicacion"><?php echo htmlspecialchars($publicacion['titulo']); ?></div>
                    <div id="separadorCabecera"></div>
                    <div id="cuerpoPublicacion">
                        <p><?php echo htmlspecialchars($publicacion['descripcion']); ?></p>
                    </div>
                    <!-- Mostrar el nombre del usuario -->
                    <div id="piePublicacion">
                        <div id="nombreUsuario">Publicado por: <?php echo htmlspecialchars($publicacion['usuario']); ?></div>
                        <div id="fechaPublicacion">
                            <small>
                                <?php
                                $fechaHoraPublicacion = new DateTime($publicacion['fechaHora']);
                                $fechaActual = new DateTime();
                                $diferenciaFechaHoraPublicacion = $fechaHoraPublicacion->diff($fechaActual);

                                if ($diferenciaFechaHoraPublicacion->days >= 7) {
                                    echo $fechaHoraPublicacion->format('j \d\e F');
                                } elseif ($diferenciaFechaHoraPublicacion->days > 1) {
                                    echo 'Hace ' . $diferenciaFechaHoraPublicacion->days . ' días';
                                } elseif ($diferenciaFechaHoraPublicacion->h > 0) {
                                    echo 'Hace ' . $diferenciaFechaHoraPublicacion->h . ' horas';
                                } elseif ($diferenciaFechaHoraPublicacion->i > 0) {
                                    echo 'Hace ' . $diferenciaFechaHoraPublicacion->i . ' minutos';
                                } else {
                                    echo 'Hace un momento';
                                }

                                ?>
                            </small>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div id="dotlottie">
                <dotlottie-wc
                    src="https://lottie.host/ec3315fa-42cc-4a0c-9832-72062aed3455/KuI5rkTvGQ.lottie"
                    autoplay
                    loop>
                </dotlottie-wc>
            </div>
            <p class="text-center">No hay publicaciones disponibles</p>

        <?php endif; ?>
    </div>
</div>