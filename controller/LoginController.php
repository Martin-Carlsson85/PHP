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
                //Here we should do all logic for trying to log in...
            }
            
            //TODO: We might have to read isLoggedIn again...
            $dtv = new \DateTimeView();
            $lv = new \LoginView($this->model);
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
            return false;
            /*if($this->loginView->getlogin()){
                $this->username = $this->loginView->getRequestUserName();   //Hämtar användarnamn från view
                $this->password = $this->loginView->getRequestUserPassword(); //Hämtar lösenord från view
            }*/
    }
}