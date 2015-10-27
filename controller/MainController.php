<?php

namespace controller;

use view\LoginView;

class MainController
{
    private $fileController, $loginController, $loginView;

    function __construct()
    {
        $this->loginView = new LoginView();
        $this->loginController = new LoginController($this->loginView);
        $this->fileController = new FileController();
    }

    /**
     * Main "loop"/run, does more or less everything
     */
    function run()
    {
        //Should fileController render as page?
        if ($this->fileController->shouldRender()) {
            return $this->fileController->run();
        } else {
            //Are we logged in?
            if ($this->loginController->run()) {
                //If we have another page to show when logged in, then place it here!
                //Example:
                $loggedInController = new LoggedInController();
                if ($loggedInController->wantsToEdit()) {
                    $editFileController = new EditFileController($loggedInController->getIdToEdit());
                    return $editFileController->run();
                }

                //If we didn't want to show that other page, show loginView (as logged in)
                return $loggedInController->run();
            } else { //This is what we want to show if we are not logged in
                $regController = new RegistrationController();
                //Do we want to show registration controller?
                if ($regController->shouldRun()) {
                    return $regController->run();
                }
            }

            //Showing loginView as logged out (wanting to log in)
            return $this->loginView;
        }
    }


}