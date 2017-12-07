<?php
/**
 * Created by PhpStorm.
 * User: awt
 * Date: 06/12/2017
 * Time: 11:07 AM
 */

namespace user\Model;

interface UserRepositoryInterface
{
    public function getUserByCredentials($username, $password);
    public function getUser($id);
    public function getAllUsers();
}