<fieldset>
    <legend>Información General</legend>

    <label for="nombre">Nombre:</label>
    <input type="text"
        id="nombre"
        name="vendedor[nombre]"
        placeholder="Nombre Vendedor/a"
        value="<?php echo s($vendedor->nombre); ?>">

    <label for="nombre">Apellido:</label>
    <input type="text"
        id="apellido"
        name="vendedor[apellido]"
        placeholder="Apellido Vendedor/a"
        value="<?php echo s($vendedor->apellido); ?>">

</fieldset>

<fieldset>
    <legend>Información Extra</legend>

    <label for="telefono">Teléfono:</label>
    <input type="tel"
        id="telefono"
        name="vendedor[telefono]"
        placeholder="Teléfono Vendedor/a"
        value="<?php echo s($vendedor->telefono); ?>">

    <label for="email">E-mail:</label>
    <input type="email"
        id="email"
        name="vendedor[email]"
        placeholder="Correo del Vendedor/a"
        value="<?php echo s($vendedor->email); ?>">

    <label for="imagen">Imagen:</label>
    <input type="file"
        id="imagen"
        name="vendedor[imagen]"
        accept="image/jpeg, image/png"
        value="<?php echo s($vendedor->imagen); ?>">

    <?php if($vendedor->imagen): ?>
    <img src="<?php echo $urlBase; ?>/imagenes/<?php echo s($vendedor->imagen); ?>" class="imagen-small" alt="Imagen del vendedor">
    <?php endif; ?>
</fieldset>