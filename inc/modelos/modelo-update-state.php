<?php
$id = $_POST['id'];
$type = $_POST['type'];
$state = (int) $_POST['state'];

if ($type == 'update'){
    include '../funciones/Conexion.class.php';

    $pdo = new Conexion();
    $stmt = $pdo->prepare('UPDATE tareas SET estado = :state WHERE id = :id');

    (    $stmt->execute([
        ':state' => $state,
        ':id' => $id])
    )?
    $respuesta = ['response' => 'right'] :
    $respuesta = ['response' => 'ERROR A LA HORA DE ACTUALIZAR EL ESTADO DE LA TAREA'];

    $pdo = null;

    echo json_encode($respuesta);

}
