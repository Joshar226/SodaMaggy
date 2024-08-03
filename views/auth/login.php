<h1 class="titulo"><?php echo $titulo ?></h1>
<p class="descripcion">Inicia sesión y disfuta de nuestros productos</p>

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

    <div class="campo">
        <label for="password">Contraseña</label>
        <input
            type="password"
            id="password"
            name="password"
            placeholder="Tu Contraseña">
    </div>

    <input class="submit" type="submit" value="Iniciar sesión">
</form>

<div class="acciones">
    <a href="/auth/registro">Aun no tienes cuenta? Crea Una</a>
    <a href="/auth/olvide">Olvidaste tu contraseña?</a>
</div>
