<?php

namespace controller;

use model\RegistrationModel;
use model\UsersDAL;
use view\RegisterView;

class RegistrationController
{
    const REGISTER_SUCCESS_MESSAGE = "Registered new user.";

    private $view, $model, $usersDAL;

    function __construct()
    {
        $this->usersDAL = UsersDAL::getInstance();
        $this->model = new RegistrationModel($this->usersDAL);
        $this->view = new RegisterView();
    }

    function shouldRun(){
        return $this->view->tryingToRegister() || $this->view->wantsToRegister();
    }

    /**
     * @return bool
     */
    function run()
    {
        //Trying to register with form
        if ($this->view->tryingToRegister()) {
            $validation = $this->model->validate($user = $this->view->getRegistrationCredentials());
            if ($validation !== true) {
                $this->view->setMessage($validation);
                $this->view->showFormHTML();
                return true;
            } else { //Valid user input
                $this->usersDAL->saveUser($user);
                return false;
            }
        }

        //Show form
        if ($this->view->wantsToRegister()) {
            $this->view->showFormHTML();
            return true;
        }

        return false;
    }

    function getUsername(){
        return $this->view->getUsername();
    }

    function getMessage(){
        return self::REGISTER_SUCCESS_MESSAGE;
    }
}