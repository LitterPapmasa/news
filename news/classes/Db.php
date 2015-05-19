<?php

class Db
{
    //Start) Open close connection 
    public $connection;

    function __construct($server = 'localhost', $login = 'root', $pass = '1', $db = 'articles')
    {
        $dsn= 'mysql:host='.$server.';dbname='.$db;
        $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');

        try {
            $this->connection = new PDO($dsn, $login, $pass, $options);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch ( PDOException $e) {
            // echo $e->getMessage();
            die('<br>Sorry, database connection problem.');
        }

    }

    function __destruct()
    {
        $this->connection = null;
    }
    //End) Open close connection 
    
    //Make query and return array into class or false
    public function queryView($sql, $class = "stdClass")
    {
        if ($res = $this->connection->query($sql)) {
            $items = [];
            while ($row = $res->fetchObject($class)) {
                $items[] = $row;
            }
            return $items;
        } else {
            return false;
        }
    }
    
    //Make query execution only and return bool
    public function query($sql)
    {
        if ($res = $this->connection->query($sql)) {
            return true;
        } else {
            return false;
        }
    }
}