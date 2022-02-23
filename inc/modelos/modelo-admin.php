<?php
header("Content-type: application/json; charset=utf-8");
error_reporting(0);
$usuario = $_POST['usuario'];
$password = $_POST['password'];
$accion = $_POST['accion'];

if ($accion == 'crear') {
    // código para crear los administradores

    // hashear passwords
    $options = ['cost' => 10];
    $hashed_password = password_hash($password, PASSWORD_BCRYPT, $options);

    // debugging
    // $respuesta = ['pass_hash' => $hash_password];
    // die(json_encode($respuesta));

    // // // importar la conexión
    include '../funciones/conexion.php';

    try {
        // la consulta de usuarios
        $stmt = $conn->prepare("INSERT INTO usuarios(usuario, password) VALUES (?,?)");
        $stmt->bind_param("ss", $usuario, $hashed_password);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $respuesta = [
                'response' => 'right',
                'insert_id' => $stmt->insert_id,
                'type_action' => $accion
            ];
        }
        else {
            $respuesta = [
                'response' => 'error'
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
