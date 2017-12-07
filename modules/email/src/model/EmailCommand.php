<?php
/**
 * Created by PhpStorm.
 * User: awt
 * Date: 06/12/2017
 * Time: 11:40 AM
 */

namespace email\Model;

class EmailCommand implements EmailCommandInterface
{
    private $db;

    public function __construct(PDOHandler $db)
    {
        $this->db = $db;
    }

    public function insertEmail(Email $email)
    {
        // TODO: Implement insertEmail() method.
        $sql = "INSERT INTO emails (user, time, sendto, subject, content) VALUES(?,?,?,?,?)";
        $result = $this->db->runQuery($sql, array(
            $email->getUser(),
            $email->getTime(),
            $email->getSendto(),
            $email->getSubject(),
            $email->getContent()
        ));
    }

    public function updateEmail(Email $email)
    {
        // TODO: Implement updateEmail() method.
        $sql = "UPDATE emails SET user = ?, time = ?, sendto = ?, subject = ?, content = ? WHERE id= ?";
        $result = $this->db->runQuery($sql, array(
            $email->getUser(),
            $email->getTime(),
            $email->getSendto(),
            $email->getSubject(),
            $email->getContent(),
            $email->getId()
        ));
    }

    public function deleteEmail(Email $email)
    {
        // TODO: Implement deleteEmail() method.
        $sql = "DELETE FROM emails WHERE id=?";
        $result = $this->db->runQuery($sql, array(
            $email->getId()
        ));
    }
}