<?php

session_start();

if(isset($_SESSION["products"])){
    $nb = 0;
    foreach($_SESSION["products"] as $index => $product){
        $nb += $product["qtt"];
    }
}