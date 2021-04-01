<?php 
session_start();
class App {

	// Includes path to the main/root directory.
	public const FULL_DIR = "C:/xampp/htdocs/ndrp";

	// Includes URL path to the main/root folder.
	public const FULL_URL = "http://localhost/ndrp";

	// To hold message to be displayed.
	// Error key indicates an error message.
	// Success key indicates a successful message.
	// Failure key is set for a failure message.
	public static $msg = [];

	// Indicates what part of side bar that must be selected. 
	public static $aside = "";
} ?>