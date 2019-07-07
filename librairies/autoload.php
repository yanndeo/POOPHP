<?php


spl_autoload_register(function ($className){

    $className =str_replace("\\", "/", $className);

    //className= Controllers\Article
    //require = librairies/Controllers/Article.php
    require_once("librairies/$className.php");

});