<section class="recap">

    <h1>Récapitulatif de votre commande</h1>
    <?php
        if(!isset($_SESSION["products"]) || empty($_SESSION["products"])){
            echo "<p>Aucun produit dans votre panier pour le moment.</p>";
        }
        else{
            echo "<div class='tablecontainer'><table><thead><tr>",
                    "<th></th>",
                    "<th>Image</th>",
                    "<th>Nom</th>",
                    "<th>Prix</th>",
                    "<th>Quantité</th>",
                    "<th>Total</th>",
                "</tr></thead><tbody>";
            $totalGeneral = 0;
            foreach($_SESSION["products"] as $index => $product){
                echo "<tr>",
                        "<td><a href='traitement.php?action=suppr&id=".$index."' class='fas fa-trash'></a></td>",
                        "<td><img src='".$product["image"]."'></td>",
                        "<td>".$product["name"]."</td>",
                        "<td>".number_format($product["price"], 2, ",", "&nbsp;")."&nbsp;&euro;</td>",
                        "<td>
                            <a href='traitement.php?action=qtt&amp;add=false&amp;id=".$index."' class='fas fa-minus-square'></a>"
                            .$product["qtt"].
                            "<a href='traitement.php?action=qtt&amp;add=true&amp;id=".$index."' class='fas fa-plus-square'></a>
                        </td>",
                        "<td>".number_format($product["price"]*$product["qtt"], 2, ",", "&nbsp;")."&nbsp;&euro;</td>",
                    "</tr>";
                $totalGeneral += $product["price"]*$product["qtt"];
            }
            echo "<tr>",
                    "<td colspan=4><strong>Total général : </strong></td>",
                    "<td>".countProducts()."</td>",
                    "<td><strong>".number_format($totalGeneral, 2, ",", "&nbsp;")."&nbsp;&euro;</strong></td>",
                "</tr>",
                "</tbody></table></div>";
                echo "<a href='traitement.php?action=emptyAll' class='trash fas fa-trash'> Vider le panier</a>";
        }
        
    ?>
</section>
        