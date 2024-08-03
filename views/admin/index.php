<main class="main">
    <?php require_once __DIR__ . '/../templates/sidebar.php' ?>
    <div class="cuerpo-tipos">
        <h1 class="titulo"><?php echo $titulo ?></h1>

        <div hidden id="id"><?php echo $_SESSION['id'] ?></div>
        <div hidden id="nombre"><?php echo $_SESSION['nombre'] ?></div>

        <div class="guardar">
            <button  id="confirmar" class="boton-guardar">Confirmar Pedido</button>
            <button  id="guardar" class="boton-guardar">Guardar Pedido</button>
        </div>

        <div id="pedido-local"></div>

    </div>
</main>