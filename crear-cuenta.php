<?php
require_once 'inc/funciones/funciones.php';
require_once 'inc/templates/header.php';
?>
<div class="contenedor-formulario">
    <h1>BOOKMARK <span> Crear Cuenta</span></h1>
    <form id="formulario" class="caja-login" method="post">
        <div class="campo">
            <label for="usuario">Usuario: </label>
            <input type="text" name="usuario" id="usuario" placeholder="Usuario" value="demo">
        </div>
        <div class="campo">
            <label for="password">Password: </label>
            <input type="password" name="password" id="password" placeholder="Pon tu contraseña" value="demo">
        </div>
        <div class="campo enviar">
            <!-- este campo oculto no se envía adjunta al FormData, debes adherirlo con el método append -->
            <input type="hidden" id="tipo" value="crear">
            <input type="submit" class="boton" value="Crear cuenta">
        </div>
        <div class="campo">
            <a href="login.php">Inicia Sesión</a>
        </div>
    </form>
</div>

<?php
require_once 'inc/templates/footer.php'
?>
