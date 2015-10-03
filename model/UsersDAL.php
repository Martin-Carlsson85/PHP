<?php

namespace model;

class UsersDAL
{
    const SAVE_FILE_LOCATION = "./Data/users";

    private static $instance = null;

    private $users = array();

    /**
     * Do not call this method! Use getUsersDAL() instead!
     */
    protected function __construct()
    {
        if (file_exists(self::SAVE_FILE_LOCATION) && is_file(self::SAVE_FILE_LOCATION))
            $this->readFile(self::SAVE_FILE_LOCATION);
    }

    private function readFile($fileName)
    {
        $file = fopen($fileName, "r");
        while (($line = fgets($file)) !== false) {
            $explodedLine = explode(';', trim($line));
            $this->users[] = new User($explodedLine[0], $explodedLine[1]);
        }
    }

    /**
     * Private clone method to prevent cloning of the instance to the singleton instance
     */
    private function __clone()
    {
    }

    /**
     *  Private unserialize method to prevent unserializing of the singleton instance
     */
    private function __wakeup()
    {
    }

    public static function getInstance()
    {
        if (static::$instance === null)
            static::$instance = new static();

        return static::$instance;
    }

    private function getUsers()
    {
        return $this->users;
    }

    function saveUser(RegistrationCredentials $userToSave)
    {
        $this->users[] = new User($userToSave->getUsername(), $userToSave->getPassword());
        $this->writeFile($this->users);
    }

    private function writeFile($users)
    {
        $stringToWrite = "";
        foreach ($users as $user) {
            $stringToWrite .= $user . "\n";
        }

        file_put_contents(self::SAVE_FILE_LOCATION, $stringToWrite);
    }

    /**
     * Returns the credentials of the user, if user does not exist, return false
     * @param $username Username to search for
     * @return bool|User Found user or false
     */
    function getUser($username)
    {
        foreach ($this->users as $user) {
            if ($username == $user->userName)
                return $user;
        }
        return false;
    }
}