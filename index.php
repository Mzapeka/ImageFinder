<?php

require_once "autoload.php";
define('MYSITE', 'http://imagecrawler.azurewebsites.net/');
define('LIMIT', false);
$obj = new System\Routing();
$obj::loadPage();