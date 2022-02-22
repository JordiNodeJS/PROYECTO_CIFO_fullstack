<?php
class Connection
{
    private $host;
    private $db;
    private $user;
    private $password;

    public function __construct()
    {
        $this->host = 'localhost';
        $this->db = 'tasktron';
        $this->user = 'root';
        $this->password = '';
    }

    function connect()
    {
        try {
            $connection = 'mysql:host=' . $this->host . ';dbname=' . $this->db;
            $pdo = new PDO($connection, $this->user, $this->password);
            return $pdo;
        } catch (PDOException $e) {
            print_r('Error connection' . $e->getMessage());
        }
    }
}


$conn = new Connection();


echo "<pre>";
print_r($conn->connect());
echo "</pre>";


// $query = $conn->connect()->prepare('SELECT * FROM usuarios');
// $query->execute();
// $row = $query->fetch(PDO::FETCH_NUM);
