<?php

global $dbConfigs;

$dbConfigs['host'] = "localhost";
$dbConfigs['name'] = "tonsiteinternet.fr";
$dbConfigs['user'] = "tonsiteinternet";
$dbConfigs['pass'] = "wMcLA7nFuArBmpR9";

if(getenv("HTTP_HOST") == "localhost" || getenv("HTTP_HOST") == "127.0.0.1")
{
    $dbConfigs['host'] = "localhost";
    $dbConfigs['name'] = "tonsiteinternet.fr";
    $dbConfigs['user'] = "root";
    $dbConfigs['pass'] = "";
}
?>