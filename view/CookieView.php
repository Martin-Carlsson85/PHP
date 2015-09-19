<?php

namespace view;

class CookieView{
	public static $username = 'CookieView::Username';
	public static $password = 'CookieView::Password';
    
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