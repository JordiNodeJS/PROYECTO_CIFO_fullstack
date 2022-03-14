<?php
session_start();
require_once 'inc/funciones/CRUD.class.php';
require_once 'inc/templates/header.php';

if (isset($_GET['cerrar_sesion'])) {
    $_SESSION = [];
    session_destroy();
}

?>

<div class="contenedor-formulario">
    <h1>BOOKMARK</h1>


    <form action="#" id="formulario" class="caja-login" method="post">
        <div class="campo fontuser">
            <label for="usuario"> <i class="fa fa-user"></i> </label>

            <input type="text" name="usuario" id="usuario" placeholder="Usuario">
        </div>
        <div class="campo fontuser">

            <label  for="password"> <i class="fa fa-lock"></i> </label>
                <input type="password" name="password" id="password" placeholder="Password">

        </div>
        <div class="campo enviar">

            <input type="hidden" id="tipo" value="login">
            <button type="submit" class="boton">Iniciar Sesión
            <i class="fa fa-arrow-right"></i>
        </button>

            <!-- <input type="submit" class="boton" value="Iniciar Sesión"> -->
        </div>

        <div class="campo">
            <a href="crear-cuenta.php">Crea una cuenta nueva</a>
        </div>
    </form>
</div>

<?php require_once 'inc/templates/footer.php' ?>
