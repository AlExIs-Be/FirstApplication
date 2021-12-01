<?php

abstract class AbstractManager{

    private static $connexion;
    /**
     * Retourne une instance de PDO connectée à la base de donnée 'store'
     * @return PDO - un objet instance de PDO connecté à 'store'
     */
    protected static function connect(){
        self::$connexion = new PDO(
            "mysql:dbname=store;host=localhost:3306",
            "root",
            "",
            [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'
            ]
        );
    }
    /**
     * Permet l'exécution d'une requête sql
     * @param string $sql - une requête sql
     * @param NULL|array $params - des paramètres à lier dans la requête
     * @return FALSE|$stmt - si la requête echoue ou si elle réussit
     */
    protected static function executeQuery($sql, $params = NULL){
        $stmt = self::$connexion->prepare($sql);
        $stmt->execute($params);
        return $stmt;        
    }

    /**
     * récupère le dernier id entré en bdd
     * @return int $id 
     */
    protected function getLastInsertId(){
        return intval(self::$connexion->lastInsertId());
    }
}