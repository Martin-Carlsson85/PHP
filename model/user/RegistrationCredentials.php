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

    /**
     * Gets the username of the registered user
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Gets the password of the registered user
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Gets the repeated password of the registered user
     * @return mixed
     */
    public function getPasswordRepeat()
    {
        return $this->passwordRepeat;
    }
}