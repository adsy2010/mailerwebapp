<?php
/**
 * Created by PhpStorm.
 * User: awt
 * Date: 06/12/2017
 * Time: 10:57 AM
 */

class User
{
    private $id, $email, $password, $fullname, $active, $activationcode;

    public function __construct($id, $email, $password, $fullname, $active, $activationcode)
    {
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
        $this->fullname = $fullname;
        $this->active = $active;
        $this->activationcode = $activationcode;
    }

    private function encrypt($password)
    {
        return hash("SHA256", $password . "NCS");
    }

    public function authenticate($username, $password)
    {
        if($username == $this->getEmail() && $this->encrypt($password) == $this->getPassword()) return $this->getId();
        return null;
    }

    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getFullname()
    {
        return $this->fullname;
    }

    /**
     * @param mixed $fullname
     */
    public function setFullname($fullname)
    {
        $this->fullname = $fullname;
    }

    /**
     * @return mixed
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * @param mixed $active
     */
    public function setActive($active)
    {
        $this->active = $active;
    }

    /**
     * @return mixed
     */
    public function getActivationcode()
    {
        return $this->activationcode;
    }

    /**
     * @param mixed $activationcode
     */
    public function setActivationcode($activationcode)
    {
        $this->activationcode = $activationcode;
    }
}