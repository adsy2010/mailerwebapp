<?php
/**
 * Created by PhpStorm.
 * User: awt
 * Date: 06/12/2017
 * Time: 11:06 AM
 */

namespace user\Model;

interface UserCommandInterface
{
    public function insertUser(User $user);
    public function updateUser(User $user);
    public function deleteUser(User $user);
}