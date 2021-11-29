<?php
require_once "model/AbstractManager.php";

class ProductManager extends AbstractManager{

    public function __construct(){
        parent::connect();
    }
     /**
     * Retourne l'ensemble des produits de la base de données
     * @return array - tableau des produits de la base
     */
    public function findAll(){
        $stmt = $this->executeQuery(
            "SELECT * FROM products"
        );
        return $stmt->fetchAll();
    }
    /**
     * Permet de retrouver un objet de la base de donnée par son identifiant
     * @param $id - identifiant de l'objet
     * @return array - ensemble des valeurs de l'objet sous forme nom_colonne=>valeur
     */
    public function findOneById($id){
        $stmt = $this->executeQuery(
            "SELECT * FROM products WHERE id = :id",
            [
                ":id" => $id
            ]
        );
        return $stmt->fetch();
    }
    /**
     * Permet d'insérer un produit en base de donnée
     * @param string $name - nom du produit
     * @param string $desc - description du produit
     * @param float|int $price - prix du produit
     * @param string $img - lien d'une image
     * @return int - identifiant du produit inséré dans la base
     */
    public function insertProduct($name, $desc, $price, $img){
        $this->executeQuery(
            "INSERT INTO products (name, description, price, image) VALUES (:name, :desc, :price, :img)",
            [
                ":name" => $name,
                ":desc" => $desc,
                ":price" => $price,
                ":img" => $img,
            ]
        );
        return $this->getLastInsertId();
    }
    /**
     * Permet de supprimer une ligne de la base de donnée à partir de son identifiant
     * @param int $id - identifiant de la ligne àsupprimer
     */
    public function deleteProduct($id){
        $this->executeQuery(
            "DELETE FROM products WHERE id= :id",
            [
                ":id" => $id
            ]
        );
    }
    /**
     * Permet de changer la valeur d'une colonne pour une entrée de la base de donnée
     * @param $id - identifiant de la ligne
     * @param $prod - tableau des valeurs à modifier dans l'ordre [nom, description, prix, image]
     */
    public function updateProduct($id, $prod){
        $name = $prod[0];
        $desc = $prod[1];
        $price = $prod[2];
        $img = $prod[3];
        $this->executeQuery(
            "UPDATE products 
            SET name = :name, description = :desc, price = :price, image = :img 
            WHERE id = :id",
            [
                ":id" => $id,
                ":name" => $name,
                ":desc" => $desc,
                ":price" => $price,
                ":img" => $img
            ]
        );
    }
}
   