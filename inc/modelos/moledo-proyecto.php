<?php

$accion = $_POST['accion'];
$proyecto = $_POST['proyecto'];

if ($accion == 'crear') {


    // // // CREANDO LA CONEXION
    include '../funciones/conexion.php';

    try {
        // la consulta de usuarios
        $stmt = $conn->prepare("INSERT INTO proyectos(nombre) VALUES (?)");
        $stmt->bind_param("s", $proyecto);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $respuesta = [
                'response' => 'right',
                'id_proyecto' => $stmt->insert_id,
                'type_action' => $accion,
                'nombre_proyecto' => $proyecto
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
