<?php
abstract class Filter
{
    //light input filter
    public static function input($var, $type = "s")
    {
        switch ($type) {

            case "s":
                return htmlentities($var);
                break;
            case "i":
                return (int) $var;
            default:
                return "input filter undefined";
        }
    }
    
    public static function isNumericAdd($var)
    {
    	$var = (float)$var;
    	$test1 = explode(".", $var);
    	
    	if (isset($test1[1])) {
    		return false;
    	} else {
    		return true;
    	}
    }
}