<main class="contenedor seccion">
    <h1>Administrador de Bienes Raices</h1>

    <?php
    if ($resultado):
        $mensaje = mostrarNotificacion(intval($resultado));

        if ($mensaje) { ?>
            <p class="alerta exito"><?php echo s($mensaje); ?></p>

        <?php
        } else { ?>
            <p class="alerta error"><?php echo 'Error al procesar la solicitud'; ?></p>
    <?php
        }
    endif;
    ?>

    <a href="/propiedades/crear" class="boton-verde">Nueva Propiedad</a>
    <a href="/vendedores/crear" class="boton-amarillo">Nuevo/a Vendedor</a>

    <h2>Vendedores</h2>
    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre completo</th>
                <th>Imagen</th>
                <th>Email</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody> <!--Mostrar los datos-->
            <?php foreach ($vendedores as $vendedor): ?>
                <tr>
                    <td><?php echo $vendedor->id; ?></td>
                    <td><?php echo $vendedor->nombre . ' ' . $vendedor->apellido; ?></td>
                    <td><img src="/imagenes/<?php echo $vendedor->imagen; ?>" alt="Imagen tabla" class="imagen-tabla"></td>
                    <td><?php echo $vendedor->email; ?></td>
                    <td>
                        <form method="POST" class="w-100" action="/vendedores/eliminar">
                            <input type="hidden" name="id" value="<?php echo $vendedor->id; ?>">
                            <input type="hidden" name="tipo" value="vendedor">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>

                        <a href="/vendedores/actualizar?id=<?php echo $vendedor->id; ?>" class="boton-amarillo-block">
                            Actualizar
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</main>