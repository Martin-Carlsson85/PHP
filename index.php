<?php
//INCLUDE THE FILES NEEDED...
require_once('model/User.php');
require_once('model/UsersDAL.php');
require_once('model/LoginModel.php');
require_once('model/RegistrationModel.php');
require_once('model/UserClient.php');
require_once('model/UserCredentials.php');
require_once('model/RegistrationCredentials.php');
require_once('controller/MainController.php');
require_once('controller/RegistrationController.php');
require_once('controller/LoginController.php');
require_once('view/LayoutView.php');
require_once('view/LoginView.php');
require_once('view/DateTimeView.php');
require_once('view/SessionView.php');
require_once('view/CookieView.php');
require_once('view/RegisterView.php');

//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');

session_start();

//Model
$loginmodel = new model\LoginModel();
//$session = new model\session();

//View
$view = new view\LayoutView();

//Controller
$controller = new controller\MainController($loginmodel, $view);

//Start the application
$controller->run();

