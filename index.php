<?php
require_once('librairies/database.php');
require_once('librairies/utils.php');
//Models
require_once ('librairies/models/Article.php');
require_once ('librairies/models/User.php');


/**
 * CE FICHIER A POUR BUT D'AFFICHER LA PAGE D'ACCUEIL !
 */

$model = new  Article();

$userModel = new User();

$users = $userModel->findAll();

//var_dump($users); die();


/**
 * 2. Récupération des articles
 */

$articles = $model->findAll(" created_at DESC");


/**
 * 3. Affichage
 */
$pageTitle = "Accueil";


render('articles/index', compact( 'pageTitle','articles'));
