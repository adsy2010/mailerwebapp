<?php
/**
 * Created by PhpStorm.
 * User: awt
 * Date: 06/12/2017
 * Time: 11:40 AM
 */

namespace email\Model;

interface EmailRepositoryInterface
{
    public function getEmail($id);
    public function getEmailsByUser($user);
    public function getAllEmails();
}