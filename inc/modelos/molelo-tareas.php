<?php

$tarea = $_POST['tarea'];
$accion =  $_POST['type_action'];
$id_proyecto = (int) $_POST['id_proyecto'];
// echo json_encode($_POST);

if ($accion == 'crear') {

    // // // CREANDO LA CONEXION
    include '../funciones/conexion.php';

    try {
        // la consulta de usuarios
        $stmt = $conn->prepare("INSERT INTO tareas(nombre, id_proyecto) VALUES (?, ?)");
        $stmt->bind_param("si", $tarea, $id_proyecto);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $respuesta = [
                'response' => 'right',
                'id_inserted' => $stmt->insert_id,
                'type_action' => $accion,
                'tarea' => $tarea
            ];
        } else {
            $respuesta = [
                'respuesta' => 'ERROR!!'
            ];
        }

        $stmt->close();
        $conn->close();

    } catch (Exception $e) {
        // en caso de que la conexión falle la cazamos y la mostramos
        $respuesta = ['Exception message: ' => $e->getMessage()];
    }
    echo json_encode($respuesta);
}
