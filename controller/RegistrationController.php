<?php

namespace controller;

class RegistrationController {
    private $view, $model;
    
     function __construct(\model\RegistrationModel $model, \view\RegisterView $view){
        $this->view = $view;
        $this->model = $model;
    }
    
    function run(){
        //Trying to register with form
        if($this->view->tryingToRegister()){
            //TODO: All register handling goes here
            return true;
        }
        
        //Show form
        if($this->view->wantsToRegister()) {
            $this->view->showFormHTML();
            return true;
        }

        return false;
    }
}