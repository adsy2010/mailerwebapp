<?php
/**
 * Created by PhpStorm.
 * User: awt
 * Date: 06/12/2017
 * Time: 11:40 AM
 */

interface EmailCommandInterface
{
    public function insertEmail(Email $email);
    public function updateEmail(Email $email);
    public function deleteEmail(Email $email);
}