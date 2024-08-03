<h1 class="titulo"><?php echo $titulo ?></h1>
<p class="descripcion">Reestablece tu contraseña y disfuta de nuestros productos</p>

<?php require_once __DIR__ . '/../templates/alertas.php' ?>

<?php if($confirmado) { ?>

<form method="post" class="formulario">
    <div class="campo">
        <label for="password">Contraseña</label>
        <input
            type="password"
            id="password"
            name="password"
            placeholder="Tu Contraseña">
    </div>
    <div class="campo">
        <label for="password2">Repite tu Contraseña</label>
        <input
            type="password"
            id="password2"
            name="password2"
            placeholder="Repite tu Contraseña">
    </div>

    <input class="submit" type="submit" value="Guardar Contraseña">
</form>

<?php } else { ?>
<h1 class="mensaje"><?php echo $body ?></h1>
<?php } ?>


<div class="acciones">
    <a href="/auth/login">Ya tienes una cuenta? Inicia Sesión</a>
    <a href="/auth/registro">Aun no tienes cuenta? Crea Una</a>
</div>


