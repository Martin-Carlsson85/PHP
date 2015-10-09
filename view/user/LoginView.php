<?php

namespace view;

class LoginView implements ViewInterface
{
    const WELCOME_MESSAGE = "Welcome";
    const GOODBYE_MESSAGE = "Bye bye!";
    const LOGIN_COOKIE = "Welcome back with cookie";
    const MANIPULATED_COOKIE = "Wrong information in cookies";

    private static $login = 'LoginView::Login';
    private static $logout = 'LoginView::Logout';
    private static $name = 'LoginView::UserName';
    private static $password = 'LoginView::Password';
    private static $keep = 'LoginView::KeepMeLoggedIn';
    private static $messageId = 'LoginView::Message';

    private $messageToShow = "";
    private $isLoggedIn;


    /**
     * Create HTTP response
     * Should be called after a login attempt has been determined
     * @param $isLoggedin
     */

    function __construct($isLoggedin)
    {
        $this->isLoggedin = $isLoggedin;
    }

    /**
     * Gets UserCredentials created from values gotten from post
     * @return \model\UserCredentials
     */
    function getUserCredentials()
    {
        return new \model\UserCredentials(new \model\User($this->getName(),
            $this->getPassword()),
            $this->getUserClient());
    }

    /**
     * Gets the UserClient of the client
     * @return \model\UserClient
     */
    function getUserClient()
    {
        return new \model\UserClient($_SERVER["REMOTE_ADDR"], $_SERVER["HTTP_USER_AGENT"]);
    }

    /**
     * Does the user want to log in? (Is login form button pressed?)
     * @return bool
     */
    function wantsToLogIn()
    {
        return isset($_POST[self::$login]);
    }

    /**
     * Does the user want to log out?
     * @return bool
     */
    function wantsToLogOut()
    {
        return isset($_POST[self::$logout]);
    }

    /**
     * Did the user ask to keep user credentials in cookie?
     * @return bool
     */
    function keepLoggedIn()
    {
        return isset($_POST[self::$keep]);
    }

    /**
     * Sets the post name (mostly for use when registering)
     * @param $name
     */
    function setName($name)
    {
        $_POST[self::$name] = $name;
    }

    /**
     * Returns the post name
     * @return string
     */
    function getName()
    {
        return isset($_POST[self::$name]) ? $_POST[self::$name] : "";
    }

    /**
     * Returns the post password
     * @return string
     */
    function getPassword()
    {
        return isset($_POST[self::$password]) ? $_POST[self::$password] : "";
    }

    /**
     * Sets the message to show
     * @param $message
     */
    function setMessage($message)
    {
        $this->messageToShow = $message;
    }

    /**
     * Returns what to show from LoginView on page, depending on if user is logged in or not
     */
    function render()
    {
        return $this->isLoggedIn ?
            $this->generateLogoutButtonHTML($this->messageToShow) :
            $this->generateLoginFormHTML($this->messageToShow);
    }

    /**
     * Generate HTML code on the output buffer for the logout button
     * @param $message , String output message
     * @return  void, BUT writes to standard output!
     */
    private function generateLogoutButtonHTML($message)
    {
        return '
			<form  method="post" >
				<p id="' . self::$messageId . '">' . $message . '</p>
				<input type="submit" name="' . self::$logout . '" value="logout"/>
			</form>
		';
    }

    /**
     * Generate HTML code on the output buffer for the logout button
     * @param $message , String output message
     * @return  void, BUT writes to standard output!
     */
    private function generateLoginFormHTML($message)
    {
        return '
			<form method="post" >
				<fieldset>
					<legend>Login - enter Username and password</legend>
					<p id="' . self::$messageId . '">' . $message . '</p>

					<label for="' . self::$name . '">Username :</label>
					<input type="text" id="' . self::$name . '" name="' . self::$name . '" value="' . $this->getName() . '" />

					<label for="' . self::$password . '">Password :</label>
					<input type="password" id="' . self::$password . '" name="' . self::$password . '" />

					<label for="' . self::$keep . '">Keep me logged in  :</label>
					<input type="checkbox" id="' . self::$keep . '" name="' . self::$keep . '" />

					<input type="submit" name="' . self::$login . '" value="login" />
					<a href="?' . RegisterView::$registerPostKey . '">Register a new user</a>
				</fieldset>
			</form>
		';
    }

    /**
     * @param boolean $isLoggedin
     */
    public function setIsLoggedin($isLoggedin)
    {
        $this->isLoggedin = $isLoggedin;
    }
}