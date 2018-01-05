<?php
/**
 * Created by PhpStorm.
 * User: awt
 * Date: 06/12/2017
 * Time: 12:29 PM
 */

class PDOHandler extends PDO
{
    public function __construct()
    {
        parent::__construct('mysql:host=localhost;dbname=mailer;charset=utf8', "root", "root");
    }

    public function runQuery($query, $data = array())
    {
        try {
            if(!($stmt = $this->prepare($query)))
                throw new Exception("Prepared query failed!");
            if (sizeof($data) > 0) $result = $stmt->execute($data);
            else $result = $stmt->execute();
        }
        catch(Exception $ex)
        {
            return $ex;
        }
        //return results or true/false
        $allRows =  $stmt->fetchAll();
        if(count($allRows) > 0) return $allRows;
        else return $result;
    }

    public function getLastId()
    {
        return $this->lastInsertId();
    }
}

$db = new PDOHandler();