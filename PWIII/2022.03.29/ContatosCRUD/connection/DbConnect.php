<?php

define('DB_HOST', 'localhost');
define('DB_USER', 'etecia');
define('DB_PASS', '123456');
define('DB_NAME', 'dbContatos');

class DbConnect {


private $con;
		function connect()
		{
		
			
			$this->con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	 
		
			if (mysqli_connect_errno()) {
				echo "Falha de conexão com o MySQL: " . mysqli_connect_error();
			}
	 
			 
			return $this->con;
		}
}
?>