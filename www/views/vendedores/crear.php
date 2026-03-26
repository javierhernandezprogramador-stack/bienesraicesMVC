<main class="contenedor seccion">
    <h1>Registrar Vendedor/a</h1>

    <a href="/vendedores/admin" class="boton-verde">Volver</a>

    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach ?>

    <form method="POST" class="formulario" enctype="multipart/form-data">

        <?php include "formulario.php"; ?>

        <input type="submit" value="Registrar Vendedor/a" class="boton-verde">
    </form>
</main>