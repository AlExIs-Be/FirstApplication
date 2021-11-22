<?php
    /**
     * Retourne une instance de PDO connectée à la base de donnée 'store'
     * @return PDO - un objet instance de PDO connecté à 'store'
     */
    function connexion(){
        return new PDO(
            "mysql:dbname=store;host=localhost:3306",
            "root",
            "",
            [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'
            ]
        );
    };
    /**
     * Retourne l'ensemble de la base de données
     * @return array - tableau des données de la base
     */
    function findAll(){
        $sql = "SELECT * FROM products";
        $stmt = connexion()->query($sql);
        return $stmt->fetchAll();
    };
    /**
     * Permet de retrouver un objet de la base de donnée par son identifiant
     * @param $id - identifiant de l'objet
     * @return array - ensemble des valeurs de l'objet sous forme nom_colonne=>valeur
     */
    function findOneById($id){
        $sql = "SELECT * FROM products WHERE id = :id";
        $stmt = connexion()->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch();
    };
    /**
     * Permet d'insérer un produit en base de donnée
     * @param string $name - nom du produit
     * @param string $desc - description du produit
     * @param float|int $price - prix du produit
     * @param string $img - lien d'une image
     * @return int - identifiant du produit inséré dans la base
     */
    function insertProduct($name, $desc, $price, $img){
        $sql = "INSERT INTO products (name, description, price, image) VALUES (:name, :desc, :price, :img)";
        $dtb = connexion();
        $stmt = $dtb->prepare($sql);
        $name = ucfirst(mb_strtolower($name));
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":desc", $desc);
        $stmt->bindParam(":price", $price);
        $stmt->bindParam(":img", $img);
        $stmt->execute();
        $id = $dtb->lastInsertId();
        return $id;
    };
    /**
     * Permet de supprimer une ligne de la base de donnée à partir de son identifiant
     * @param int $id - identifiant de la ligne àsupprimer
     */
    function deleteProduct($id){
        $sql = "DELETE FROM products WHERE id= :id";
        $stmt = connexion()->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
    }
    /**
     * Permet de changer la valeur d'une colonne pour une entrée de la base de donnée
     * @param $id - identifiant de la ligne
     * @param $prod - tableau des valeurs à modifier dans l'ordre [nom, description, prix, image]
     */
    function updateProduct($id, $prod){
        $name = $prod[0];
        $desc = $prod[1];
        $price = $prod[2];
        $img = $prod[3];
        $sql = "UPDATE products 
        SET name = :name, description = :desc, price = :price, image = :img 
        WHERE id = :id";
        $stmt = connexion()->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":desc", $desc);
        $stmt->bindParam(":price", $price);
        $stmt->bindParam(":img", $img);
        $stmt->execute();
    }