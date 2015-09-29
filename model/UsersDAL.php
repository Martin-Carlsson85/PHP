<?php

namespace model;

class UsersDAL{
    const SAVE_FILE_LOCATION = "./Data/users";

    private $users = array();

    function __construct(){
        //TODO: Load file here, if file does not exist, create it now

    }

    private function getUsers(){
        //TODO: Return users saved in file
    }

    function saveUser(RegistrationCredentials $userToSave){
        //TODO: Save user to file
    }

    /**
     * Returns the credentials of the user, if user does not exist, return false
     * @param $username Username to search for
     * @return bool|User Found user or false
     */
    function getUser($username){
        if($username == "Admin")
            return new User($username, "lösenord");
        return false;
    }
}