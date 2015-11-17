<?php
/**
 * Created by PhpStorm.
 * User: Mzapeka
 * Date: 22.08.15
 * Time: 13:25
 */

function __autoload($className){
    if (file_exists("core/$className.php")){
        include_once "core/$className.php";
    }
}