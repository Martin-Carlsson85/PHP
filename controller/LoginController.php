<?php

namespace controller;

    class logincontroller
    {
        private $view, $model;
    
        function __construct($view, $model){
            $this->view = $view;
            $this->model = $model;
        }
        
        function doesTheUserWantToLogin(){  //Funktion som kollar om användare vill logga in
        
        //Villkor som hämtar ifrån view
        if($this->loginView->getlogin()){
            $this->username = $this->loginView->getRequestUserName();   //Hämtar användarnamn från view
            $this->password = $this->loginView->getRequestUserPassword(); //Hämtar lösenord från view
        }
        }
        
        
}