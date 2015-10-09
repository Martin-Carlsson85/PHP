<?php

namespace model;

/**
 * Class RegistrationCredentials stores registration data from registration form, such as username, password and the
 * repeated password for easy access.
 * @package model
 */
class RegistrationCredentials {
    private $username, $password, $passwordRepeat;

    function __construct($username, $password, $passwordRepeat){
        $this->username = $username;
        $this->password = $password;
        $this->passwordRepeat = $passwordRepeat;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getPasswordRepeat()
    {
        return $this->passwordRepeat;
    }
}