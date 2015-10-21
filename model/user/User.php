<?php

namespace model;

class User
{
    public $userName, $password;

    public function __construct($name, $password)
    {
        $this->userName = htmlspecialchars($name);
        $this->password = htmlspecialchars($password);
    }

    /**
     * Creates a string for easier use when saving the user to user list
     * @return string
     */
    public function __toString()
    {
        return $this->userName . ";" . $this->password;
    }
}