<?php
/**
 * Created by PhpStorm.
 * User: Mzapeka
 * Date: 22.08.15
 * Time: 14:07
 */

namespace System;

abstract class Controller {
    public $model;
    public $view;
    abstract function index();
    function __construct(){
        $className = get_called_class();
        $className = explode("\\", $className)[1];
        $model = "\\Model\\$className";
        //var_dump($model);
        if (class_exists($model)){
            $this->model = new $model();
        }
        $view = "\\View\\$className";
        if (class_exists($view)){
            $this->view = new $view();
        }
    }
    function __call($methodName, $arguments){
        echo "404";
    }
} 