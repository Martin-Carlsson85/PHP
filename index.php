<?php

//INCLUDE THE FILES NEEDED...
require_once('view/LoginView.php');
require_once('view/DateTimeView.php');
require_once('view/LayoutView.php');

require_once('model/LoginModel.php');
require_once('controller/LoginController.php');

//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');

//Modellen
$loginmodel = new model\LoginModel();
//$session = new model\session();


//CREATE OBJECTS OF THE VIEWS
$view = new LoginView($loginmodel);
$dtv = new DateTimeView();
$lv = new LayoutView();

//Controller
$controller = new controller\LoginController($loginmodel, $view);
//$session->IsThereAnySession($controller);

//$controller->TryLogin();

$lv->render(false, $view, $dtv); //controller

