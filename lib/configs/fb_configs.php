<?php

global $fbConfigs;

$fbConfigs = array();
$fbConfigs['appId'] = '1411407092427976';
$fbConfigs['secret'] = 'f80eb528f73ac36ce1464ef649ba28b5';
$fbConfigs['fileUpload'] = false; // optional

define('FB_APPID', $fbConfigs['appId']);
define('FB_LANG', 'fr_FR');
define('FB_PAGE_URL', 'https://www.facebook.com/tonsiteinternet');
define('FB_PERMISSIONS', serialize(array('email')));
?>