<?php

namespace controller;
 
class logincontroller
{
    private $view, $model, $sessionView, $cookieView, $loginView;

    function __construct($model, $view){
        $this->view = $view;
        $this->model = $model;
        $this->sessionView = new \view\SessionView();
        $this->cookieView = new \view\CookieView();
        $this->loginView = new \view\LoginView($this->model);
    }
    
    function run(){
        $isLoggedIn = $this->isLoggedIn();
        //Is the user trying to log in with the form?
        if(!$isLoggedIn && $this->doesTheUserWantToLogin()) {
            //Was the login successful?
            if($this->model->TryLogin($this->loginView->getName(), $this->loginView->getPassword())){
                $isLoggedIn = true;
                $this->sessionView->saveLoginSession($this->loginView->getName(), $this->loginView->getPassword());
                if($this->loginView->keepLoggedIn())
                    $this->cookieView->saveLoginCookie($this->loginView->getName(), $this->loginView->getPassword());
            }
        }
        
        if($isLoggedIn && $this->doesTheUserWantToLogout()) {
            $this->sessionView->killSession();
            $this->cookieView->killCookies();
            $isLoggedIn = false;
        }
        
        $dtv = new \view\DateTimeView();
        $this->view->render($isLoggedIn, $this->loginView, $dtv); //controller
    }
    
    /**
     * Checks if the user is logged in with session or cookies.
     * 
     * @return boolean
     */
    function isLoggedIn(){
        //Checking login with session
        $sessionCred = $this->sessionView->tryGetLoginCredentials();
        if($sessionCred != false) {
            return $this->model->TryLogin(
                $sessionCred[\view\SessionView::$username], 
                $sessionCred[\view\SessionView::$password]);
        }
        
        //Checking login with cookies
        $cookieCred = $this->cookieView->tryGetLoginCredentials();
        if($cookieCred != false) {
            return $this->model->TryLogin(
                $cookieCred[\view\CookieView::$username], 
                $cookieCred[\view\CookieView::$password]);
        }
        return false;
    }
    
    /**
     * Checks if the user wants to log in via form.
     * 
     * @return boolean
     */
    function doesTheUserWantToLogin(){  //Funktion som kollar om användare vill logga in
        return $this->loginView->wantsToLogIn();
    }
    
    function doesTheUserWantToLogout() {
        return $this->loginView->wantsToLogOut();
    }
}