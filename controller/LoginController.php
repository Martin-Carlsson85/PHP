<?php

namespace controller;
 
class logincontroller
{
    private $view, $model;

    function __construct($model, $view){
        $this->view = $view;
        $this->model = $model;
    }
    
    function run(){
        $loginView = new \view\LoginView($this->model);
        
        $isLoggedIn = $this->isLoggedIn();
        if(!$isLoggedIn && $this->doesTheUserWantToLogin()) {
            if($this->model->TryLogin($loginView->getName(), $loginView->getPassword()))
                $isLoggedIn = true;
            //TODO: Add to session AND cookie
        }
        
        //TODO: We might have to read isLoggedIn again...
        $dtv = new \view\DateTimeView();
        $this->view->render($isLoggedIn, $loginView, $dtv); //controller
    }
    
    /**
     * Checks if the user is logged in with session or cookies.
     * 
     * @return boolean
     */
    function isLoggedIn(){
        //Checking login with session
        $sessionView = new \view\SessionView();
        $sessionCred = $sessionView->tryGetLoginCredentials();
        if($sessionCred != false) {
            return $this->model->TryLogin(
                $sessionCred[\view\SessionView::$username], 
                $sessionCred[\view\SessionView::$password]);
        }
        
        //Checking login with cookies
        $cookieView = new \view\CookieView();
        $cookieCred = $cookieView->tryGetLoginCredentials();
        if($cookieCred != false) {
            return $this->model->TryLogin(
                $cookieCred[\view\SessionView::$username], 
                $cookieCred[\view\SessionView::$password]);
        }
        return false;
    }
    
    /**
     * Checks if the user wants to log in via form.
     * 
     * @return boolean
     */
    function doesTheUserWantToLogin(){  //Funktion som kollar om användare vill logga in
        //Villkor som hämtar ifrån view
        return true;
        /*if($this->loginView->getlogin()){
            $this->username = $this->loginView->getRequestUserName();   //Hämtar användarnamn från view
            $this->password = $this->loginView->getRequestUserPassword(); //Hämtar lösenord från view
        }*/
    }
}