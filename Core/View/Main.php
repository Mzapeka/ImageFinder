<?php
/**
 * Created by PhpStorm.
 * User: Mzapeka
 * Date: 17.11.15
 * Time: 22:26
 */

namespace View;


use System\View;

class Main extends View {

    public function loadMainPage(){
        $this->loadHeader();
        $this->loadMenu();
        $this->loadfooter();
    }

    public function mainView($images){
        $this->loadHeader();
        include_once("View/productList.php");
        $this->loadfooter();
    }

} 