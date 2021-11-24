<?php
    session_start();
    include "functions.php";
    include "db-security.php";

    $action = filter_input(INPUT_GET, "action", FILTER_VALIDATE_REGEXP, [
        "options" => [
            "regexp" => "/login|register|logout/"
        ]
    ]);

    if($action){

        switch($action){
            case "login":
                if( isset($_POST["submit"])){
                    $credentials = filter_input(INPUT_POST, "credentials", FILTER_SANITIZE_STRING);
                    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);
                    if($credentials && $password){
                        if(($user = findByUsernameOrEmail($credentials, $credentials)) && password_verify($password, $user['password'])){
                                $_SESSION['user'] = $user;
                                $_SESSION["message"]["success"] = "Bienvenue ".$name = ucfirst($user["username"])." !";
                                header("Location:../index.php");
                                die;
                        }else $_SESSION["message"]["failure"] = "Mauvais identifiant ou mot de passe, réessayez !" ;
                    }else $_SESSION["message"]["failure"] = "Tous les champs doivent être remplis !";
                }
                header("Location: ../login.php");
                die;
                break;
            case "register":
                if( isset($_POST["submit"])){
                    $username = filter_input(INPUT_POST, "username", FILTER_VALIDATE_REGEXP, [
                        "options" => [
                            "regexp" => "/^[a-zA-Z0-9]{6,50}$/"
                            ]
                        ]);

                    $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
                    $pass1 = filter_input(INPUT_POST, "pass1", FILTER_VALIDATE_REGEXP, [
                        "options" => [
                            "regexp" => "/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/"
                            ]
                        ]);
                    $pass2 = filter_input(INPUT_POST, "pass2", FILTER_DEFAULT);

                    if($username && $email && $pass1){
                        if($pass1 === $pass2){
                            if(!findByUsernameOrEmail($username, $email)){
                                $hash = password_hash($pass1, PASSWORD_ARGON2ID);
                                if( insertUser($username, $email, $hash) ){
                                    $_SESSION["message"]["success"] = "Vous avez bien été enregistré $username.";
                                    header("Location : ../login.php");
                                    die;
                                };
                            }else{
                                $_SESSION["message"]["failure"] = "il y a déjà un compte avec ce pseudo ou cette adresse.";
                            }
                        }else{
                            $_SESSION["message"]["failure"] = "Les mots de passe ne correspondent pas.";
                        }
                    }else{
                        $_SESSION["message"]["failure"] = "Problème de remplissage du formulaire d'inscription.";
                    }
                }
                header("Location : ../register.php");
                die;
                break;
            case "logout":
                unset($_SESSION["user"]);
                $_SESSION["message"]["success"] = "Vous avez bien été déconnecté. A bientôt !";
                break;
            }
    }

    header("Location:../index.php");