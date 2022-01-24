<h1 class="nombre-pagina">Olvidé Password</h1>
<p class="descripcion-pagina">Reestablece tu password escribiendo tu email a continuación</p>
<?php include_once __DIR__ . "/../templates/alertas.php"; ?>


<form class="formulario" action="/forgot" method="POST">
    <div class="campo">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Tu Email">
    </div>
    <input type="submit" class="boton" value="Enviar Instrucciones">
</form>

<div class="acciones">
    <a href="/">¿Ya tienes una cuenta? Inicia sesión</a>
    <a href="/create-account">¿Aun no tienes una cuenta? Crear una</a>
</div>