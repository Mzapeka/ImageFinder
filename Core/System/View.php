<?php
/**
 * Created by PhpStorm.
 * User: Mzapeka
 * Date: 22.08.15
 * Time: 15:22
 */

namespace System;


abstract class View {
    public function loadHeader(){
        include_once "view/header.php";
    }
    public function loadMenu(){
        include_once "view/main.php";
    }
    public function loadfooter(){
        include_once "view/footer.php";
    }

} 