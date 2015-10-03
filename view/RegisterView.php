<?php
namespace view;

class RegisterView {
    const USERNAME_TOO_SHORT ="Username has too few characters, at least 3 characters.";
    const PASSWORD_TOO_SHORT ="Password has too few characters, at least 6 characters.";

    private static $register = 'RegisterView::Register';
	private static $name = 'RegisterView::UserName';
	private static $password = 'RegisterView::Password';
	private static $passwordRepeat = 'RegisterView::PasswordRepeat';
	private static $messageId = 'RegisterView::Message';

    private $messageToShow = "";


    static function wantsToRegister(){
        //TODO: bort med strängberonden
        return isset($_GET['register']);
    }
    function tryingToRegister(){
        return isset($_POST[self::$register]);
    }

    function setMessage($message){
        $this->messageToShow = $message;
    }

    function getRegistrationCredentials(){
        return new \model\RegistrationCredentials($this->getUsername(), $this->getPassword(), $this->getPasswordRepeat());
    }

    public function getUsername(){
        return isset($_POST[self::$name]) ? $_POST[self::$name] : "";
}

    private function getPassword(){
        return isset($_POST[self::$password]) ? $_POST[self::$password] : "";
    }

    private function getPasswordRepeat(){
        return isset($_POST[self::$passwordRepeat]) ? $_POST[self::$passwordRepeat] : "";
    }

    function showFormHTML(){
        echo '<form method="post" action="./" >
				<fieldset>
					<legend>Register - enter Username and password</legend>
					<p id="' . self::$messageId . '">' . $this->messageToShow . '</p>

					<label for="' . self::$name . '">Username :</label>
					<input type="text" id="' . self::$name . '" name="' . self::$name . '" value="'. strip_tags($this->getUsername()) .'" />

					<label for="' . self::$password . '">Password :</label>
					<input type="password" id="' . self::$password . '" name="' . self::$password . '" />

					<label for="' . self::$passwordRepeat . '">Password :</label>
					<input type="password" id="' . self::$passwordRepeat . '" name="' . self::$passwordRepeat . '" />

					<input type="submit" name="' . self::$register . '" value="register" />
					<a href="./">Back to login</a>
				</fieldset>
			</form>';
    }
}