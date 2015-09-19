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
        $isLoggedIn = $this->isLoggedIn();
        if(!$isLoggedIn && $this->doesTheUserWantToLogin()) {
            //Checking login with session
            $sessionView = new \view\SessionView();
            $sessionCred = $sessionView->tryGetLoginCredentials();
            if($sessionCred != false) {
                $this->model->CheckUsernamnandPassword(
                    $sessionCred[\view\SessionView::$username], 
                    $sessionCred[\view\SessionView::$password]);
            }
            
            //Checking login with cookies
            $cookieView = new \view\CookieView();
            $cookieCred = $cookieView->tryGetLoginCredentials();
            if($cookieCred != false) {
                $this->model->CheckUsernamnandPassword(
                    $cookieCred[\view\SessionView::$username], 
                    $cookieCred[\view\SessionView::$password]);
            }
        }
        
        //TODO: We might have to read isLoggedIn again...
        $dtv = new \view\DateTimeView();
        $lv = new \view\LoginView($this->model);
        $this->view->render($isLoggedIn, $lv, $dtv); //controller
    }
    
    /**
     * Checks if the user is logged in.
     * 
     * @return boolean
     */
    function isLoggedIn(){
        return false;
    }
    
    /**
     * Checks if the user wants to log in.
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