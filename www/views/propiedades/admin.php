<main class="contenedor seccion">
    <h1>Administrador de Bienes Raices</h1>

    <?php
    if ($resultado):
        $mensaje = mostrarNotificacion(intval($resultado));

        if ($mensaje): ?>
            <p class="alerta exito"><?php echo s($mensaje); ?></p>

    <?php
        endif;
    endif;
    ?>

    <a href="/propiedades/crear" class="boton-verde">Nueva Propiedad</a>
    <a href="vendedores/crear.php" class="boton-amarillo">Nuevo/a Vendedor</a>

    <h2>Propiedades</h2>
    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titulo</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody> <!--Mostrar los datos-->
            <?php foreach ($propiedades as $propiedad): ?>
                <tr>
                    <td><?php echo $propiedad->id; ?></td>
                    <td><?php echo $propiedad->titulo; ?></td>
                    <td><img src="/public/imagenes/<?php echo $propiedad->imagen; ?>" alt="Imagen tabla" class="imagen-tabla"></td>
                    <td>$ <?php echo $propiedad->precio; ?></td>
                    <td>
                        <form method="POST" class="w-100">
                            <input type="hidden" name="id" value="<?php echo $propiedad->id; ?>">
                            <input type="hidden" name="tipo" value="propiedad">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>
                        <form action="propiedades/actualizar" method="POST" class="w-100">
                            <input type="hidden" value="<?php echo $propiedad->id; ?>" name="id">
                            <input type="submit" class="boton-amarillo-block w-100" value="Actualizar">
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</main>