<?php

namespace controller;

    require_once('view/DateTimeView.php');
    require_once('view/LayoutView.php');

    class logincontroller
    {
        private $view, $model;
    
        function __construct($model, $view){
            $this->view = $view;
            $this->model = $model;
        }
        
        function run(){
            $dtv = new \DateTimeView();
            $lv = new \LoginView($this->model);
            $this->view->render(false, $lv, $dtv); //controller
        }
        
        function doesTheUserWantToLogin(){  //Funktion som kollar om användare vill logga in
            //Villkor som hämtar ifrån view
            if($this->loginView->getlogin()){
                $this->username = $this->loginView->getRequestUserName();   //Hämtar användarnamn från view
                $this->password = $this->loginView->getRequestUserPassword(); //Hämtar lösenord från view
            }
    }
}