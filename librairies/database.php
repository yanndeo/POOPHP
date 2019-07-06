<?php




/**
 * 2. Connexion à la base de données avec PDO
 * Attention, on précise ici deux options :
 * - Le mode d'erreur : le mode exception permet à PDO de nous prévenir violament quand on fait une connerie ;-)
 * - Le mode d'exploitation : FETCH_ASSOC veut dire qu'on exploitera les données sous la forme de tableaux associatifs.
 *
 * Retourne la connexion à la BD
 * @return PDO
 **/
function getPDO(): PDO
{

    $dsn = 'mysql:dbname=blogpoo;host=127.0.0.1';
    $user = 'root';
    $password = 'root';

    $pdo = new PDO($dsn, $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);

    return $pdo;

}





/**
 * Retourne la liste des article rangée dans lo'ordre decroissant
 * @return array
 */
function findAllArticles():array {

    $pdo = getPDO();

    //On utilisera ici la méthode query (pas besoin de préparation car aucune variable n'entre en jeu)
    $resultats = $pdo->query('SELECT * FROM articles ORDER BY created_at DESC');

    // On fouille le résultat pour en extraire les données réelles
    $articles = $resultats->fetchAll();

    return $articles;
}





/**
 * @param int $id
 * @return mixed
 */
function findArticle(int $id) {

    $pdo = getPDO();

    $query = $pdo->prepare("SELECT * FROM articles WHERE id = :article_id");

    // On exécute la requête en précisant le paramètre :article_id
    $query->execute(['article_id' => $id]);

    // On fouille le résultat pour en extraire les données réelles de l'article
    $article = $query->fetch();


    return $article;
}


/**
 * @param int $id
 * @return array
 */
function findAllCommentsByArticle(int $article_id):array {

    $pdo = getPDO();   //1- connection à la BD

    $query = $pdo->prepare("SELECT * FROM comments WHERE article_id = :article_id"); //2 -Creer une requequete

    $query->execute(['article_id' => $article_id]);  //3 -Execute cette requete

    $commentaires = $query->fetchAll();   //4- Recupere les commentatires

    return $commentaires;               //5-  Renvoie les commentaires
}




/**
 * @param int $id
 */
function deleteAticle(int $id):void{
    $pdo = getPDO();
    $query = $pdo->prepare('DELETE FROM articles WHERE id = :id');
    $query->execute(['id' => $id]);
}



/**
 * @param int $id
 * @return mixed
 */
function findComment(int $id) {
    $pdo = getPDO();

    $query = $pdo->prepare('SELECT * FROM comments WHERE id = :id');
    $query->execute(['id' => $id]);
    $commentaire = $query->fetch();

    return $commentaire;

}


/**
 * @param int $id
 */
function deleteComment(int $id):void{
    $pdo = getPDO();

    $query = $pdo->prepare('DELETE FROM comments WHERE id = :id');
    $query->execute(['id' => $id]);
}