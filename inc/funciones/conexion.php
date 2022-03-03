<?php
// class Connection
// {
//     private $host;
//     private $db;
//     private $user;
//     private $password;

//     public function __construct()
//     {
//         $this->host = 'localhost';
//         $this->db = 'tasktron';
//         $this->user = 'root';
//         $this->password = '';
//     }

//     function connect()
//     {
//         try {
//             $connection = 'mysql:host=' . $this->host . ';dbname=' . $this->db;
//             $pdo = new PDO($connection, $this->user, $this->password);
//             return $pdo;
//         } catch (PDOException $e) {
//             print_r('Error connection' . $e->getMessage());
//         }
//     }
// }

$conn = new mysqli('localhost', 'root', '', 'bookmarks');
// $conn = new mysqli('fdb32.awardspace.net', '4055208_database', 'aQa43Dg_gyu-d24Agqas', '4055208_database');

// conexion final al proyecto
// $conn = new mysqli('sql108.epizy.com', 'epiz_28011271', 'K79bSYFYk071VQ', 'epiz_28011271_cifo');

if($conn->connect_error) echo "Hay un error en la conexión a la base de datos: " . $conn->connect_error ;

$conn->set_charset('utf8');
