<?php

class News extends AArticles
{
    public $id, $header, $text, $date;
    
    protected $lastId;
    
    protected static $table = 'tb_articles';

    
    // public function view() in AArticles

    public function insert($posts)
    {
        $db = new Db();
        if (empty($posts['header']) or empty($posts['text']) or empty($posts['date'])) {
            unset($db);
            return false;
        }
        
        $vars = implode(', ', array_keys($posts));
        $valsArray = []; 
        foreach ($posts as $key=>$value){
        	$valsArray[':'.$key] = $value;        	
        }
        // names like ":header, :text, ..."
        $varNames = implode(', ', array_keys($valsArray));
        
        $sql = "INSERT INTO ".self::$table." ";
        $sql.= "(" . $vars . ") ";
        $sql.= "VALUES (" . $varNames . ")";
        
        $result = $db->query($sql, $valsArray);       
        $this->lastId = $db->dbh->lastInsertId();
       
        unset($db);
        return (bool) $result;        
    }
    
    public function update($posts)
    {
//     	$posts['id'] = "1";
//     	$posts['header'] = "First ID";
//     	$posts['text'] = "My TEXT";
//     	$posts['date'] = date("Y-m-d H:i:s");
    
    
        $db = new Db();
        if (empty($posts['header']) or empty($posts['text']) 
        		or empty($posts['date']) or empty($posts['id'])) {
            unset($db);
            return false;
        }
        
        $vars = implode(', ', array_keys($posts));
        $valsArray = []; 
        foreach ($posts as $key=>$value){
        	$valsArray[':'.$key] = $value;        	
        }
        // names like ":header, :text, ..."
        $varNames = implode(', ', array_keys($valsArray));
        
        $sql = "UPDATE ".self::$table." ";
        $sql.= "SET header=:header, text=:text, date=:date WHERE id=:id";      
        
        $result = $db->query($sql, $valsArray);       
        $this->lastId = $db->dbh->lastInsertId();
       
        unset($db);
        return (bool) $result;        

    }

    
    public function getLastId()
    {
    	if ($this->lastId !== false) {
    		return $this->lastId;
    	} else {
    	
    	}
    }
}