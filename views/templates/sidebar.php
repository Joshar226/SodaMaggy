<div class="menu-mobile">
    <p id="menu" class="menu-logo"><i class="fa-solid fa-list"></i></p>
    <h2 class="logo">Soda Maggy</h2>
</div>
<aside class="aside">
    <div id="sidebar" class="sidebar">

        <h2 class="logo">Soda Maggy</h2>
        <p id="cerrar" class="cerrar"><i class="fa-solid fa-x"></i></p>

        <div class="enlace">
            <a href="/admin">
                <i class="fa-solid fa-utensils"></i>
                <p>Pedido Local</p>
            </a>
        </div>


        <?php if ($_SESSION['admin']) { ?>

            <div class="enlace">
                <a href="/admin/administrar-tipos">
                    <i class="fa-solid fa-user"></i>
                    <p>Administracion</p>
                </a>
            </div>

            <div class="enlace">
                <a href="/admin/ordenes?fecha=<?php echo date('Y-m-d') ?>">
                    <i class="fa-solid fa-bell-concierge"></i>
                    <p>Ordenes</p>
                </a>
            </div>

            <div class="enlace">
                <a href="/admin/crear-tipo">
                    <i class="fa-solid fa-circle-plus"></i>
                    <p>Nuevo Tipo</p>
                </a>
            </div>


            <div class="enlace">
                <a href="/admin/crear">
                    <i class="fa-solid fa-burger"></i>
                    <p>Nuevo Producto</p>
                </a>
            </div>

        <?php } ?>
    </div>
</aside>