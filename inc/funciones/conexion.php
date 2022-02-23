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

if($conn->connect_error) echo $conn->connect_error;

$conn->set_charset('utf8');
