<?php

namespace Controllers;

require_once('librairies/utils.php');
require_once('librairies/controllers/Controller');
//Models
require_once('librairies/models/Comment.php');
require_once ('librairies/models/Article.php');

class Comment extends Controller {


    protected $modelName = \Models\Comment::class ;



    public function create()
    {

        $articleModel = new \Models\Article();

        $author = null;
        if (!empty($_POST['author'])) {
            $author = $_POST['author'];
        }

        $content = null;
        if (!empty($_POST['content'])) {
            // On fait quand même gaffe à ce que le gars n'essaye pas des balises cheloues dans son commentaire
            $content = htmlspecialchars($_POST['content']);
        }

        $article_id = null;
        if (!empty($_POST['article_id']) && ctype_digit($_POST['article_id'])) {
            $article_id = $_POST['article_id'];
        }

        // Vérification finale des infos envoyées dans le formulaire (donc dans le POST)
        // Si il n'y a pas d'auteur OU qu'il n'y a pas de contenu OU qu'il n'y a pas d'identifiant d'article
        if (!$author || !$article_id || !$content) {
            die("Votre formulaire a été mal rempli !");
        }



        $article = $articleModel->find($article_id);

        if (!$article) {
            die("Ho ! L'article $article_id n'existe pas boloss !");
        }

        $this->model->insert($author, $content,$article_id);

        redirect('article',$article_id);

    }





    public function delete()
    {


        if (empty($_GET['id']) || !ctype_digit($_GET['id'])) {
            die("Ho ! Fallait préciser le paramètre id en GET !");
        }

        $id = $_GET['id'];


        $commentaire= $this->model->find($id);

        if (!$commentaire) {
            die("Aucun commentaire n'a l'identifiant $id !");
        }


        $article_id = $commentaire['article_id'];

        $this->model->delete($id);


        redirect('article',$article_id);
    }





}