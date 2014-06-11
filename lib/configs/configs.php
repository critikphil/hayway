<?php

define('PORT', (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? 'https://' : 'http://');
define('DOM_NAME',     'tonsiteinternet.fr');
define('SUBDOM_NAME',  '');

define('PATH',         PORT.SUBDOM_NAME.DOM_NAME.'/websites/hayway.am/');
define('COM_PATH',     PATH.'components/');

define('ABS_PATH',     dirname(dirname(dirname(__FILE__))).'/');
define('COM_ABS_PATH', ABS_PATH.'components/');

//way to the motor
define("MOTOR_ABS_PATH", dirname(dirname(dirname(dirname(dirname(__FILE__))))).'/tsi_engine_v4.2/');
define("MOTOR_PATH",     PORT.DOM_NAME.'/tsi_engine_v4.2/');

define('CURRENT_PATH', PORT.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);

define('SESSION_NAME', 'hayway');

define('MAIL_FROM',    'contact@hayway.am');
define('MAIL_NAME',    'Hayway');

define('SUPER_ADMIN', 8);
define('ADMIN',       4);
define('CLIENT',      2);
define('USER',        1);
define('UNKNOWN',     0);

//define salt and new user auth
define('NEW_USER_AUTH', CLIENT);
define('SALT',         'Ef1FZ34eAE6fazfarmenie-voyage.friA6ee3EfizpbAEF');

/*
 * define options and actions exception for auth
 * if all the component is an exception, define $action to 'all'
 */
$auth_exceptions   = array();
$auth_exceptions[] = array('option' => 'users', 'action' => 'lockedLoginForm');
$auth_exceptions[] = array('option' => 'users', 'action' => 'forgotPassword');
$auth_exceptions[] = array('option' => 'users', 'action' => 'resetPassword');
$auth_exceptions[] = array('option' => 'users', 'action' => 'registration');
$auth_exceptions[] = array('option' => 'users', 'action' => 'confirmMail');
$auth_exceptions[] = array('option' => 'users', 'action' => 'logout');
$auth_exceptions[] = array('option' => 'notification', 'action' => 'all');
define('AUTH_EXCEPTIONS', serialize($auth_exceptions));
?>