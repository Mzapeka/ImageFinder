<?php
/**
 * Created by PhpStorm.
 * User: Mzapeka
 * Date: 17.11.15
 * Time: 22:12
 */

namespace Controller;


use System\Controller;


class Main extends Controller {
    public function index()
    {
        $this->view->loadMainPage();
    }

    public function loadList(){
        $images = $this->model->getImgList();
        $this->view->mainView($images);
        //$this->view->loadImgList();
    }

    public function writeImg(){
        $this->model->imgWriteAction();
    }

} 