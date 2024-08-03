<main class="main">
    <?php require_once __DIR__ . '/../templates/sidebar.php' ?>

    <div class="contenido-ordenes">
        <h1 class="titulo"><?php echo $titulo ?></h1>

        <div class="ordenes-page">
            <form>
                <input 
                    class="fecha-orden"
                    type="date"
                    value="">
            </form>

            <div class="cuerpo-orden">
                <div class="ordenes">
                    <div class="orden">
                        <h3>Nº 3</h3>
                        <p>Joshua Araya</p>
                        <p>local</p>
                        <p>fecha</p>
                        <p>hora</p>
                    </div>
                    <div class="orden">
                        <h3>Nº 3</h3>
                        <p>Dan Araya</p>
                        <p>local</p>
                        <p>fecha</p>
                        <p>hora</p>
                    </div>
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