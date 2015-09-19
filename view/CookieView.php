<?php

namespace view;

class CookieView{
	public static $username = 'LoginView::CookieUsername';
	public static $password = 'LoginView::CookiePassword';
    
    /**
     * This function will try to get login information from session.
     * If it cannot find session, it will return false.
     * 
     * @return array with [$username] = "name" and [$password] = "password"
     */
    function tryGetLoginCredentials(){
        if(isset($_COOKIE[self::$username]) && isset($_COOKIE[self::$password]))
            return array(
                self::$username => $_COOKIE[self::$username],
                self::$password => $_COOKIE[self::$password]);
    }
    
    function saveLoginCookie($username, $password){
        setcookie(self::$username, $username, time() + (60));
        setcookie(self::$password, $password, time() + (60));
    }
    
    function killCookies(){
        setcookie(self::$username, "", time() - (6000));
        setcookie(self::$password, "", time() - (6000));
    }
}