<?php

namespace view;

class SessionView{
	public static $username = 'SessionView::Username';
	public static $password = 'SessionView::Password';
    
    /**
     * This function will try to get login information from session.
     * If it cannot find session, it will return false.
     * 
     * @return array with [$username] = "name" and [$password] = "password"
     */
    function tryGetLoginCredentials(){
        return array(self::$username => "Användarnamn", self::$password => "lösenord");
    }
}