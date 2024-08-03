<h1 class="titulo"><?php echo $titulo ?></h1>
<p class="descripcion">Recupera tu contraseña y disfuta de nuestros productos</p>

<?php require_once __DIR__ . '/../templates/alertas.php' ?>

<form method="post" class="formulario">
    <div class="campo">
        <label for="correo">Correo</label>
        <input
            type="email"
            id="correo"
            name="correo"
            placeholder="Tu Correo">
    </div>

    <input class="submit" type="submit" value="Enviar Instrucciones">
</form>

<div class="acciones">
    <a href="/auth/login">Ya tienes una cuenta? Inicia Sesión</a>
    <a href="/auth/registro">Aun no tienes cuenta? Crea Una</a>
</div>
