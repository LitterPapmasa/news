<?php

class News
{

    public $id, $header, $text, $date;

    public static function view()
    {
        $db = new Db();
        return $db->queryView('SELECT * FROM tb_articles', "News");
    }

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
        
        $sql = "INSERT INTO tb_articles VALUES(NULL, " . $values . ")";
        $result = $db->query($sql);
        unset($db);
        return (bool) $result;
    }
}