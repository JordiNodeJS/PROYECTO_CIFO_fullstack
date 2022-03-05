<?php
$id = $_POST['id']; // ID de la tarea
$type = $_POST['type'];

if ($type == 'delete') {
    include '../funciones/Conexion.class.php';

    $pdeo = new Conexion();
    $stmt = $pdeo->prepare('DELETE FROM tareas WHERE id = :id');
    $stmt->execute([':id' => $id]);

    ($stmt->rowCount() > 0)?
    $respuesta = ['response' => 'right'] :
    $respuesta = ['response' => 'ERROR!!'];

    $pdeo = null;

    echo json_encode($respuesta);
}
