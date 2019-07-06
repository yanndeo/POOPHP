<?php

require_once('librairies/controllers/Article.php');

/**
 * Se fichier à pour but d'afficher la page d'accueil
 */



$controller = new \Controllers\Article();
$controller->index();
