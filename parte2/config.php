<?php

class Config
{
    static private $instance = null;
    public $conn;
    protected $serverName;
    protected $user;
    protected $password;

    private function __construct(
        $serverName,
        $user,
        $password
    ) {
        $this->serverName = $serverName;
        $this->user = $user;
        $this->password = $password;
        $this->conn = $this->establishConnection();
    }

    public function establishConnection()
    {
        $connectionInfo = array("Database" => "DB_ERICTEL", "UID" => $this->user, "PWD" => $this->password);
        $this->conn = sqlsrv_connect($this->serverName, $connectionInfo);

        if (!$this->conn) {

            echo "Conexión no se pudo establecer.";
            die(print_r(sqlsrv_errors(), true));
            exit;
        }

        return $this->conn;
    }

    public static function config(
        $serverName,
        $user,
        $password
    ) {
        if (self::$instance == null) {
            self::$instance = new Config(
                $serverName,
                $user,
                $password
            );
        } else {
            return self::$instance;
        }
    }

    public function getConnection()
    {
        return $this->conn;
    }
}

?>