<h1 class="nombre-pagina">Recuperar constraseña</h1>
<p class="descripcion-pagina">Coloca tu nueva constraseña a continuación</p>
<?php include_once __DIR__ . "/../templates/alertas.php"; ?>

<?php if($error) return; ?>
<form class="formulario" method="POST">
    <div class="campo">
        <label for="password">Contraseña</label>
        <input type="password" id="password" name="password" placeholder="Tu nueva constraseña">
    </div>
    <input type="submit" class="boton" value="Guardar Nueva Contraseña">
</form>

<div class="acciones">
    <a href="/">¿Ya tienes una cuenta? Inicia sesión</a>
    <a href="/create-account">¿Aun no tienes una cuenta? Crear una</a>
</div>