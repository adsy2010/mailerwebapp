<?php
/**
 * Created by PhpStorm.
 * User: awt
 * Date: 11/12/2017
 * Time: 9:36 AM
 */
session_start();
require_once 'PDOHandler.php';

class Scripts
{
    private $db;

    public function __construct(PDOHandler $db)
    {
        $this->db = $db;
    }

    private function setupSession($id, $admin = false)
    {
        if($admin) $_SESSION['admin'] = true;
        $_SESSION['user'] = $id;
    }

    private function authenticate($email, $password)
    {
        $result = $this->db->runQuery("SELECT * FROM users WHERE email = ?", array($email));

        //Check account exists
        if(!(count($result) > 0)) return false;

        //Check account is active
        if(!($result[0]['active'] > 0)) return false;

        //Make the password salty
        $salt = $result[0]['salt'];
        $password = $this->encrypt($password, $salt);


        //Check it matches
        if($password == $result[0]['password']) {
            $this->setupSession($result[0]['id'], $result[0]['admin']);
            return true;
        }

        return false;
    }

    public function activate($id, $code)
    {
        $sql = "UPDATE users SET active = '1' WHERE id = ? AND activationcode = ?";
        $this->db->runQuery($sql, array($id, $code));
        $user = $this->getUser($id);
        return $user['active'];
    }

    public function getUser($id)
    {
        $sql = "SELECT * FROM users WHERE id = ?";
        $result = $this->db->runQuery($sql, array($id));
        if(count($result) > 0) return $result[0];
    }


    private function encrypt($password, $salt)
    {
        return hash("SHA256", $salt . $password . "*");
    }

    public function login()
    {
        if(!isset($_POST) || empty($_POST)) return "";

        if(isset($_POST['email']) && isset($_POST['password']))
        {
            $state = $this->authenticate($_POST['email'], $_POST['password']);
            if(!$state)
                return "<div class='alert alert-danger'><strong>Invalid credentials!</strong> Your username or password was incorrect!</div>";


            return "<div class='alert alert-success'><strong>Success!</strong> You have successfully logged in!</div>";

        }
        else
        {
            return "No information was sent";
        }
    }

    /**
     * Destroy any user session and session data
     */
    public function logout()
    {
        session_unset();
        session_destroy();
        session_start();
        return "<div class='alert alert-success'><strong>Success!</strong> You have successfully logged out!</div>";

    }

    public function register()
    {
        //If no form has been submitted, ensure that nothing happens
        if(!isset($_POST) || empty($_POST)) return;
        //print_r($_POST);
        if(isset($_POST['email']) && isset($_POST['password']) && isset($_POST['realname']))
        {
            $result = $this->registerUser($_POST['email'], $_POST['password'], $_POST['realname']);
            return $result;
        }
        else
        {
            return "No details";
        }
    }

    public function updateUser($data)
    {
        if(!isset($data['user'])) return null;
        if(empty($data['fullname']) || empty($data['email'])) return null;

        $sql = "UPDATE users SET email = ?, active = ?, fullname = ? WHERE id = ?";

        $active = (isset($data['active'])) ? 1 : 0;

        $result = $this->db->runQuery($sql, array($data['email'],$active,$data['fullname'],$data['user']));
        if($result) return "Successfully updated user {$data['fullname']}";
    }

    public function sendActivation($id)
    {
/*
	$activationCode = hash("SHA256", $email. time() . "activationcode");

        $sql = "UPDATE users SET `activationcode` = ? WHERE id = ?";

        $result = $this->db->runQuery($sql, array(
		$activationCode,
		$id
        ));
	
        $id = $this->db->getLastId();

	$user = $this->getUser($id);
	$fullname = $user['fullname'];
	$email = $user['email'];

        $body = $this->getEmailTemplate("activation", array(
            "FULLNAME" => $fullname,
            "ACTIVATIONCODE" => $activationCode,
            "ID" => $id
        ));

        if($result) {
            $this->sendEmail($email, "Activation for NCS Mailer", $body);
            return $this->db->getLastId();
        }
*/
    }

    public function deactivate($id)
    {
	//generate a new activation code to prevent reactivation
	$activationCode = hash("SHA256", $email. time() . "activationcode");
	$sql = "UPDATE users SET `activationcode` = ?, `active` = 0 WHERE id = ?";
	$result = $this->db->runQuery($sql, array($activationCode, $id));
	return $result;
    }

    public function registerUser($email, $password, $fullname)
    {
        $activationCode = hash("SHA256", $email. session_id() . "activationcode");
        $salt = hash("SHA256", time() . "salt");
        $password = $this->encrypt($password, $salt);

        $sql = "INSERT INTO users (`email`, `password`, `fullname`, `salt`, `activationcode`) VALUES(?,?,?,?,?)";

        $result = $this->db->runQuery($sql, array(
            $email,
            $password,
            $fullname,
            $salt,
            $activationCode
        ));

        $id = $this->db->getLastId();

        $body = $this->getEmailTemplate("register", array(
            "FULLNAME" => $fullname,
            "ACTIVATIONCODE" => $activationCode,
            "ID" => $id
        ));


        if($result) {
            $this->sendEmail($email, "Registered for * Mailer", $body);
            return $this->db->getLastId();
        }
    }

    public function getAllEmails()
    {
        $sql = "SELECT emails.*, users.`fullname` as user_fullname FROM emails INNER JOIN users ON emails.`user` = users.`id` ORDER BY `time` DESC";
        $result = $this->db->runQuery($sql);
        return $result;
    }

    public function getEmail($id)
    {
    	$sql = "SELECT * FROM emails WHERE id = ?";

        $result = $this->db->runQuery($sql, array($id));
	if(count($result) > 0)
	{
	    if(isset($_SESSION['admin'])) return $result[0];
	    return ($result[0]['user'] == $_SESSION['user']) ? $result[0] : NULL;
	}
	return null;
    }

    public function getEmailsByUser()
    {
        $user = $_SESSION['user'];
        $sql = "SELECT * FROM emails WHERE `user` = ? ORDER BY `time` DESC";
        $result = $this->db->runQuery($sql, array($user));
        return $result;
    }

    public function getEmailTemplate($template = null, $array = array())
    {
        if($template !== null){
            ob_start();
            include "emails/{$template}.phtml";
            $body = ob_get_contents();
            ob_clean();
            foreach ($array as $key => $value)
                $body = str_replace("{{$key}}", $value, $body);
            return $body;
        }
        return null;
    }

    public function listUsers()
    {
        $sql = "SELECT * FROM users";
        $result = $this->db->runQuery($sql);
        return $result;
    }

    public function saveEmail($email, $subject, $body, $status = 0)
    {
        $user = $_SESSION['user'];
        $time = time();
        $sendTo = $email;
        //$subject = $subject;
        $content = $body;
        //$status = $status;

        $sql = "INSERT INTO emails (`user`, `time`, `sendto`, `subject`, `content`, `status`) VALUES (?,?,?,?,?,?)";
        $result = $this->db->runQuery($sql, array($user, $time, $sendTo, $subject, $content, $status));
    }

    public function createSignature()
    {
        $user = $this->getUser($_SESSION['user']);
    }

    public function sendEmail($email, $subject, $body)
    {
        $headers = "From: \"*\" <*@*.*.*.*>\n";
        $headers .= "Reply-to: \"*\" <*@*.*.*.*>\n";
        $headers .= "Content-Type: text/html; charset=iso-8859-1\n";


        $status = mail($email, $subject, $body, $headers);
        $this->saveEmail($email, $subject, $body, $status);

        return $status;
    }

}

$script = new Scripts($db);