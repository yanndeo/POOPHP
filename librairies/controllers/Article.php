<?php

namespace Controllers;

require_once('librairies/utils.php');



    class Article extends Controller
    {

       protected $modelName = "\Models\Article";



        public function index()
        {

            $articles = $this->model->findAll(" created_at DESC");

            $pageTitle = "Accueil";

            render('articles/index', compact( 'pageTitle','articles'));

        }







        public function show()
        {
            $commentModel = new \Models\Comment();


            $article_id = null;

            // Mais si il y'en a un et que c'est un nombre entier, alors c'est cool
            if (!empty($_GET['id']) && ctype_digit($_GET['id'])) {
                $article_id = $_GET['id'];
            }

            // On peut désormais décider : erreur ou pas ?!
            if (!$article_id) {
                die("Vous devez préciser un paramètre `id` dans l'URL !");
            }


            $article = $this->model->find($article_id);

            $commentaires =$commentModel->findAllCommentsByArticle($article_id);

            $pageTitle = $article['title'];


            render('articles/show', compact(
                'pageTitle',
                'article',
                'commentaires',
                'article_id'));

        }










        public function delete()
        {


            if (empty($_GET['id']) || !ctype_digit($_GET['id'])) {
                die("Ho ?! Tu n'as pas précisé l'id de l'article !");
            }

            $id = $_GET['id'];

            $artile =$this->model->find($id);

            if (!$artile) {
                die("L'article $id n'existe pas, vous ne pouvez donc pas le supprimer !");
            }


            $this->model->delete($id);

            redirect('index');

        }



    }