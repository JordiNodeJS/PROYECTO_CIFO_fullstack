<?php
// header("Content-type: application/json; charset=utf-8");
// error_reporting(0);
$usuario = $_POST['usuario'];
$password = $_POST['password'];
$accion = $_POST['accion'];

if ($accion == 'crear'){
    include '../funciones/Conexion.class.php';
    $pdo = new Conexion();

    $stmt = $pdo->prepare('SELECT usuario FROM usuarios WHERE usuario = :usuario');
    $stmt->execute([':usuario' => $usuario]);

    if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        if ($row['usuario'] == $usuario) {
        $respuesta = [
            'response' => 'El susodicho ya exite!!!'
        ];
        echo json_encode($respuesta);
    }
    }else {
        $options = ['cost' => 10];
        $hashed_password = password_hash($password, PASSWORD_BCRYPT, $options);

        $stmt = $pdo->prepare('INSERT INTO usuarios(usuario, password) VALUES (:usuario, :password)');
        $stmt->execute([
            ':usuario' => $usuario,
            ':password' => $hashed_password
        ]);
        ($stmt->rowCount() > 0)?
        $respuesta = [
            'response' => 'right',
            'insert_id' => $pdo->lastInsertId(),
            'type_action' => $accion
            ]:  $respuesta = ['response' => 'ERROR!!'];
        echo json_encode($respuesta);

    }


    $pdo = null;



}

if ($accion == 'login'){
    include '../funciones/Conexion.class.php';
    $pdo = new Conexion();

    $stmt = $pdo->prepare('SELECT usuario, id, password FROM usuarios WHERE usuario = :usuario');
    $stmt->execute([':usuario' => $usuario]);

    if ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

        $nombre_usuario = $row["usuario"];
        $id_usuario = $row["id"];
        $pass_usuario = $row["password"];

        if  (password_verify($password, $pass_usuario))  {
            session_start();
            $_SESSION = [
                'nombre' => $usuario,
                'id' => $id_usuario,
                'login' => true
            ];
                // respuesta al login correcto
                $respuesta = [
                    'response' => 'right',
                    'nombre' => $nombre_usuario,
                    'id' => $id_usuario,
                    'type_action' => $accion,
                    'password' => $pass_usuario,
                    'columnas' => $pdo->lastInsertId()
                ];
        } else {
                    $respuesta = ['resultado' => 'Contraseña fallida!!!'];
        }

    }   else {
        $respuesta = [
            'response' => 'Ese usuario como que va a ser que no existe'
        ];
    }

    $pdo = null;

    echo json_encode($respuesta);
}
