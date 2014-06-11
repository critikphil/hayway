<?php

//start session
session_name(SESSION_NAME);
session_start();

function autoloadMotor($class) {
    include MOTOR_ABS_PATH.'lib/plugins/'. $class . '.php';
}

function autoloadApp($class) {
    include 'lib/plugins/'. $class . '.php';
}

spl_autoload_register('autoloadMotor');
spl_autoload_register('autoloadApp');

include_once MOTOR_ABS_PATH.'controller/Controller.php';
include_once MOTOR_ABS_PATH."model/Model.php";
include_once MOTOR_ABS_PATH."view/View.php";

function debug($var)
{
    echo "<pre>";
    print_r($var);
    echo "</pre>";
}
//$time = microtime(true);
Controller::__init();
//echo (microtime(true) - $time) . ' secondes';

?>
