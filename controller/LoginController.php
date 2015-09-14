<?php

namespace controller;

    class logincontroller
    {
       
        //Kommer ifrån modellen
        private $username;
        private $password;
        private $session;
    
        //Kommer ifrån vyn
        private $loginView;
        private $layoutView;
        private $dateView;
    
        function __construct($username, $password, $session, $loginView, $layoutView, $dateView){
            $this->username = $username;
            $this->password = $password;
            $this->session = $session;
            $this->loginView = $loginView;
            $this->layoutView = $layoutView;
            $this->dateView = $dateView;
        }
        
        function doesTheUserWantToLogin(){  //Funktion som kollar om användare vill logga in
        
        //Villkor som hämtar ifrån view
        if($this->loginView->getlogin()){
            $this->username = $this->loginView->getRequestUserName();   //Hämtar användarnamn från view
            $this->password = $this->loginView->getRequestUserPassword(); //Hämtar lösenord från view
        }
        }
        
        
}