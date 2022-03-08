<?php

$tarea = $_POST['tarea'];
$accion =  $_POST['type_action'];
$id_proyecto = (int) $_POST['id_proyecto'];



if ($accion == 'crear') {

    include '../funciones/Conexion.class.php';
    $pdo = new Conexion();
    $stmt = $pdo->prepare("INSERT  INTO tareas(nombre, id_proyecto) VALUES (:tarea, :id_proyecto)");

    $stmt->execute([
        ":tarea" => $tarea,
        ":id_proyecto" => $id_proyecto
    ]);

    if (true) {

        $respuesta = [
            'response' => 'right',
            'id_inserted' =>  $pdo->lastInsertId(),
            'type_action' => $accion,
            'tarea' => $tarea
        ];
    } else {
        $respuesta = [
            'respuesta' => 'ERROR!!'
        ];
    }

    $pdo = null;

    echo json_encode($respuesta);
}
