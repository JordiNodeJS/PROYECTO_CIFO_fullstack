<?php
$id_proyecto = $_POST['id']; // ID de la proyecto a destruir
$type = $_POST['type'];

if ($type == 'delete') {
    include '../funciones/Conexion.class.php';

    $pdo = new Conexion();
    $stmt = $pdo->prepare('DELETE FROM tareas WHERE id_proyecto = :id_proyecto');
    // $stmt->execute([':id_proyecto' => $id_proyecto]);

    // print_r($stmt->execute([':id_proyecto' => $id_proyecto]));

    if ($stmt->execute([':id_proyecto' => $id_proyecto]) > 0) {
        $stmt = $pdo->prepare('DELETE FROM proyectos WHERE id = :id_proyecto');
        ($stmt->execute([':id_proyecto' => $id_proyecto]))?
            $respuesta = ['response' => 'right']:
            $respuesta = ['response' => 'ERROR! Algo ha salido mal de veras'];


    } else{
        $respuesta = ['response' => 'ERROR!!'];

    }


    $pdo = null;

    echo json_encode($respuesta);
}
