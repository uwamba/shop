<?php
require '../vendor/autoload.php';

use Dotenv\Dotenv;
Class Database{
	private $pdo;
    private $server;
    private $username;
    private $password;
	private $options  = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,);
	protected $conn;
	public function __construct()
    {
        // Load the .env file
        $dotenv = Dotenv::createImmutable('../');
        $dotenv->load();

        // Retrieve environment variables
        $dbHost = $_ENV['DB_HOST'];
        $dbName = $_ENV['DB_NAME'];
        $dbUser = $_ENV['DB_USER'];
        $dbPassword = $_ENV['DB_PASSWORD'];

        // Set user and password
        $this->username = $dbUser;
        $this->password = $dbPassword;

        // Dynamically generate DSN inside the constructor (allowed)
        $this->server = 'mysql:host=' . $dbHost . ';dbname=' . $dbName . ';charset=utf8mb4';
    }

	public function open(){
 		try{
 			$this->conn = new PDO($this->server, $this->username, $this->password, $this->options);
 			return $this->conn;
 		}
 		catch (PDOException $e){
 			echo "There is some problem in connection: " . $e->getMessage();
 		}
 
    }
 
	public function close(){
   		$this->conn = null;
 	}
 
}

$pdo = new Database();
 
?>