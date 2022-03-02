<?php
$id = $_POST['id']; // ID de la tarea
$type = $_POST['type'];




if ($type == 'delete') {

    // // // CREANDO LA CONEXION
    include '../funciones/conexion.php';

    try {
        // la consulta de usuarios
        $stmt = $conn->prepare("DELETE FROM tareas WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $respuesta = [
                'response' => 'right',
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
