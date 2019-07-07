<?php


class Application {


    public static function process()
    {
        //$controller = new \Controllers\Article();
        //$controller->index();

        $controllerName= "Article";
        $task = "index";

        if(!empty($_GET['controller'])){
            $controllerName = ucfirst($_GET['controller']); //ucfirst 1ere lettre en Maj
        }

        if(!empty($_GET['task'])){
            $task = $_GET['task'];
        }

        $controllerName = "\Controllers\\". $controllerName;

        $controller = new $controllerName();
        $controller->$task();


    }


}