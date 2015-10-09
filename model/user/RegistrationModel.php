<?php

namespace model;

class RegistrationModel{
    private $usersDAL;

    function __construct(UsersDAL $usersDAL){
        $this->usersDAL = $usersDAL;
    }

    /**
     * Validates registration credentials. If successful, return true
     * @param RegistrationCredentials $regCred
     * @return mixed String means error with error message, true if successful.
     */
    function validate(RegistrationCredentials $regCred){
        $returnMessage = "";
        if(mb_strlen($regCred->getUsername()) < 3)
            $returnMessage .= "Username has too few characters, at least 3 characters. ";
        if(mb_strlen($regCred->getPassword()) < 6)
            $returnMessage .= "Password has too few characters, at least 6 characters. ";
        if($regCred->getPassword() != $regCred->getPasswordRepeat())
            $returnMessage .= "Passwords do not match. ";

        if(preg_match('/[^a-z0-9]/i', $regCred->getUsername())) {
            //preg_replace('/[^a-z0-9]/i', '', $regCred->getUsername());
            $returnMessage .= "Username contains invalid characters.";
        }

        if($this->usersDAL->getUser($regCred->getUsername()) !== false)
        $returnMessage .= "User exists, pick another username. ";


        return empty($returnMessage) ? true : $returnMessage;
    }
}