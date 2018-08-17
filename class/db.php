<?php

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'electricity_sales_reporting');

class Database{
	
	public $conn;
	
		function __construct(){
			$this->openConn();
		}
	
	public function openConn(){
	
	// $this->conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		
	$this->conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		
		if(mysqli_connect_error()){
			die("database connection failed" . mysqli_error());
		}
	
	}
	
	public function query($sql){
		
		$result = $this->conn->query($sql);
			if(!$result){
				die("Query Failed" . $this->conn->error);
			}
		
		$this->confirmQuery($result);
		
		return $result;
	
	}
	
	private function confirmQuery($result){
		
		if(!$result){
			die("Query Failed" . $this->conn->error);
		}
	}
	
	public function escapeString($string){
		
		$escapedString = mysqli_real_escape_string($this->conn, $string);
		return $escapedString;
		
	}
	
	public function theInsertId() {

		return mysqli_insert_id($this->conn);
		return $result;

	}
	

}

$db = new Database();
?>