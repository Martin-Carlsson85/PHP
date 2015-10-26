<?php
namespace view;

class RegisterView implements ViewInterface
{
    const USERNAME_TOO_SHORT = "Username has too few characters, at least 3 characters.";
    const PASSWORD_TOO_SHORT = "Password has too few characters, at least 6 characters.";

    public static $registerPostKey = "register";
    private static $register = 'RegisterView::Register';
    private static $name = 'RegisterView::UserName';
    private static $password = 'RegisterView::Password';
    private static $passwordRepeat = 'RegisterView::PasswordRepeat';
    private static $messageId = 'RegisterView::Message';

    private $messageToShow = "";


    /**
     * Does the user want to register? (?register in url)
     * @return bool
     */
    static function wantsToRegister()
    {
        return isset($_GET[self::$registerPostKey]);
    }

    /**
     * Is the user trying to register? (register post button pressed)
     * @return bool
     */
    function tryingToRegister()
    {
        return isset($_POST[self::$register]);
    }

    /**
     * Sets the message to show (like passwords does not match)
     * @param $message
     */
    function setMessage($message)
    {
        $this->messageToShow = $message;
    }

    /**
     * Gets the RegistrationCredentials from the post, used in model to check and save user
     * @return \model\RegistrationCredentials
     */
    function getRegistrationCredentials()
    {
        return new \model\RegistrationCredentials($this->getUsername(), $this->getPassword(), $this->getPasswordRepeat());
    }

    /**
     * Gets the username from the post
     * @return string
     */
    public function getUsername()
    {
        return isset($_POST[self::$name]) ? $_POST[self::$name] : "";
    }

    /**
     * Gets the password from the post
     * @return string
     */
    private function getPassword()
    {
        return isset($_POST[self::$password]) ? $_POST[self::$password] : "";
    }

    /**
     * Gets the repeated password from the post
     * @return string
     */
    private function getPasswordRepeat()
    {
        return isset($_POST[self::$passwordRepeat]) ? $_POST[self::$passwordRepeat] : "";
    }

    /**
     * Renders the registration form onto the screen
     * @return string
     */
    function render()
    {
        return '<form id="formLogin" method="post" action="./" >
				<fieldset>
					<legend>Register - enter Username and password</legend>
					<p id="' . self::$messageId . '">' . $this->messageToShow . '</p>

					<label for="' . self::$name . '">Username :</label>
					<input class="username2" type="text" id="' . self::$name . '" name="' . self::$name . '" value="' . strip_tags($this->getUsername()) . '" /><br/>

					<label for="' . self::$password . '">Password :</label>
					<input class="password2" type="password" id="' . self::$password . '" name="' . self::$password . '" /><br/>

					<label for="' . self::$passwordRepeat . '">Password :</label>
					<input class="password3" type="password" id="' . self::$passwordRepeat . '" name="' . self::$passwordRepeat . '" /><br/>

					<input type="submit" name="' . self::$register . '" value="register" />
					<a href="./">Back to login</a>
				</fieldset>
			</form>';
    }
}