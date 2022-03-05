<?php

class Conexion extends PDO
{
    private $typedb = "mysql";
    private $host = "localhost";
    private $dbname = "bookmarks";
    private $user = "root";
    private $pw = "";

    // private $typedb = "mysql";
    // private $host = "sql108.epizy.com";
    // private $dbname = "epiz_28011271_cifo";
    // private $user = "epiz_28011271";
    // private $pw = "K79bSYFYk071VQ";

    // private $typedb = "mysql";
    // private $host = "fdb32.awardspace.net";
    // private $dbname = "4055208_database";
    // private $user = "4055208_database";
    // private $pw = "aQa43Dg_gyu-d24Agqas";

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
