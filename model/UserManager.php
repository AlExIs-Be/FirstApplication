<?php
require_once "model/AbstractManager.php";

class UserManager extends AbstractManager{
    public function __construct(){
        parent::connect();
    }
     /**
     * Retourne l'ensemble de la base de données
     * @return array - tableau des données de la base
     */
    public function findAll(){
        $stmt = $this->executeQuery(
            "SELECT * FROM users"
        );
        return $stmt->fetchAll();
    }
    /**
     * 
     * @param string $username - nom d'utilisateur de la personne recherchée
     * @param string $email - email de la personne recherchée
     * @return false|datafound si personne n'est trouvé renvoie false ou la personne associée
     */
    public function findByUsernameOrEmail($username, $email){
        $stmt = $this->executeQuery(
            "SELECT * FROM users WHERE mail = :email OR username = :username",
            [
                ":username" => $username,
                ":email" => $email
            ]
        );
        return $stmt->fetch();
    }

    /**
     * Permet d'insérer un utilisateur en base de donnée
     * @param string $username - nom de l'utilisateur
     * @param string $email - email de l'utilisateur
     * @param string $hash - mdp de l'utilisateur hashé
     * @return bool  - true si réussi | false si email ou username déjà présent
     */
    public function insertUser($username, $email, $hash){
        return $this->executeQuery(
            "INSERT INTO users (username, mail, password) VALUES (:username, :mail, :password)",
            [
                ":username" => $username,
                ":mail" => $email,
                ":password" => $hash
            ]
        );
    }
}