<?php 
class Validate{
	
	// Check if an input is empty.
	public static function isEmpty ( $elem ) {
		if ( empty ( $elem ) ) 
			return true;
		else 
			return false;
	}

	// check if password has the correct length.
	public static function isCorrectLength ( $elem, $min ) {
		if ( strlen ( $elem ) < $min )
			return false;
		else 
			return true;
	}
} ?>