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

} 