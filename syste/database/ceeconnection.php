<?php


 
class db{
	public static $conn;
	function __construction(){
	
		
		}
	 static function createion(){
		$varaibv = db_config::constant_variable();
		$conn = new mysqli($varaibv['hostname'],$varaibv['username'],$varaibv['password'],$varaibv['database']);
        if ($conn->connect_error) {
        exit("Connection failed: " . $conn->connect_error);
         } 
		 return $conn;
		 }
	 static function connection(){
		 return db::$conn;
		
		}
	
	
	
	
	}















?>