<?php

namespace controller;

class RegistrationController {
    private $view, $model;
    
     function __construct($model, $view){
        $this->view = $view;
        $this->model = $model;
    }
    
    function run(){
        //Trying to register with form
        if($this->view->tryingToRegister()){
            return true;
        }
        
        //Show form
        $this->view->showFormHTML();
        return false;
    }
}