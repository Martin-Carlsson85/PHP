<?php

namespace controller;

use view\LoginView;

class MainController
{
    private $fileContoller, $loginController, $loginView;

    function __construct()
    {
        $this->loginController = new LoginController($this->loginView);
        $this->fileContoller = new FileController();
    }

    /**
     * Main "loop"/run, does more or less everything
     */
    function run()
    {
        //Should fileController render as page?
        if ($this->fileContoller->shouldRender()) {
            return $this->fileContoller->run();
        } else {
            //Are we logged in?
            if ($this->loginController->run()) {
                //If we have another page to show when logged in, then place it here!
                //Example:
                $loggedInController = new LoggedInController();
                if ($loggedInController->wantsToEdit()) {
                    $editFileContoller = new EditFileController($loggedInController->getIdToEdit());
                    return $editFileContoller->run();
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
            return new LoginView();
        }
    }


}