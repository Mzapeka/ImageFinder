<?php

require_once "autoload.php";
//define('MYSITE', 'http://imagecrawler.azurewebsites.net/');
define('MYSITE', 'http://imagefinder/');
define('LIMIT', 5);
$obj = new System\Routing();
$obj::loadPage();