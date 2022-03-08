<?php

$tarea = $_POST['tarea'];
$accion =  $_POST['type_action'];
$id_proyecto = (int) $_POST['id_proyecto'];
// echo json_encode($_POST);




if ($accion == 'crear') {

    include '../funciones/Conexion.class.php';
    $pdo = new Conexion();
    $stmt = $pdo->prepare("INSERT  INTO tareas(nombre, id_proyecto) VALUES (:tarea, :id_proyecto)");

    $stmt->execute([
        ":tarea" => $tarea,
        ":id_proyecto" => $id_proyecto
    ]);
    // $number_of_rows = $stmt->fetchColumn();
    // echo $stmt->fetchColumn();
    if ($stmt->rowCount()){
    // if ($number_of_rows){
                $respuesta = [
                    'response' => 'right',
                    // 'id_inserted' => $number_of_rows,
                    'id_inserted' => $stmt->rowCount(),
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
