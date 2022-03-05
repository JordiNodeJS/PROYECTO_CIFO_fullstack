<?php

// vamos a permitir a los usuarios loguearse y gracias a las sesiones
// es que vamos a restringir
// que únicamente los que sean logueado correctamente
// con un usuario y un password válido puedan ver el
// contenido
// function usuario_autenticado() {
//     if (!isset($_SESSION['nombre'])){
//         header('Location:login.php');
//         exit();
//     }
// }

session_start();

if (!isset($_SESSION['nombre'])){
    header('Location:login.php');
    exit();
}
