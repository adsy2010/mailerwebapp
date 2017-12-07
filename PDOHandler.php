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
        parent::__construct('mysql:host=localhost;dbname=ncs_mailer;charset=utf8', "root", "root");
    }

    public function runQuery($query, $data = array())
    {
        try {
            $stmt = $this->prepare($query);
            if (sizeof($data) > 0) $stmt->execute($data);
            else $stmt->execute();
        }
        catch(Exception $ex)
        {
            return $ex;
        }
        return $stmt->fetchAll();
    }

    public function getLastId()
    {
        return $this->lastInsertId();
    }
}

$db = new PDOHandler();