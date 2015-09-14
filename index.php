<?php

//INCLUDE THE FILES NEEDED...
require_once('view/LoginView.php');
require_once('view/DateTimeView.php');
require_once('view/LayoutView.php');

require_once('LoginModel/loginmodell.php');
require_once('LoginController/logincontroller.php');

//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');

$loginmodel = new model\LoginModel();


//CREATE OBJECTS OF THE VIEWS
$view = new LoginView($loginmodel);
$dtv = new DateTimeView();
$lv = new LayoutView();


$controller = new controller\LoginController($loginmodel, $view);
$controller->TryLogin();

$lv->render(false, $view, $dtv);

