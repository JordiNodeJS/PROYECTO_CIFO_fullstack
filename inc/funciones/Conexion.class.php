<?php

// $conn = new mysqli('localhost', 'root', '', 'bookmarks');
// // $conn = new mysqli('fdb32.awardspace.net', '4055208_database', 'aQa43Dg_gyu-d24Agqas', '4055208_database');

// if($conn->connect_error) echo "Hay un error en la conexión a la base de datos: " . $conn->connect_error ;

// $conn->set_charset('utf8');

// _______________________________________________

class Conexion extends PDO
{
    private $typedb = "mysql";
    private $host = "localhost";
    private $dbname = "bookmark";
    private $user = "root";
    private $pw = "";

    public function __construct()
    {
        try {

            $options = [PDO::ATTR_EMULATE_PREPARES => false];
            parent::__construct(
                $this->typedb . ":host=" . $this->host . "; dbname=" . $this->dbname,
                $this->user,
                $this->pw,
                $options
            );

        } catch (PDOException $e) {
            echo "Error de conexión" .  $e->getMessage();
            exit;
        }
    }
}
