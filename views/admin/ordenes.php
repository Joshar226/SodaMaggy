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
                        <a href="/admin/orden?id=<?php echo $orden->id ?>" class="orden">
                        <h3>Nº <?php echo $orden->id ?></h3>
                        <p><?php echo $orden->usuarioId ?></p>
                        <p><?php echo $orden->modo ?></p>
                        <p><?php echo $orden->fecha ?></p>
                        <p><?php echo $orden->hora ?></p>
                    </a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</main>