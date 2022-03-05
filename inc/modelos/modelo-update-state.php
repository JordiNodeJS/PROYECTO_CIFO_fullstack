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
    $respuesta = ['response' => 'ERROR A LA HORA DE ACTULAIZAR EL ESTADO DE LA TAREA'];

    $pdo = null;

    echo json_encode($respuesta);

}


// if ($type == 'update') {

//     // // // CREANDO LA CONEXION
//     include '../funciones/conexion.php';

//     try {
//         // la consulta de usuarios
//         $stmt = $conn->prepare("UPDATE tareas SET estado = ? WHERE id = ?");
//         $stmt->bind_param("ii", $state, $id);
//         $stmt->execute();

//         if ($stmt->affected_rows > 0) {
//             $respuesta = [
//                 'response' => 'right',
//             ];
//         } else {
//             $respuesta = [
//                 'respuesta' => 'ERROR!!'
//             ];
//         }

//         $stmt->close();
//         $conn->close();

//     } catch (Exception $e) {
//         // en caso de que la conexión falle la cazamos y la mostramos
//         $respuesta = ['Exception message: ' => $e->getMessage()];
//     }
//     echo json_encode($respuesta);
// }
