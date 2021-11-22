<?php
    session_start();
    include "files/functions.php";
    include "files/db-functions.php";
    $id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
    $tableId = [];
    $action = "newProd";
    $name = "";
    $desc = "";
    $price = "";
    $img = "";
    $value = "Ajouter";
    $products = findAll();
    $affich = "<table><thead><tr><th>Image</th><th>Nom</th><th>Prix</th><th></th></tr></thead><tbody>";
    foreach($products as $product){
        $tableId[] = $product["id"];
        $affich .= "<tr><td><img src='".$product["image"]."'></td><td>".$product["name"]."</td><td>".$product["price"]."&nbsp;&euro;</td>";
        $affich .= "<td><a href='#' class='fas fa-trash' onclick='confirmDelete(event,".$product["name"].")'></a>";
        $affich .= "<a href='admin.php?id=".$product["id"]."' class='fas fa-pen'></a></td></tr>";
    }
    $affich .= "</tbody></table>";
    if(isset($id) && in_array($id, $tableId)){
        $product = findOneById($id);
        $action = "updateProd";
        $name = $product["name"];
        $desc = $product["description"];
        $price = $product["price"];
        $img = $product["image"];
        $value = "Editer";
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="files/style.css">
    <title>Interface Administrateur</title>
</head>
<body>
    <div class="wrapper">
        <?php 
        include "files/menu.php";
        ?>
        <div class="splitscreen">
        <section class="addProduct">
            <h1><?=$value?> un produit</h1>
            <form action="traitement.php?action=<?=$action?>&id=<?=$id?>" method="post">
                <p>
                    <label>
                        Nom du produit :
                        <input type="text" name="name" value="<?=$name?>">
                    </label>
                </p>
                <p>
                    <label>
                        Description :
                        <textarea rows=15 cols=30 name="desc"><?=$desc?></textarea>
                    </label>
                </p>
                <p>
                    <label>
                        Prix du produit :
                        <input type="number" name="price" step="0.01" value="<?=$price?>">
                    </label>
                </p>
                <p>
                    <label>
                        Lien d'image :
                        <input type="text" name="img" value="<?=$img?>">
                    </label>
                </p>
                <p>
                    <input type="submit" name="submit" value="<?=$value?> le produit">
                </p>
            </form>
        </section>
        <section class=delProduct>
            <h1>Retirer un produit (définitivement)</h1>
            <?=$affich ?>
        </section>
        </div>
        <div class="modal">
            <h4>Attention !!</h4>
            <p>Vous êtes sur le point de supprimer définitivement le produit <span class="prodName"></span>. Êtes-vous sûr ?</p>
            <a class ="modal-action-confirm" href="">Confirmer</a>
            <a class ="modal-action-cancel" href="#">Annuler</a>
        </div>
        <?php
        include "files/footer.php"
        ?>
    </div>
    <script src="files/script.js"></script>
</body>
</html>