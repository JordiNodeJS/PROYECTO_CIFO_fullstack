<?php

// vamos a permitir a los usuarios loguearse y gracias a las sesiones
// es que vamos a restringir
// que únicamente los que sean logueado correctamente
// con un usuario y un password válido puedan ver el
// contenido
function usuario_autenticado() {
    if (!revisar_usuario()){
        header('Location:login.php');
        exit();
    }
}
function revisar_usuario() {
    return isset($_SESSION['nombre']);
}

session_start();

usuario_autenticado();

?>
