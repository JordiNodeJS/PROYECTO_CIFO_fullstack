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



// // ---- código antiguo -----------
// if ($accion == 'crear') {
//     // código para crear los administradores

//     // hashear passwords
//     $options = ['cost' => 10];
//     $hashed_password = password_hash($password, PASSWORD_BCRYPT, $options);

//     // debugging
//     // $respuesta = ['pass_hash' => $hash_password];
//     // die(json_encode($respuesta));

//     // // // importar la conexión
//     include '../funciones/conexion.php';

//     try {
//         // la consulta de usuarios
//         $stmt = $conn->prepare("INSERT INTO usuarios(usuario, password) VALUES (?,?)");
//         $stmt->bind_param("ss", $usuario, $hashed_password);
//         $stmt->execute();

//         if ($stmt->affected_rows > 0) {
//             $respuesta = [
//                 'response' => 'right',
//                 'insert_id' => $stmt->insert_id,
//                 'type_action' => $accion
//             ];
//         } else {
//             $respuesta = [
//                 'response' => 'error'
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

// if ($accion == 'login') {
//     include '../funciones/conexion.php';
//     try {
//         // seleccionamos el administrador de la base de datos.
//         $stmt = $conn->prepare("SELECT usuario, id, password FROM usuarios WHERE usuario = ?");
//         $stmt->bind_param("s", $usuario);
//         $stmt->execute();

//         $stmt->bind_result($nombre_usuario, $id_usuario, $pass_usuario);
//         $stmt->fetch();
//             if ($nombre_usuario) {
//                 // Ahora que el usuario existe, verificamos la contraseña
//                 if (password_verify($password, $pass_usuario)) {
//                     // Iniciamo la sesión
//                     session_start();
//                     $_SESSION = [
//                         'nombre' => $usuario,
//                         'id' => $id_usuario,
//                         'login' => true
//                     ];

//                     // respuesta al login correcto
//                     $respuesta = [
//                         'response' => 'right',
//                         'nombre' => $nombre_usuario,
//                         'id' => $id_usuario,
//                         'type_action' => $accion,
//                         'password' => $pass_usuario,
//                         'columnas' => $stmt->affected_rows

//                     ];
//                 } else {
//                     $respuesta = ['resultado' => 'Contraseña fallida!!!'];
//                 }
//             } else {
//             $respuesta = [
//                 'error' => 'Ese usuario como que va a ser que no existe'
//             ];
//             }


//         $stmt->close();
//         $conn->close();
//     } catch (Exception $e) {
//         // en caso de que la conexión falle la cazamos y la mostramos
//         $respuesta = ['Exception message: ' => $e->getMessage()];
//     }
//     echo json_encode($respuesta);
// }
