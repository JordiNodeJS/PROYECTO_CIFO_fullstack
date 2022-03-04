<?php

class Conexion extends PDO
{
    private $typedb = "mysql";
    private $host = "localhost";
    private $dbname = "bookmarks";
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
