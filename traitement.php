<?php

    session_start();
    include "files/functions.php";
    include "files/db-functions.php";

    $action = filter_input(INPUT_GET, "action", FILTER_VALIDATE_REGEXP, [
        "options" => [
            "regexp" => "/newProd|updateProd|addProd|emptyAll|suppr|qtt|delete/"
        ]
    ]);

    if($action){

        switch($action){

            case "newProd":
                if(isset($_POST["submit"])){
    
                    $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
                    $desc = filter_input(INPUT_POST, "desc", FILTER_SANITIZE_STRING);
                    $img = filter_input(INPUT_POST, "img", FILTER_VALIDATE_URL);
                    $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT, [
                            "options" => [
                                "min_range" => 0
                            ],
                            "flags" => FILTER_FLAG_ALLOW_FRACTION
                        ]);
                    if($name && $desc && $price && $img){
                        $id = insertProduct($name, $desc, $price, $img);

                        $_SESSION["message"]["success"] = "$name ajouté avec succès à la boutique";
                        header("Location:product.php?id=$id");
                        die;
                    }elseif(!$name){
                        $_SESSION["message"]["failure"] = "Il faut renseigner un produit.";
                    }elseif(!$price){
                        $_SESSION["message"]["failure"] = "Le produit choisi doit avoir un prix (positif).";
                    }elseif(!$desc){
                        $_SESSION["message"]["failure"] = "Il faut mettre une description.";
                    }
                }else{
                    $_SESSION["message"]["failure"] = "Tu n'es pas allé traiter par le formulaire !";
                }
                break;
            case "updateProd":
                $id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
                $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
                $desc = filter_input(INPUT_POST, "desc", FILTER_SANITIZE_STRING);
                $img = filter_input(INPUT_POST, "img", FILTER_VALIDATE_URL);
                $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT, [
                        "options" => [
                            "min_range" => 0
                            ],
                            "flags" => FILTER_FLAG_ALLOW_FRACTION
                        ]);
                $prod = [$name, $desc, $price, $img];
                if($id){
                    updateProduct($id, $prod);
                    $_SESSION["message"]["success"] = "Produit $name modifié avec succès.";
                }else{
                    $_SESSION["message"]["failure"] = "ce produit n'existe pas.";
                }
                header("Location:admin.php");
                die;
                break;
            case "addProd":
                $id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
                
                if($id){
                    if( !$_SESSION['products'][$id] ){
                        $product = findOneById($id);
                        $product["qtt"]  = 1;
            
                        $_SESSION['products'][$id] = $product;
                        
                    }else{
                        $_SESSION['products'][$id]["qtt"] ++;
                    }
                    $_SESSION["message"]["success"] = $_SESSION["products"][$id]["name"]." a bien été ajouté au panier.";
                }else{
                    $_SESSION["message"]["failure"] = "Le produit n'existe pas.";
                }
                header("Location:index.php");
                die;
                break;
            
            case "emptyAll":
                if(isset($_SESSION["products"])){
                    unset($_SESSION["products"]);
                    $_SESSION["message"]["success"] = "Votre panier a bien été supprimé.";
                }else{
                    $_SESSION["message"]["failure"] = "Votre panier est déjà vide !";
                }
                header("Location:recap.php");
                die;
                break;

            case "suppr":
                $id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
                if(isset($_SESSION['products'][$id])){
                    $_SESSION["message"]["success"] = $_SESSION["products"][$id]["name"]." a bien été supprimé du panier.";
                    unset($_SESSION["products"][$id]);
                    header("Location:recap.php");
                    die;
                }else{
                    $_SESSION["message"]["failure"] = "le produit n'existe pas.";
                }
                break;
            
            case "qtt":
                $id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
                $add = filter_input(INPUT_GET, "add", FILTER_VALIDATE_REGEXP, [
                    "options" => [
                        "regexp" => "/true|false/"
                        ]
                    ]);
                    echo $add;
                if(isset($add)){
                    switch($add){
                        case "true":
                            $_SESSION["products"][$id]["qtt"] ++;
                            break;
                        case "false":
                            $_SESSION["products"][$id]["qtt"] --;
                            if($_SESSION["products"][$id]["qtt"] == 0){
                                $_SESSION["message"]["success"] = $_SESSION["products"][$id]["name"]." a bien été supprimé du panier.";
                                unset($_SESSION["products"][$id]);
                            }
                            break;
                    }
                    header("Location:recap.php");
                    die;
                }else{
                    $_SESSION["message"]["failure"] = "Tu n'es pas sensé toucher à ça !";
                }
                break;
            
            case "delete":
                $id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
                $products = findAll();
                $tableId = [];
                foreach($products as $product){
                    $tableId[] = $product["id"];
                }
                if( isset($id) && in_array($id, $tableId)){
                    $_SESSION["message"]["success"] = $_SESSION["products"][$id]["name"]." a bien été supprimé de la boutique.";
                    deleteProduct($id);
                    header("Location:admin.php");
                    die;
                }else{
                    $_SESSION["message"]["failure"] = "Tu n'es pas sensé toucher à ça !";
                }
        }
    }
 
    header("Location:index.php");