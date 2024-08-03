<main class="main">
    <?php require_once __DIR__ . '/../templates/sidebar.php'?>
    <div class="cuerpo">
        <h1 class="titulo"><?php echo $titulo ?></h1>
        <h2 class="titulo">Productos</h2>

        <div class="tipo">
            <?php foreach ($productos as $producto) { ?>
            <div class="cuerpo">
                <div class="imagen">
                    <img src="/imagenes/<?php echo $producto->imagen ?>" alt="Imagen de Tipo">
                </div>

                <div class="contenido">
                    <h2><?php echo $producto->titulo ?></h2>

                    <h3 class="precio">₡<?php echo $producto->precio ?></h3>

                    <div class="opciones">
                        <a href="admin/actualizar-tipo" class="boton actualizar">Actualizar</a>
                        <button href="admin/eliminar-tipo" class="boton eliminar">Eliminar</button>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>

        
    </div>
</main>