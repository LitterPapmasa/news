<?php

abstract class AArticles
{
    //Default base set (table can be set in child class).
    protected static $table = 'test';
    
    public static function view()
    {
        $db = new Db();
        return $db->queryView('SELECT * FROM '.static::$table, "News");
    }
    
}