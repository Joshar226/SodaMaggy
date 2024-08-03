<h1 class="titulo"><?php echo $titulo ?></h1>
<p class="descripcion">Crea una cuenta y disfuta de nuestros productos</p>

<?php require_once __DIR__ . '/../templates/alertas.php' ?>


<form method="post" class="formulario">
    <div class="campo">
        <label for="nombre">Nombre</label>
        <input
            type="text"
            id="nombre"
            name="nombre"
            placeholder="Tu Nombre"
            value="<?php echo $usuario->nombre ?>">
    </div>

    <div class="campo">
        <label for="apellido">Apellido</label>
        <input
            type="text"
            id="apellido"
            name="apellido"
            placeholder="Tu Apellido"
            value="<?php echo $usuario->apellido ?>">
    </div>

    <div class="campo">
        <label for="correo">Correo</label>
        <input
            type="email"
            id="correo"
            name="correo"
            placeholder="Tu Correo"
            value="<?php echo $usuario->correo ?>">
    </div>

    <div class="campo">
        <label for="telefono">Telefono</label>
        <input
            type="tel"
            id="telefono"
            name="telefono"
            placeholder="Tu Telefono"
            value="<?php echo $usuario->telefono ?>">
    </div>

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

    <input class="submit" type="submit" value="Crear Cuenta">
</form>

<div class="acciones">
    <a href="/auth/login">Ya tienes una cuenta? Inicia Sesión</a>
    <a href="/auth/olvide">Olvidaste tu contraseña?</a>
</div>
