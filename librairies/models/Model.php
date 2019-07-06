<?php

require_once('librairies/database.php');


abstract class Model {

    protected $pdo; //protected: Réserver à moi et mes enfants

    protected  $table ;

    public function __construct()
    {

        $this->pdo = getPDO();
    }




    /**
     * Retourne la liste des article rangée dans lo'ordre decroissant
     * @return array
     */
    public function findAll(?string $order = "" ):array
    {

        $sql = "SELECT * FROM {$this->table}";

        if($order){
            $sql .= " ORDER BY" . $order;   // created_at DESC par exemple
        }

        //On utilisera ici la méthode query (pas besoin de préparation car aucune variable n'entre en jeu)
        $resultats = $this->pdo->query($sql);

        // On fouille le résultat pour en extraire les données réelles
        $items = $resultats->fetchAll();

        return $items;
    }





    /**
     * @param int $id
     * @return mixed
     */
    public function find(int $id) {

        $query = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE id = :id");

        // On exécute la requête en précisant le paramètre :id
        $query->execute(['id' => $id]);

        // On fouille le résultat pour en extraire les données réelles de l'article
        $item = $query->fetch();

        return $item;
    }



    /**
     * @param int $id
     */
    public function delete(int $id):void{

        $query = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id = :id");
        $query->execute(['id' => $id]);
    }



}