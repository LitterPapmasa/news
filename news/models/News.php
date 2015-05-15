<?php

require_once __DIR__."/../functions/Db.php";

class News
{
    public function view()
    {
        $db = new Db();
        return $db->queryView('SELECT * FROM tb_articles');
        unset($db);
    }

    public function insert($posts)
    {
        $db = new Db();
        //make qoutes in post array for sql query
//         $countPostVars = 0;
//         foreach ($array as $value){
//             ++$countPostVars;
//             $qoutedArray[] = "'".$value."'";
//         }
//         if ($countPostVars !== 3) return false;
        //convert array to string (for sql query)
//         $values = implode(", ",$qoutedArray);
        if (empty($posts['header']) or empty($posts['text']) or empty($posts['date'])){
            unset($db);
            return false;
        }
        $values = "'" . $posts['header'] . "', '" . $posts['text'] . "', '" . $posts['date']. "'";

        $sql = "INSERT INTO tb_articles VALUES(NULL, ".$values.")";
        $result = $db->query($sql);
        unset($db);
        return (bool)$result;
    }


}