<?php

namespace view;

class LoginView {
	const WELCOME_MESSAGE = "Welcome";
	const GOODBYE_MESSAGE = "Bye bye!";
	const LOGIN_COOKIE = "Welcome back with cookie";
	const MANIPULATED_COOKIE ="Wrong information in cookies";
	
	private static $login = 'LoginView::Login';
	private static $logout = 'LoginView::Logout';
	private static $name = 'LoginView::UserName';
	private static $password = 'LoginView::Password';
	private static $cookieName = 'LoginView::CookieName';
	private static $cookiePassword = 'LoginView::CookiePassword';
	private static $keep = 'LoginView::KeepMeLoggedIn';
	private static $messageId = 'LoginView::Message';

	public $messageToShow = "";


	/**
	 * Create HTTP response
	 *
	 * Should be called after a login attempt has been determined
	 *
	 * @return  void BUT writes to standard output and cookies!
	 */

	function __construct($loginmodel){
		$this->loginmodel = $loginmodel;
		
	}
	
	function getUserCredentials(){
		return new \model\UserCredentials(new \model\User($this->getName(),
										$this->getPassword()),
										$this->getUserClient());
	}
	
	function getUserClient() {
		return new \model\UserClient($_SERVER["REMOTE_ADDR"], $_SERVER["HTTP_USER_AGENT"]);
	}
	
	function wantsToLogIn(){
		return isset($_POST[self::$login]);
	}
	
	function wantsToLogOut(){
		return isset($_POST[self::$logout]);
	}

	function keepLoggedIn(){
		return isset($_POST[self::$keep]);
	}

	function getName(){
		return isset($_POST[self::$name]) ? $_POST[self::$name] : "";
	}

	function getPassword(){
		return isset($_POST[self::$password]) ? $_POST[self::$password] : "";
	}
	
	function setMessage($message){
		$this->messageToShow = $message;
	}

	public function response($isLoggedIn) {
		return $isLoggedIn ?
			$this->generateLogoutButtonHTML($this->messageToShow) :
			$this->generateLoginFormHTML($this->messageToShow);
	}

	/**
	* Generate HTML code on the output buffer for the logout button
	* @param $message, String output message
	* @return  void, BUT writes to standard output!
	*/
	private function generateLogoutButtonHTML($message) {
		return '
			<form  method="post" >
				<p id="' . self::$messageId . '">' . $message .'</p>
				<input type="submit" name="' . self::$logout . '" value="logout"/>
			</form>
		';
	}

	/**
	* Generate HTML code on the output buffer for the logout button
	* @param $message, String output message
	* @return  void, BUT writes to standard output!
	*/
	private function generateLoginFormHTML($message) {
		return '
			<form method="post" >
				<fieldset>
					<legend>Login - enter Username and password</legend>
					<p id="' . self::$messageId . '">' . $message . '</p>

					<label for="' . self::$name . '">Username :</label>
					<input type="text" id="' . self::$name . '" name="' . self::$name . '" value="'. $this->getName() .'" />

					<label for="' . self::$password . '">Password :</label>
					<input type="password" id="' . self::$password . '" name="' . self::$password . '" />

					<label for="' . self::$keep . '">Keep me logged in  :</label>
					<input type="checkbox" id="' . self::$keep . '" name="' . self::$keep . '" />

					<input type="submit" name="' . self::$login . '" value="login" />
					<a href="?register">Register a new user</a>
				</fieldset>
			</form>
		';
	}
}