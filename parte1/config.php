<?php

class Config
{
    static private $instance = null;
    public $conn;
    protected $serverName;
    protected $user;
    protected $password;

    public function __construct(
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
        $conn = sqlsrv_connect($this->serverName, $connectionInfo);

        if ($conn) {
            //     $query = "INSERT INTO TB_USUARIO(name, last_name, address, city)
            // 				VALUES ('ADRIANA PAOLA', 'CUJAR ALARCON', 'Calle 81 N° 102 - 60 Calle 82 No. 102 - 79', 'Aruba'),
            // 				('ADRIANA GIRALDO', 'GOMEZ', 'Calle 76 Sur No. 18 B 82 La Estrella', 'Afghanistan'),
            // 				('ADRIANA MARCELA', 'SALCEDO SEGURA','Carrera 7 B bis A #148-1', 'Angola'),
            // 				('ALEXANDER  DUARTE', 'SANDOVAL', 'Calle 65 No 80 - 51 Sur Piso 2 Bosa Centro', 'Anguilla'),
            // 				('ALCIRA SANTANILLA', 'CARVAJAL', 'Dirección Sede: Calle 44C No. 55- 51Barrio ', 'Albania'),
            // 				('AMPARO MONTOYA', 'MONTOYA', 'Dirección de Cabecera: Calle 45 No. 46-21 ', 'Andorra'),
            // 				('ANA MARIA', 'LOZANO SANTOS', 'Parroquia Cristo Crudificado Barrio La ', 'Netherlands'),
            // 				('ANDREA ARIZA', 'ZAMBRANO', 'Carrera 53 A No. 7-08', 'United'),
            // 				('ANDREA CAROLINA', 'ACUÑA MENDOZA', 'Transversal 68 C No. 31-26 Sur Barrio Floralia', 'Argentina'),
            // 				('ANDREA DEL', 'PILAR CORTES BARRETO', 'Calle 144 No. 45 - 16Carrera 24C No. 53 – 47 ', 'Armenia'),
            // 				('ANDREA DEL', 'PILAR GUZMAN ROJAS', 'Calle 41Sur No. 26- 73 Barrio Ingles', 'American'),
            // 				('ANDREA PAOLA', 'GUTIERREZ ROMERO', 'Calle 78 Sur No,. 0 - 40 Int.2 Barrio ', 'Antarctica'),
            // 				('ANDREA LILIANA', 'SAMPER MARTINEZ', 'Marichuela', 'French'),
            // 				('ANDREA MARCELA', 'BARRAGAN GARCIA', 'Calle 64 No. 120 - 42 Oficina 201', 'Antigua'),
            // 				('ANDREA YOHANNA', 'PINZON YEPES', 'Diagonal 23 No. 28 – 20 / Calle 22C - 28- 10 ', 'Australia'),
            // 				('AMELIA PEREZ', 'TABARES', 'Calle 18 No. 109 - 48', 'Austria'),
            // 				('ALEJANDRA MARIA', 'AGUDELO SUAREZ', 'Carrera 96 A No 73 - 02', 'Azerbaijan'),
            // 				('ALVARO CALDERON', 'ARTUNDUAGA', 'Calle 41 A Sur No. 1-09/0 -32 Este ', 'Burundi'),
            // 				('AYDA CATALINA', 'PULIDO CHAPARRO', 'Carrera 29 No. 66 – 03 Sur ', 'Belgium'),
            // 				('BERTHA XIMENA', 'PATRICIA BARBOSA TORRES', 'Carrera 79 F No. 46 – 16 Sur Casablanca 32', 'Benin'),
            // 				('BETSABE BAUTISTA', 'VARGAS', 'Carrera 85B N° 46 – 16 sur Casablanca 32 Local', 'Burkina'),
            // 				('CAMILO ALEXANDER', 'BOLIVAR FORERO', 'Calle 63 sur No. 71 B 19 Barrio Perdomo', 'Bangladesh'),
            // 				('CAROLINA ISAZA', 'RAMIREZ' , 'Calle 54 Sur No. 15- 07', 'Bulgaria'),
            // 				('CESAR AUGUSTO', 'RAMIREZ LAVERDE', 'Calle 33 Sur No.86-19', 'Bahrain'),
            // 				('CELMIRA PATRICIA', 'ARROYAVE CORREDOR', 'Carrera 13 a No.31-17 Ap 806', 'Bahamas'),
            // 				('CLAUDIA MARCELA', 'NAVARRETE CORTES', 'Carrera 11 A No. 29-22 Sur Salón Comunal', 'Bosnia'),
            // 				('CLAUDIA MARCELAS', 'LOZADA ARAGON', 'Avenida Caracas No. 3-17', 'Belarus'),
            // 				('CLAUDIA PATRICIA', 'BOLIVAR CARREÑO', 'Carrera 77x No. 51A - 88 Sur', 'Belize'),
            // 				('CLAUDIA PATRICIA', 'GALLO CIFUENTES', 'Carrera 90Bis N° 75 - 77 ', 'Bermuda'),
            // 				('CLAUDIA PILAR', 'VANEGAS ORTIZ', 'Carrera 40 C No. 56-26', 'Bolivia');";

            // $registro = sqlsrv_query($conn, $query);
        } else {
            echo "Conexión no se pudo establecer.";
            die(print_r(sqlsrv_errors(), true));
            exit;
        }

        return $conn;
    }

}

?>