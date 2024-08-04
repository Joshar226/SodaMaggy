<main class="main">
    <?php require_once __DIR__ . '/../templates/sidebar.php' ?>
    <div class="cuerpo">
        <h1 class="titulo"><?php echo $titulo ?></h1>

        <?php require_once __DIR__ . '/../templates/alertas.php' ?>

        <form enctype="multipart/form-data" method="post" class="formulario">
    <div class="campo">
        <label for="titulo">Titulo</label>
        <input
            type="text"
            id="titulo"
            name="titulo"
            placeholder="Titulo de Producto"
            value="<?php echo $producto->titulo ?>">
    </div>

    <div class="campo">
        <label for="precio">Precio</label>
        <input
            type="text"
            id="precio"
            name="precio"
            placeholder="Precio de Producto"
            value="<?php echo $producto->precio ?>">
    </div>

    <div class="campo">
        <label for="imagen">Imagen</label>
        <input
            type="file"
            id="imagen"
            name="imagen">
    </div>
    <img class="actualizar-tipo-img" src="/imagenes/<?php echo $producto->imagen ?>" alt="Producto Imagen">

    <div class="campo">
        <label for="idTipo">Tipo</label>
        <select name="idTipo">
            <option value="">--Seleccione--</option>
            <?php foreach($tipos as $tipo) { ?>
                <option <?php echo $tipo->id === $producto->idTipo ? 'selected' : ''; ?> value="<?php echo $tipo->id ?>"><?php echo $tipo->titulo ?></option>
            <?php } ?>
        </select>
    </div>

    <input class="submit" type="submit" value="Crear Producto">
</form>
    </div>
</main>