<?php

require_once('controller/RegistrationController.php');
require_once('view/RegistrationView.php');
require_once('model/RegistrationModel.php');

//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');

//Model
$model = new model\RegistrationModel();

//View
$view = new view\RegistrationView();

//Controller
$controller = new controller\RegistrationController($model, $view);

//Start the application
$controller->run();

