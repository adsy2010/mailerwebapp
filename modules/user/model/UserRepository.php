<?php
/**
 * Created by PhpStorm.
 * User: awt
 * Date: 06/12/2017
 * Time: 11:09 AM
 */

namespace user\Model;

class UserRepository implements UserRepositoryInterface
{
    private $db;

    public function __construct(PDOHandler $db)
    {
        $this->db = $db;
    }

    public function getUserByCredentials($username, $password)
    {
        $sql = "SELECT * FROM users WHERE email = ? AND password = ?";
        $results = $this->db->runQuery($sql, array(
            $username,
            $password
        ));

        //return nothing if there are no results
        if(count($results) == 0) return array();

        $resultset = array();

        foreach ($results as $result) {
            $user = new User($result['id'], $result['email'], $result['password'], $result['fullname'], $result['active'], $result['activationcode']);
            $resultset[] = $user;
        }

        //ensure only one entry is returned
        return $resultset[0];
    }

    public function getUser($id)
    {
        // TODO: Implement getUser() method.
        $sql = "SELECT * FROM users WHERE id = ?";
        $results = $this->db->runQuery($sql, array($id));

        //return nothing if there are no results
        if(count($results) == 0) return array();

        $resultset = array();

        foreach ($results as $result) {
            $user = new User($result['id'], $result['email'], $result['password'], $result['fullname'], $result['active'], $result['activationcode']);
            $resultset[] = $user;
        }

        //ensure only one entry is returned
        return $resultset[0];
    }

    public function getAllUsers()
    {
        // TODO: Implement getAllUsers() method.
        $sql = "SELECT * FROM users";
        $results = $this->db->runQuery($sql, array());

        //return nothing if there are no results
        if(count($results) == 0) return array();

        $resultset = array();

        foreach ($results as $result) {
            $user = new User($result['id'], $result['email'], $result['password'], $result['fullname'], $result['active'], $result['activationcode']);
            $resultset[] = $user;
        }

        return $resultset;
    }
}