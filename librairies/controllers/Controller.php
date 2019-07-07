<?php


namespace Controllers;

require_once('librairies/autoload.php');


abstract class Controller
{


    protected $model;

    protected $modelName;


    public function __construct()
    {
        $this->model = new $this->modelName();

    }


}