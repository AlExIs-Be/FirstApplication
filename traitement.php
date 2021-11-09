<?php

session_start();
if(isset($_POST["submit"])){
    
    $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
    $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT, [
            "options" => [
                "min_range" => 0
            ],
            "flags" => FILTER_FLAG_ALLOW_FRACTION
        ]);
    $qtt = filter_input(INPUT_POST, "qtt", FILTER_VALIDATE_INT, [
            "options" =>[
                "min_range" => 1
            ]]);

    if( $name && $price && $qtt){
        $product = [
            "name" => $name,
            "price" => $price,
            "qtt" => $qtt,
        ];

        $_SESSION["products"][] = $product;
        $_SESSION["message"]["success"] = ucfirst(strtolower($name))." a bien été ajouté au panier ".$qtt." fois";
    
    }elseif(!$name){
        $_SESSION["message"]["failure"] = "Il faut renseigner un produit.";
    }elseif(!$price){
        $_SESSION["message"]["failure"] = "Le produit choisi doit avoir un prix (positif).";
    }elseif(!$qtt){
        $_SESSION["message"]["failure"] = "Il faut au moins 1 item.";
    }

    header("Location:index.php");
    die;

}elseif(isset($_POST["emptyAll"])){
    if(isset($_SESSION["products"])){
        unset($_SESSION["products"]);
        $_SESSION["message"]["success"] = "Votre panier a bien été supprimé.";
    }else{
        $_SESSION["message"]["failure"] = "Votre panier est déjà vide !";
    }
    header("Location:recap.php");
    die;

}elseif(isset($_GET["suppr"])){
    $_SESSION["message"]["success"] = $_SESSION["products"][$_GET["suppr"]]["name"]." a bien été supprimé du panier.";
    unset($_SESSION["products"][$_GET["suppr"]]);
    header("Location:recap.php");
    die;
}elseif(isset($_GET["add"])){
    if($_GET["add"]=="true"){
        $_SESSION["products"][$_GET["ind"]]["qtt"] += 1;
    }elseif($_GET["add"]=="false"){
        $_SESSION["products"][$_GET["ind"]]["qtt"] -= 1;
    }
    header("Location:recap.php");
    die;
}

header("Location:index.php");