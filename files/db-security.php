<?php

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
 * 
 * @param string $username - nom d'utilisateur de la personne recherchée
 * @param string $email - email de la personne recherchée
 * @return false|datafound si personne n'est trouvé renvoie false ou la personne associée
 */
function findByUsernameOrEmail($username, $email){
    $db = connexion();
    $sql = "SELECT * FROM users WHERE mail = :email OR username = :username";
    $stmt = $db->prepare($sql);
    $stmt ->execute([
        ":username" => $username,
        ":email" => $email
    ]);
    return $stmt->fetch();
}

/**
     * Permet d'insérer un utilisateur en base de donnée
     * @param string $username - nom de l'utilisateur
     * @param string $email - email de l'utilisateur
     * @param string $hash - mdp de l'utilisateur hashé
     * @return bool  - true si réussi | false si email ou username déjà présent
     */
    function insertUser($username, $email, $hash){
        $sql = "INSERT INTO users (username, mail, password) VALUES (:username, :mail, :password)";
        $dtb = connexion();
        if($stmt = $dtb->prepare($sql)){
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":mail", $email);
            $stmt->bindParam(":password", $hash);
            $stmt->execute(); 
        }
    };