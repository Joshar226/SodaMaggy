<main class="main">
    <?php require_once __DIR__ . '/../templates/sidebar.php' ?>

    <div class="contenido-ordenes">
        <h1 class="titulo"><?php echo $titulo ?></h1>

        <div class="ordenes-page">
            
            <div class="cuerpo-orden">
                <div class="mostrar-orden">
                    <div class="datos-usuario">
                        <h3>Orden Nº <?php echo $id ?></h3>
                        <p>Joshua Araya</p>
                        <p>Hora: <?php echo $orden->hora ?></p>
                        <p>Fecha: <?php echo $orden->fecha ?></p>
                    </div>

                    <div class="productos-orden">
                        <?php 
                            foreach($productos as $producto) { ?>
                                <div class="datos-producto">
                                    <h3><?php echo $producto[0] ?></h3>
                                    <p class="precio">₡<?php echo $producto[1] ?></p>
                                </div>
                        <?php } ?>

                        <h2>Total: ₡<?php echo $total?></h2>
                    </div>                
                </div>
            </div>
        </div>
    </div>
</main>