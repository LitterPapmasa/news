<?php

class News extends AArticles
{
    public $id, $header, $text, $date;
    
    protected static $table = 'tb_articles';

    // public function view() in AArticles

    public function insert($posts)
    {
        $db = new Db();
        if (empty($posts['header']) or empty($posts['text']) or empty($posts['date'])) {
            unset($db);
            return false;
        }
        $values = "'" . $posts['header'] . "'"; 
        $values .= ", '".$posts['text'] . "'";
        $values .= ", '" . $posts['date'] . "'";
        
        $sql = "INSERT INTO ".self::$table." ";
        $sql.= "VALUES(NULL, " . $values . ")";
        $result = $db->query($sql);
        unset($db);
        return (bool) $result;        
    }
}