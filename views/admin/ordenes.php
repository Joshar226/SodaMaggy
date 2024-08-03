<main class="main">
    <?php require_once __DIR__ . '/../templates/sidebar.php' ?>

    <div class="contenido-ordenes">
        <h1 class="titulo"><?php echo $titulo ?></h1>

        <div class="ordenes-page">
            <form>
                <input 
                    id="fecha"
                    class="fecha-orden"
                    type="date"
                    value="<?php echo $fecha ?>">
            </form>

            <div class="cuerpo-orden">
                <div class="ordenes">
                    <?php foreach($ordenes as $orden) { ?>
                        <div class="orden">
                        <h3>Nº <?php echo $orden->id ?></h3>
                        <p><?php echo $orden->nombre ?></p>
                        <p><?php echo $orden->modo ?></p>
                        <p>fecha</p>
                        <p>hora</p>
                    </div>
                    <?php } ?>
                </div>

                <!-- <div class="mostrar-orden">
                    <div class="datos-usuario">
                        <h3>Orden Nº 3</h3>
                        <p>Joshua Araya</p>
                        <p>Hora: 12:10</p>
                        <p>Fecha: 3/8/24</p>
                    </div>
                    <div class="productos-orden">
                        <div class="datos-producto">
                            <h3>Hamburguesa Doble Torta</h3>
                            <p class="precio">₡2500</p>
                        </div>
                        <div class="datos-producto">
                            <h3>Hamburguesa Doble Torta</h3>
                            <p class="precio">₡2500</p>
                        </div>
                        <div class="datos-producto">
                            <h3>Hamburguesa Doble Torta</h3>
                            <p class="precio">₡2500</p>
                        </div>
                        <div class="datos-producto">
                            <h3>Hamburguesa Doble Torta</h3>
                            <p class="precio">₡2500</p>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</main>