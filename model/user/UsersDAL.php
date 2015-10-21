<?php

namespace model;

class UsersDAL
{
    const SAVE_FILE_LOCATION = "./Data/users";

    private static $instance = null;

    private $users = array();

    /**
     * Do not call this method! Use getInstance() instead!
     */
    protected function __construct()
    {
        if (file_exists(self::SAVE_FILE_LOCATION) && is_file(self::SAVE_FILE_LOCATION))
            $this->readFile(self::SAVE_FILE_LOCATION);
    }

    /**
     * Reads users from a file
     * @param $fileName
     */
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

    /**
     * This is to make UserDAL singleton, if there is no instance of UserDAL, make one,
     * else return the instance
     * @return UsersDAL
     */
    public static function getInstance()
    {
        if (static::$instance === null)
            static::$instance = new static();

        return static::$instance;
    }

    /**
     * Returns the array containing the users from the file
     * @return array
     */
    private function getUsers()
    {
        return $this->users;
    }

    /**
     * Saves a new user to the file
     * @param RegistrationCredentials $userToSave
     */
    function saveUser(RegistrationCredentials $userToSave)
    {
        $this->users[] = new User($userToSave->getUsername(), password_hash($userToSave->getPassword(), PASSWORD_BCRYPT));
        $this->writeFile($this->users);
    }

    /**
     * Writes all users to file
     * @param $users
     */
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
        foreach ($this->getUsers() as $user) {
            if ($username == $user->userName)
                return $user;
        }
        return false;
    }
}