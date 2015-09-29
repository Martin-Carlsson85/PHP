<?php

namespace controller;

use model\RegistrationModel;
use model\UsersDAL;
use view\RegisterView;

class RegistrationController
{
    private $view, $model, $usersDAL;

    function __construct()
    {
        $this->usersDAL = new UsersDAL();
        $this->model = new RegistrationModel($this->usersDAL);
        $this->view = new RegisterView();
    }

    function run()
    {
        //Trying to register with form
        if ($this->view->tryingToRegister()) {
            $validation = $this->model->validate($user = $this->view->getRegistrationCredentials());
            if ($validation !== true) {
                $this->view->setMessage($validation);
            } else { //Valid user input
                $this->usersDAL->saveUser($user);
                return "Registered new user.";
            }
        }

        //Show form
        if ($this->view->wantsToRegister()) {
            $this->view->showFormHTML();
            return true;
        }

        return false;
    }
}