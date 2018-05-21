<?php
class Config 
{
	static private $instance = null;

	protected $serverName;
	protected $user;
	protected $password;
	public $conn;

	public function getConnection()
	{
		return $this->conn;
	}

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

	public static function config(
		$serverName,
		$user,
		$password
	) { 
       if( self::$instance == null ) { 
       	self::$instance = new Config(
       		$serverName,
			$user,
			$password
		); 
       } else { 
       	return self::$instance;  
       } 
   }

   public function establishConnection()
   {
		$connectionInfo = array( "Database"=>"DB_ERICTEL", "UID"=>$this->user, "PWD"=>$this->password);
		$this->conn = sqlsrv_connect($this->serverName, $connectionInfo);

		if(! $this->conn ) {
		
		     echo "Conexión no se pudo establecer.";
		     die( print_r( sqlsrv_errors(), true));
		     exit;
		}

		return $this->conn;
   }
}
?>