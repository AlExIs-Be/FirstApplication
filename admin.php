<?php
    session_start();
    include "files/functions.php";
    include "files/db-functions.php";
    $products = findAll();
    $affich = "<table><thead><tr><th>Nom</th><th>Prix</th><th></th></tr></thead><tbody>";
    foreach($products as $product){
        $affich .= "<tr><td><img src='".$product["image"]."'></td><td>".$product["name"]."</td><td>".$product["price"]."&nbsp;&euro;</td>";
        $affich .= "<td><a href='traitement.php?action=delete&id=".$product["id"]."' class='fas fa-trash'></a></td></tr>";
    }
    $affich .= "</tbody></table>";
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="files/style.css">
    <title>Ajout de produits</title>
</head>
<body>
    <div class="wrapper">
        <?php 
        include "files/menu.php";
        ?>
        <div class="splitscreen">
        <section class="addProduct">
            <h1>Ajouter un produit</h1>
            <form action="traitement.php?action=newProd" method="post">
                <p>
                    <label>
                        Nom du produit :
                        <input type="text" name="name">
                    </label>
                </p>
                <p>
                    <label>
                        Description :
                        <textarea rows=4 cols=30 name="desc"></textarea>
                    </label>
                </p>
                <p>
                    <label>
                        Prix du produit : 
                        <input type="number" name="price" step="0.01">
                    </label>
                </p>
                <p>
                    <label>
                        Lien d'image :
                        <input type="text" name="img">
                    </label>
                </p>
                <p>
                    <input type="submit" name="submit" value="Ajouter le produit">
                </p>
            </form>
        </section>
        <section class=delProduct>
            <h1>Retirer un produit (définitivement)</h1>
            <?=$affich ?>
        </section>
        </div>
        <?php
        include "files/footer.php"
        ?>
    </div>
    <script src="files/script.js"></script>
</body>
</html>