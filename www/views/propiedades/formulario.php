<fieldset>
    <legend>Información General</legend>

    <label for="titulo">Titulo:</label>
    <input type="text"
        id="titulo"
        name="propiedad[titulo]"
        placeholder="Titulo Propiedad"
        value="<?php echo s($propiedad->titulo); ?>">

    <label for="precio">Precio:</label>
    <input type="number"
        id="precio"
        name="propiedad[precio]"
        placeholder="Titulo Propiedad"
        value="<?php echo s($propiedad->precio); ?>">

    <label for="imagen">Imagen:</label>
    <input type="file"
        id="imagen"
        name="propiedad[imagen]"
        accept="image/jpeg, image/png">

    <?php if ($propiedad->imagen): ?>
        <p><?php echo $propiedad->imagen; ?></p>
        <img src="/imagenes/<?php echo $propiedad->imagen; ?>" alt="Imagen de la propiedad" class="imagen-small">
    <?php endif; ?>

    <label for="descripcion">Descripción:</label>
    <textarea name="propiedad[descripcion]"
        id="descripcion"><?php echo s($propiedad->descripcion); ?></textarea>
</fieldset>

<fieldset>
    <legend>Información Propiedad</legend>

    <label for="habitacion">Habitaciones:</label>
    <input type="number"
        id="habitacion"
        name="propiedad[habitaciones]"
        placeholder="Ej:3"
        min="1"
        max="9"
        value="<?php echo s($propiedad->habitaciones); ?>"> <!--step-->

    <label for="wc">Baños:</label>
    <input type="number"
        id="wc"
        name="propiedad[wc]"
        placeholder="Ej:3"
        value="<?php echo s($propiedad->wc); ?>">

    <label for="estacionamiento">Estacionamientos:</label>
    <input type="number"
        id="estacionamiento"
        name="propiedad[estacionamiento]"
        placeholder="Ej:3"
        value="<?php echo s($propiedad->estacionamiento); ?>">

</fieldset>

<fieldset>
    <legend>Vendedor</legend>

    <select name="propiedad[vendedores_id]" id="vendedor">
        <option value="" selected disabled> -- Seleccionar --</option>
        <?php foreach ($vendedores as $vendedor): ?>
            <option <?php echo (s($vendedor->id) === s($propiedad->vendedores_id) ? 'selected' : '') ?> value="<?php echo s($vendedor->id); ?>">
                <?php echo s($vendedor->nombre) . " " . s($vendedor->apellido); ?>
            </option>
        <?php endforeach; ?>
    </select>
</fieldset>