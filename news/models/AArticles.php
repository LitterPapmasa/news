<?php

abstract class AArticles
{
    //Default base set (table can be set in child class).
    protected static $table = 'test';
    
    protected static $lastId = 0;
    
    public static function getTable()
    {
    	return static::$table;
    }
    
    public static function getLastId()
    {
    	if (static::$lastId != false) {
    		return static::$lastId;
    	} else {
    		$db = new Db();
    		// For queryView
    		$db->className(get_called_class());
    		static::$lastId = $db->getLastId(static::$table);
    		return static::$lastId;
    	}
    }
    // ** CRUD start ===========================================
    
    public static function view()
    {
    	$db = new Db();    	
    	$db->className(get_called_class());
    	$res = $db->queryView('SELECT * FROM ' . static::$table);
    	return $res;
    }
    
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
    
    	$sql = "INSERT INTO ".static::$table." ";
    	$sql.= "(" . $vars . ") ";
    	$sql.= "VALUES (" . $varNames . ")";
    
    	$result = $db->query($sql, $valsArray);
    	static::$lastId = $db->dbh->lastInsertId();
    	 
    	unset($db);
    	return (bool) $result;
    }
    
    public function update($posts)
    {
    
    	$db = new Db();
    	if (empty($posts['header']) or empty($posts['text'])
    			or empty($posts['date']) or empty($posts['id'])) {
    				unset($db);
    				return false;
    			}
    
    	
    	$valsArray = [];
    	$setValues = [];
    	foreach ($posts as $key=>$value){
    		$valsArray[':'.$key] = $value;
    		if  ($key == 'id') {
    			continue;
    		}
    		$setValues[$key] = $key."=:".$key;
    	}    	
    	
    	// names like ":header, :text, ..."
    	$varNames = implode(', ', array_keys($valsArray));
    	$sql = "UPDATE ".static::$table." ";
    	$sql.= "SET " . implode(', ', $setValues) . " WHERE id=:id";
    	
    	$result = $db->query($sql, $valsArray);
    	static::$lastId = $db->dbh->lastInsertId();
    	 
    	unset($db);
    	return (bool) $result;
    
    }
    
    public function delete()
    {
    	$db = new Db();
    	    	 
    	$sql = "DELETE FROM ".static::$table." ";
		$sql.= "WHERE id=:id";

		$result = $db->query($sql, [':id' => self::getLastId(static::$table)]);
		unset($db);
		return (bool) $result;
    
    }
    // ** CRUD end =====================================
    
    
    public static function findByColumn($column, $value)
    {
    	
    	$db = new Db();
    	$db->className(get_called_class());
    	
    	$sql="SELECT * FROM " . static::$table . " WHERE ";
    	$sql.= $column . " LIKE :" . $column;
    	    
    	$res = $db->queryView($sql,[$column => "%".$value."%"]);
    	return $res;
    }
}