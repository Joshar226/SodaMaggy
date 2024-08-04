<main class="main">
    <?php require_once __DIR__ . '/../templates/sidebar.php' ?>
    <div class="cuerpo">
        <h1 class="titulo"><?php echo $titulo ?></h1>

        <?php require_once __DIR__ . '/../templates/alertas.php' ?>

        <form enctype="multipart/form-data" method="post" class="formulario">
            <div class="campo">
                <label for="titulo">Tipo</label>
                <input
                    type="text"
                    id="titulo"
                    name="titulo"
                    placeholder="Tipo de Producto"
                    value="<?php echo $tipo->titulo ?>">
            </div>

            <div class="campo">
                <label for="imagen">Imagen</label>
                <input
                    type="file"
                    id="imagen"
                    name="imagen"
                    accept="image/jpeg, image/png">
            </div>
                <img class="actualizar-tipo-img" src="/imagenes/<?php echo $tipo->imagen ?>" alt="Tipo Imagen">

            <input class="submit" type="submit" value="Actualizar Tipo">
        </form>
    </div>
</main>