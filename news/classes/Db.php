<?php

class Db
{
    //Start) Open close connection 
    public $connection;

    function __construct($server = 'localhost', $login = 'root', $pass = '1', $db = 'articles')
    {
        $this->connection = mysql_connect($server, $login, $pass) 
                            or die('Could not connect: ' . mysql_error());
        
        mysql_selectdb($db, $this->connection);
        mysql_set_charset('utf8');
    }

    function __destruct()
    {
        mysql_close($this->connection);
    }
    //End) Open close connection 
    
    //Make query and return array into class or false
    public function queryView($sql, $class = "stdClass")
    {
        if ($res = mysql_query($sql, $this->connection)) {
            $ids = array();
            while ($row = mysql_fetch_object($res, $class)) {
                $ids[] = $row;
            }
            return $ids;
        } else {
            return false;
        }
    }
    
    //Make query execution only and return bool
    public function query($sql)
    {
        if ($res = mysql_query($sql, $this->connection)) {
            return true;
        } else {
            return false;
        }
    }
}