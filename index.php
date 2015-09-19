<?php

//INCLUDE THE FILES NEEDED...
require_once('model/LoginModel.php');
require_once('controller/LoginController.php');
require_once('view/LayoutView.php');
require_once('view/LoginView.php');
require_once('view/DateTimeView.php');

//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');

//Model
$loginmodel = new model\LoginModel();
//$session = new model\session();

//View
$view = new LayoutView();

//Controller
$controller = new controller\LoginController($loginmodel, $view);
//$session->IsThereAnySession($controller);

//Start the application
$controller->run();
//$controller->TryLogin();

