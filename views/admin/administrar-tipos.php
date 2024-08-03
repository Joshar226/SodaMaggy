<main class="main">
    <?php require_once __DIR__ . '/../templates/sidebar.php' ?>
    <div class="cuerpo">
        <h1 class="titulo"><?php echo $titulo ?></h1>
        <h2 class="titulo">Tipos</h2>

        <div class="tipo">
            <?php foreach ($tipos as $tipo) { ?>
            <div class="cuerpo">
                <div class="imagen">
                    <img src="/imagenes/<?php echo $tipo->imagen ?>" alt="Imagen de Tipo">
                </div>

                <div class="contenido">
                    <h2><?php echo $tipo->titulo ?></h2>

                    <div class="opciones">
                        <a href="administrar-productos?id=<?php echo $tipo->id ?>" class="boton producto">Productos</a>
                        <a href="actualizar-tipo" class="boton actualizar">Actualizar</a>
                        <button href="eliminar-tipo" class="boton eliminar">Eliminar</button>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>

        
    </div>
</main>