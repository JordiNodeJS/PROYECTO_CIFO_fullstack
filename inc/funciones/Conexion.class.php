<?php

// $conn = new mysqli('localhost', 'root', '', 'bookmarks');
// // $conn = new mysqli('fdb32.awardspace.net', '4055208_database', 'aQa43Dg_gyu-d24Agqas', '4055208_database');

// if($conn->connect_error) echo "Hay un error en la conexión a la base de datos: " . $conn->connect_error ;

// $conn->set_charset('utf8');

// _______________________________________________

class Conexion extends PDO
{
    // private $typedb = "mysql";
    // private $host = "sql108.epizy.com";
    // private $dbname = "epiz_28011271_cifo";
    // private $user = "epiz_28011271";
    // private $pw = "K79bSYFYk071VQ";

    private $typedb = "mysql";
    private $host = "sql308.byethost7.com";
    private $dbname = "b7_30615793_cifo";
    private $user = "b7_30615793";
    private $pw = "6nyq7953";

    // MySQL Host Name: sql308.byethost7.com
    // MySQL Password:  6nyq7953
    // MySQL UserName:  b7_30615793



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
            echo "ERROR DE conexión -->" .  $e->getMessage();
            exit;
        }
    }
}
