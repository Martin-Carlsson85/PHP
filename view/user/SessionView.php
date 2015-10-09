<?php

namespace view;

class SessionView{
	public static $userCredentials = 'SessionView::UserClient';
    
    /**
     * This function will try to get login information from session.
     * If it cannot find session, it will return false.
     * 
     * @return array with [$userClient] = "$userClient" or false
     */
    function tryGetLoginCredentials(){
        if(isset($_SESSION[self::$userCredentials]))
                return $_SESSION[self::$userCredentials];
        return false;
    }

    /**
     * Saves UserCredentials to session
     * @param \model\UserCredentials $userCredentials
     */
    function saveLoginSession(\model\UserCredentials $userCredentials){
        $_SESSION[self::$userCredentials] = $userCredentials;
    }

    /**
     * Silently murders the session, since we have no more use for it
     */
    function killSession(){
        session_destroy();
    }
}