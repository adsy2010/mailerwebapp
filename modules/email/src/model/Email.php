<?php
/**
 * Created by PhpStorm.
 * User: awt
 * Date: 06/12/2017
 * Time: 10:58 AM
 */

class Email
{
    private $id, $user, $time, $sendto, $subject, $content;

    public function __construct($id, $user, $time, $sendto, $subject, $content)
    {
        $this->id = $id;
        $this->user = $user;
        $this->time = $time;
        $this->sendto = $sendto;
        $this->subject = $subject;
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @return mixed
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @return mixed
     */
    public function getSendto()
    {
        return $this->sendto;
    }

    /**
     * @return mixed
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }


}