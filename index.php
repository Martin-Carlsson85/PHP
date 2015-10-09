<?php
//INCLUDE THE FILES NEEDED...
require_once('model/user/User.php');
require_once('model/user/UsersDAL.php');
require_once('model/user/LoginModel.php');
require_once('model/user/RegistrationModel.php');
require_once('model/user/UserClient.php');
require_once('model/user/UserCredentials.php');
require_once('model/user/RegistrationCredentials.php');
require_once('model/file/FilesDAL.php');
require_once('model/file/File.php');
require_once('controller/file/FileController.php');
require_once('controller/MainController.php');
require_once('controller/user/RegistrationController.php');
require_once('controller/user/LoginController.php');
require_once('view/ViewInterface.php');
require_once('view/user/LayoutView.php');
require_once('view/user/LoginView.php');
require_once('view/DateTimeView.php');
require_once('view/user/SessionView.php');
require_once('view/user/CookieView.php');
require_once('view/user/RegisterView.php');

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
