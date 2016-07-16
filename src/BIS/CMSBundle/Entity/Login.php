<?php

namespace BIS\CMSBundle\Entity;

class Login {
    protected $email;
    protected $password;

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
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return bool|int
     */
    public function isYahooEmail() {
        return strpos($this->email, 'yahoo.com') ? true : false;
    }
}