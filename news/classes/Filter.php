<?php
abstract class Filter
{
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
}