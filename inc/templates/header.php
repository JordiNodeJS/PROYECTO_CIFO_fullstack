<!DOCTYPE html>
<html lang="es">
<?php $actual = obtener_estilo_pagina_actual(); ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CIFO <?= $actual ?></title>
    <link rel="stylesheet" href="css/fontawesome-all.min.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,900" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">

    <link rel="stylesheet" href="css/sweetalert2.min.css">
    <script defer src="js/sweetalert2.all.min.js"></script>
    <?php
    $actual = obtener_estilo_pagina_actual();
    if ($actual === "crear-cuenta" || $actual === "login")
        echo '<script defer type="module" src="js/form.js"></script>';
        else echo '<script defer type="module" src="js/crud.js"></script>';
    ?>

</head>

<body class="<?= obtener_estilo_pagina_actual(); ?>">
