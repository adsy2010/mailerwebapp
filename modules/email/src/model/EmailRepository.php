<?php
/**
 * Created by PhpStorm.
 * User: awt
 * Date: 06/12/2017
 * Time: 11:40 AM
 */

class EmailRepository implements EmailRepositoryInterface
{
    private $db;

    public function __construct(PDOHandler $db)
    {
        $this->db = $db;
    }

    public function getEmail($id)
    {
        // TODO: Implement getEmail() method.
        $sql = "SELECT * FROM emails WHERE id = ?";
        $result = $this->db->runQuery($sql, array($id));
    }

    public function getEmailsByUser($user)
    {
        // TODO: Implement getEmailsByUser() method.
        $sql = "SELECT * FROM emails WHERE user = ?";
        $result = $this->db->runQuery($sql, array($user));
    }

    public function getAllEmails()
    {
        // TODO: Implement getAllEmails() method.
        $sql = "SELECT * FROM emails";
        $result = $this->db->runQuery($sql, array());
    }
}