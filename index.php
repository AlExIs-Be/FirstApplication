<?php
    session_start();
    include "files/db-functions.php";
    include "files/functions.php";
    $products = findAll();
    $affich = "<div class='store'>";
    foreach($products as $product){
        $id = $product["id"];
        $affich .= "<div class='product'>";
        $affich .= "<h4><a href='product.php?id=$id'>".$product["name"]."</a></h4>";
        $affich .= "<figure class='mini'><a href='product.php?id=$id'><img src='".$product["image"]."' alt='image de ".$product["name"]."'></a></figure>";
        $affich .= "<p>".mb_strimwidth($product["description"], 0, 50, "...")."</p>";
        $affich .= "<p class='price'>".$product["price"]."&nbsp;&euro; ";
        $affich .= "<a href='traitement.php?action=addProd&id=$id'>Ajouter&nbsp;au&nbsp;panier</a></p>";
        $affich .= "</div>";
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
    <title>Accueil</title>
</head>
<body>
    <div class="wrapper">
        <?php            
            include "files/menu.php";
        ?>
        <?=$affich?>
        <?php
        include "files/footer.php"
        ?>
    </div>
    <script src="files/script.js"></script>
</body>
</html> 