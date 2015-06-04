<?php

class Db
{
    //Start) Open close dbh 
    public $dbh;
    
    private $className = 'StdClass';

    function __construct($server = 'localhost', $login = 'root', $pass = '1', $db = 'articles')
    {
        $dsn= 'mysql:host='.$server.';dbname='.$db;
        $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');

        try {
            $this->dbh = new PDO($dsn, $login, $pass, $options);
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch ( PDOException $e) {
            // echo $e->getMessage();
            die('<br>Sorry, database dbh problem.');
        }
    }

    function __destruct()
    {
        $this->dbh = null;
    }
    //End) Open close dbh 
    
    //Make query and return array into class or false
	public function queryView($sql, $params = [])    
    {
    	$sth = $this->dbh->prepare($sql);
    	$sth->execute($params);
    	return	$sth->fetchAll(PDO::FETCH_CLASS, $this->className);
    
    	
//         if ($res = $this->dbh->query($sql)) {
//             $items = [];
//             while ($row = $res->fetchObject($class)) {
//                 $items[] = $row;
//             }
//             return $items;
//         } else {
//             return false;
//         }
    }
    
    public function className($class)
    {
    	$this->className = $class;
    	
    }
    
    //Make query execution only and return bool
    public function query($sql)
    {
        if ($res = $this->dbh->query($sql)) {
            return true;
        } else {
            return false;
        }
    }
}