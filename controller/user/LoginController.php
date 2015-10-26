<?php

namespace controller;

use view\CookieView;
use view\LoginView;
use view\SessionView;

class LoginController implements ControllerInterface
{
    function __construct(loginview $LoginView)
    {
        $this->model = new \model\LoginModel();
        $this->loginView = $LoginView;
    }

    /**
     * Checks if the user is logged in with session or cookies.
     * @return boolean
     */
    private function isLoggedIn()
    {
        //Checking login with session
        $sessionCred = SessionView::tryGetLoginCredentials();
        $cookieCred = CookieView::tryGetLoginCredentials();

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

    /**
     * Tries to log in with cookies and returns true if successful, false otherwise
     * @param $cookieCred
     * @return bool
     */
    function tryLoginWithCookies($cookieCred)
    {
        //Checking login with cookies
        if ($this->model->TryLogin(
            $cookieCred[CookieView::$username],
            $cookieCred[CookieView::$password])
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



    function run()
    {
        //Check if the user is logged in
        $isLoggedIn = $this->isLoggedIn();
        //Is the user trying to log in with the form?
        if (!$isLoggedIn && $this->doesTheUserWantToLogin()) {
            //Was the login successful?
            if ($this->model->TryLogin($this->loginView->getName(), $this->loginView->getPassword())) {
                $isLoggedIn = true;
                SessionView::saveLoginSession($this->loginView->getUserCredentials());
                if ($this->loginView->keepLoggedIn())
                    CookieView::saveLoginCookie($this->loginView->getName(), $this->loginView->getPassword());
            } else {
                $this->loginView->setMessage($this->model->message);
            }
        }

        return $isLoggedIn;
    }
}