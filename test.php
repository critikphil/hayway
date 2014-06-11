<?php
ob_start();
ini_set('display_errors', 'On');
error_reporting(E_ALL);
include_once("lib/includes.php");

setcookie('chatstate', '', time(), '/', '.'.DOM_NAME);
?>