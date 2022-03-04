<?php

$accion = $_POST['accion'];
$proyecto = $_POST['proyecto'];


if ($accion == 'crear') {


    // // // CREANDO LA CONEXION
    include '../funciones/Conexion.class.php';
    $pdo = new Conexion();

        // la consulta de usuarios

        $stmt = $pdo->prepare('INSERT INTO proyectos(nombre) VALUES (:proyecto)');
        $stmt->execute([':proyecto'=> $proyecto]);

        // $stmt = $conn->prepare("INSERT INTO proyectos(nombre) VALUES (?)");
        // $stmt->bind_param("s", $proyecto);
        // $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $respuesta = [
                'response' => 'right',
                'id_proyecto' => $pdo->lastInsertId(),
                'type_action' => $accion,
                'nombre_proyecto' => $proyecto
            ];
        } else {
            $respuesta = [
                'respuesta' => 'ERROR!!'
            ];
        }


        $pdo = null;


    echo json_encode($respuesta);
}
