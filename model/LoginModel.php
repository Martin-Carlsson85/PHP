<?php

namespace model;

class LoginModel
{
    const MISSING_USERNAME = "Username is missing";
    const MISSING_PASSWORD = "Password is missing";
    const WRONG_CREDENTIALS = "Wrong name or password";

    public $message = "";

    function __construct()
    {
    }

    /**
     * Implementation of login, if successful, return true, else return false.
     *
     * @return boolean
     */
    function TryLogin($username, $password)
    {
        if (empty($username)) {
            $this->message = self::MISSING_USERNAME;
            return false;
        }
        if (empty($password)) {
            $this->message = self::MISSING_PASSWORD;
            return false;
        }

        $usersDAL = UsersDAL::getInstance();
        if (($user = $usersDAL->getUser($username)) && $username === $user->userName && $password === $user->password) {
            return true;
        }
        $this->message = self::WRONG_CREDENTIALS;
        return false;
    }

    function TryLoginUserCred(\model\UserCredentials $cred)
    {
        /*if($cred->getName() === $this->username &&
            $cred->getPassword() === $this->password)
            return true;
        $this->message = self::WRONG_CREDENTIALS;*/
        return $this->TryLogin($cred->getName(), $cred->getPassword());
    }
}
