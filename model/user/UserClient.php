<?php

namespace model;

/**
 * Class UserClient saves ip-address and UserClient (browser information)
 * @package model
 */
class UserClient{
    public $ipAdress, $userClient;
    
    function __construct($ipAdress, $userClient){
        $this->ipAdress = $ipAdress;
        $this->userClient = $userClient;
    }
    
    /**
     * Checks if the UserClient contains the same information,
     * and assumes it is the same if true.
     * @return boolean true or false
     */
    function isSame(UserClient $other){
        return $this->ipAdress == $other->ipAdress &&
                $this->userClient == $other->userClient;
    }
}