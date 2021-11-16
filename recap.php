<?php
    session_start();
    include "files/function.php"
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="files/style.css">
    <title>Récapitulatif des produits</title>
</head>
<body>
    <div class="wrapper">
        <?php 
            include "files/menu.php";
        ?>
        <section id="recap">
            <form id="trash" action="traitement.php" method="post">
                <button type="submit" name="emptyAll" class='fas fa-trash'></button>
            </form>
            <h1>Récapitulatif de votre commande</h1>
            <?php
                if(!isset($_SESSION["products"]) || empty($_SESSION["products"])){
                    echo "<p>Aucun produit dans votre panier pour le moment.</p>";
                }
                else{
                    echo "<div class='tablecontainer'><table><thead><tr>",
                            "<th></th>",
                            "<th>Nom</th>",
                            "<th>Prix</th>",
                            "<th>Quantité</th>",
                            "<th>Total</th>",
                        "</tr></thead><tbody>";
                    $totalGeneral = 0;
                    foreach($_SESSION["products"] as $index => $product){
                        echo "<tr>",
                                "<td><a href='traitement.php?suppr=".$index."' class='fas fa-trash'></a></td>",
                                "<td>".$product["name"]."</td>",
                                "<td>".number_format($product["price"], 2, ",", "&nbsp;")."&nbsp;&euro;</td>",
                                "<td>
                                    <a href='traitement.php?add=false&amp;ind=".$index."' class='fas fa-minus-square'></a>"
                                    .$product["qtt"].
                                    "<a href='traitement.php?add=true&amp;ind=".$index."' class='fas fa-plus-square'></a>
                                </td>",
                                "<td>".number_format($product["price"]*$product["qtt"], 2, ",", "&nbsp;")."&nbsp;&euro;</td>",
                            "</tr>";
                        $totalGeneral += $product["price"]*$product["qtt"];
                    }
                    echo "<tr>",
                            "<td colspan=3><strong>Total général : </strong></td>",
                            "<td>".countProducts()."</td>",
                            "<td><strong>".number_format($totalGeneral, 2, ",", "&nbsp;")."&nbsp;&euro;</strong></td>",
                        "</tr>",
                        "</tbody></table></div>";
                }
            ?>
        </section>
        <?php
        include "files/footer.php"
        ?>
    </div>
    <script src="files/script.js"></script>
</body>
</html>