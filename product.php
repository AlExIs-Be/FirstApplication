<?php
    session_start();

    include "files/db-functions.php";
    include "files/functions.php";

    $affich = "<div class='product full'>";
    if( isset($_GET["id"]) ){
        $id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
        if( $product = findOneById($id)){
            $affich .= "<h3>".$product["name"]."</h3>";
            $affich .= "<div class='imgDescr'><figure><img class='img full' src='".$product["image"]."' alt='image de ".$product["name"]."'></figure>";
            $affich .= "<div class='desc'><p>".$product["description"]."</p>";
            $affich .= "<p class='price'>".$product["price"]."&nbsp;&euro; ";
            $affich .= "<a href='traitement.php?action=addProd&id=$id'> Ajouter au panier</a></p></div></div>";
        }else{

            $_SESSION["message"]["failure"] = "impossible";
            header("index.php");
        }
    }else{
        $_SESSION["message"]["success"] = "impossible";
        header("index.php");
    }
    $affich .= "</div>";
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="files/style.css">
    <title><?=$product["name"]?></title>
</head>
<body>
    <div class="wrapper">
        <?php include "files/menu.php"; ?>
        <?=$affich?>
        <?php include "files/footer.php"?>
    </div>
    <script src="files/script.js"></script>
</body>
</html>