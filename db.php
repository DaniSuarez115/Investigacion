<?php
class db {	
	private $host;
    private $db;
    private $user;
    private $password;
    private $charset;

	
	function __construct(){
		$this->host     = 'sql863.main-hosting.eu';
        $this->db       = 'u484426513_mvc';
        $this->user     = 'u484426513_mvc';
        $this->password = "#7cYr646u@*Rp.P";
        $this->charset  = 'utf8mb4';
	}

	function connect(){
    
        try{
            
            $connection = "mysql:host=".$this->host.";dbname=" . $this->db . ";charset=" . $this->charset;
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];
            //$pdo = new PDO($connection, $this->user, $this->password, $options);
            $pdo = new PDO($connection,$this->user,$this->password);
        
            return $pdo;


        }catch(PDOException $e){
            print_r('Error connection: ' . $e->getMessage());
        }
    }
}

?>