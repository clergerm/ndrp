<?php 
class DbConnect{
	// Define DB connection parameters.
	private const DB_SERVER = "localhost";
	private const DB_NAME = "ndrp";
	private const DB_USER = "root";
	private const DB_PWD = "";
	private static $pdo = null;

	// set PDO connection.
	public static function getConnection(){
		try { 
			self::$pdo = new PDO("mysql:host=".self::DB_SERVER.";dbname=".self::DB_NAME, self::DB_USER, self::DB_PWD); 
			// set the PDO error mode to exception 
			self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return self::$pdo;
		} catch(PDOException $e) { 
			echo "DB Connection failed: " . $e->getMessage(); 
			exit();
		}
	}
} ?>