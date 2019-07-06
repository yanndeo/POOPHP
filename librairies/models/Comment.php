<?php

namespace Models;


require_once('librairies/models/Model.php');



class Comment extends Model
{

    protected $table = "comments"; // on a reecrit la propriete $table de la class Model


    /**
     * @param int $article_id
     * @return array
     */
    public function findAllCommentsByArticle(int $article_id):array
    {


        $query = $this->pdo->prepare("SELECT * FROM comments WHERE article_id = :article_id"); //2 -Creer une requequete

        $query->execute(['article_id' => $article_id]);  //3 -Execute cette requete

        $commentaires = $query->fetchAll();   //4- Recupere les commentatires

        return $commentaires;               //5-  Renvoie les commentaires
    }


    /**
     * @param string $author
     * @param string $content
     * @param int $article_id
     */
    public function insert(string $author, string $content, int $article_id):void
    {

        $query = $this->pdo->prepare('INSERT INTO comments SET author = :author, content = :content, article_id = :article_id, created_at = NOW()');

        $query->execute(compact('author', 'content', 'article_id'));
    }









}

