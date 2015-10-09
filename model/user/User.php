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

    public function __toString()
    {
        return $this->userName . ";" . $this->password;
    }
}