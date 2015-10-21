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
require_once('controller/ControllerInterface.php');
require_once('controller/file/FileController.php');
require_once('controller/file/EditFileController.php');
require_once('controller/MainController.php');
require_once('controller/user/RegistrationController.php');
require_once('controller/user/LoginController.php');
require_once('controller/LoggedInController.php');
require_once('view/ViewInterface.php');
require_once('view/file/FileView.php');
require_once('view/file/EditFileView.php');
require_once('view/user/LayoutView.php');
require_once('view/user/LoginView.php');
require_once('view/DateTimeView.php');
require_once('view/user/SessionView.php');
require_once('view/user/CookieView.php');
require_once('view/user/RegisterView.php');
require_once('view/LoggedInView.php');
require_once('view/file/DeleteFileView.php');

//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');

session_start();

//Model
$loginmodel = new model\LoginModel();
//$session = new model\session();

//View
$view = new view\LayoutView();
$dtv = new \view\DateTimeView();

//Controller
$controller = new controller\MainController();

//Start the application
$viewToRender = $controller->run();
//Render the view returned from the controller
$view->render($viewToRender, $dtv);