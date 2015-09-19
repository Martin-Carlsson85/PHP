<?php

namespace view;

class SessionView{
	public static $username = 'SessionView::Username';
	public static $password = 'SessionView::Password';
    
    /**
     * This function will try to get login information from session.
     * If it cannot find session, it will return false.
     * 
     * @return array with [$username] = "name" and [$password] = "password" OR false
     */
    function tryGetLoginCredentials(){
        if(isset($_SESSION[self::$username]) && isset($_SESSION[self::$password]))
            return array(
                self::$username => $_SESSION[self::$username], 
                self::$password => $_SESSION[self::$password]);
        return false;
    }
    
    function saveLoginSession($username, $password){
        $_SESSION[self::$username] = $username;
        $_SESSION[self::$password] = $password;
    }
    
    function killSession(){
        session_destroy();
    }
}