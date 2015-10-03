<?php

namespace controller;

class MainController
{
    private $view, $model, $sessionView, $cookieView, $loginView;

    function __construct(\model\LoginModel $model, \view\LayoutView $view)
    {
        $this->view = $view;
        $this->model = $model;
        $this->sessionView = new \view\SessionView();
        $this->cookieView = new \view\CookieView();
        $this->loginView = new \view\LoginView($this->model);
    }

    function run()
    {
        //Check if the user is logged in
        $isLoggedIn = $this->isLoggedIn();
        //Is the user trying to log in with the form?
        if (!$isLoggedIn && $this->doesTheUserWantToLogin()) {
            //Was the login successful?
            if ($this->model->TryLogin($this->loginView->getName(), $this->loginView->getPassword())) {
                $isLoggedIn = true;
                $this->sessionView->saveLoginSession($this->loginView->getUserCredentials());
                if ($this->loginView->keepLoggedIn())
                    $this->cookieView->saveLoginCookie($this->loginView->getName(), $this->loginView->getPassword());
                $this->loginView->setMessage(\view\LoginView::WELCOME_MESSAGE);
            } else {
                $this->loginView->setMessage($this->model->message);
            }
        }
        if ($isLoggedIn && $this->doesTheUserWantToLogout()) {
            $this->sessionView->killSession();
            $this->cookieView->killCookies();
            $isLoggedIn = false;
            $this->loginView->setMessage(\view\LoginView::GOODBYE_MESSAGE);
        }

        $regController = new RegistrationController();
        if ($regController->shouldRun()) {
            if ($regController->run()) {
                return;
            } else {
                $this->loginView->setMessage($regController->getMessage());
                $this->loginView->setName($regController->getUsername());
            }
        }

        $dtv = new \view\DateTimeView();
        $this->view->render($isLoggedIn, $this->loginView, $dtv); //controller
    }

    /**
     * Checks if the user is logged in with session or cookies.
     *
     * @return boolean
     */
    function isLoggedIn()
    {
        //Checking login with session
        $sessionCred = $this->sessionView->tryGetLoginCredentials();
        $cookieCred = $this->cookieView->tryGetLoginCredentials();

        if ($sessionCred != false) {
            if ($this->loginView->getUserClient()->isSame($sessionCred->getClient()) &&
                $this->model->TryLoginUserCred($sessionCred)
            ) {

                //Should fail if changed cookies
                if ($cookieCred != false)
                    if ($this->tryLoginWithCookies($cookieCred))
                        $this->loginView->setMessage("");
                    else
                        return false;

                return true;
            }
        }

        if ($cookieCred != false)
            return $this->tryLoginWithCookies($cookieCred);

        return false;
    }

    function tryLoginWithCookies($cookieCred)
    {
        //Checking login with cookies
        if ($this->model->TryLogin(
            $cookieCred[\view\CookieView::$username],
            $cookieCred[\view\CookieView::$password])
        ) {
            $this->loginView->setMessage(\view\LoginView::LOGIN_COOKIE);
            return true;
        } else {
            $this->loginView->setMessage(\view\LoginView::MANIPULATED_COOKIE);
            return false;
        }
    }

    /**
     * Checks if the user wants to log in via form.
     *
     * @return boolean
     */
    function doesTheUserWantToLogin()
    {  //Function that checks if the user wants to log in
        return $this->loginView->wantsToLogIn();
    }

    function doesTheUserWantToLogout()
    {
        return $this->loginView->wantsToLogOut();
    }
}