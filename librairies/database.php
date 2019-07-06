<?php




/**
 *  Connexion à la base de données avec PDO
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











