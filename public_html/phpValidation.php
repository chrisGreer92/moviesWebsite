<?php
/*Fixes the string to remove odd characters*/
function fix_string($str){
	return htmlentities($str);
}

/*Checks we have search criteria*/
function validate_criteria($string_check){
	if(strlen($string_check) < 1){
		return "No Search Criteria Entered<BR>";
	}
}

/*Checks the required strings are filled*/
function validate_creation($string_check,$table,$type){
	if(strlen($string_check) < 1){
		return "$table Requires a $type <BR>";
		/*Returns error based on parameters for re-usability*/
	}
}

/*Checks currency is an integer or 1/2 decimal float*/
function check_currency($price){
	if($price){
		if(!preg_match('/^-?[0-9]+(?:\.[0-9]{1,2})?$/', $price)){
			return "Invalid Price Format<BR>";
		}
	}
}

/*Checks year is valid, (1888 was year of first moving picture)*/
/*Currently only accepts existing movies rather than future ones*/
function check_year($year){
	if($year){
		$current_year = date("Y");
		if($year < 1888 || $year > $current_year ){
			return "Invalid Year";
		}
	}
}

?>