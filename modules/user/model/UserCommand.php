<?php
/**
 * Created by PhpStorm.
 * User: awt
 * Date: 06/12/2017
 * Time: 11:09 AM
 */

class UserCommand implements UserCommandInterface
{
    private $db;

    public function __construct(PDOHandler $db)
    {
        $this->db = $db;
    }

    public function insertUser(User $user)
    {
        // TODO: Implement insertUser() method.
        $sql = "INSERT INTO users (email, password, fullname, activationcode)";
        $result = $this->db->runQuery($sql,array(
            $user->getEmail(),
            $user->getPassword(),
            $user->getFullname(),
            $user->getActivationcode()
        ));
    }

    public function updateUser(User $user)
    {
        // TODO: Implement updateUser() method.
        $sql = "UPDATE users SET email = ?, password = ?, fullname = ?, active = ?, activationcode = ? WHERE id = ? ";
        $result = $this->db->runQuery($sql, array(
            $user->getEmail(),
            $user->getPassword(),
            $user->getFullname(),
            $user->getActive(),
            $user->getActivationcode(),
            $user->getId()
        ));
    }

    public function deleteUser(User $user)
    {
        // TODO: Implement deleteUser() method.
        $sql = "DELETE FROM users WHERE id = ? ";
        $this->db->runQuery($sql, array(
            $user->getId()
        ));
    }
}