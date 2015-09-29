<?php
namespace view;

class RegistrationView {
    private static $register = 'RegistrationView::Register';
	private static $name = 'RegistrationView::UserName';
	private static $password = 'RegistrationView::Password';
	private static $messageId = 'LoginView::Message';
	
    function tryingToRegister(){
        return isset($_POST[self::$register]);
    }
    function showFormHTML(){
        $message = "HEJSAN";
        echo '<form method="post" >
				<fieldset>
					<legend>Register - enter Username and password</legend>
					<p id="' . self::$messageId . '">' . $message . '</p>

					<label for="' . self::$name . '">Username :</label>
					<input type="text" id="' . self::$name . '" name="' . self::$name . '" />

					<label for="' . self::$password . '">Password :</label>
					<input type="password" id="' . self::$password . '" name="' . self::$password . '" />

					<input type="submit" name="' . self::$register . '" value="register" />
					<a href="/">Back to login</a>
				</fieldset>
			</form>';
    }
}