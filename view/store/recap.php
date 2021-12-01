<?php
    $products = array_key_exists("products", $response["data"]) ? $response["data"]["products"] : null;
?>
<section class="recap">

    <h1>Récapitulatif de votre commande</h1>
    <?php
        if(!$products){
            ?>
            <p>Aucun produit dans votre panier pour le moment.</p>
            <?php
        }
        else{
            ?>
            <div class='tablecontainer'>
                <table>
                    <thead>
                        <tr>
                            <th></th>
                            <th>Image</th>
                            <th>Nom</th>
                            <th>Prix</th>
                            <th>Quantité</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $totalGeneral = 0;
                            $nb = 0;
                            foreach($products as $index => $product){
                                ?>
                                <tr>
                                    <td><a href='?ctrl=cart&action=suppr&id=<?=$index?>' class='fas fa-trash'></a></td>
                                    <td><img src='<?=$product["image"]?>'></td>
                                    <td><?=$product["name"]?></td>
                                    <td><?=number_format($product["price"], 2, ",", "&nbsp;")?>&nbsp;&euro;</td>
                                    <td>
                                        <a href='?ctrl=cart&action=qttminus&id=<?=$index?>' class='fas fa-minus-square'></a>
                                        <?=$product["qtt"]?>
                                        <a href='?ctrl=cart&action=qttplus&id=<?=$index?>' class='fas fa-plus-square'></a>
                                    </td>
                                    <td><?=number_format($product["price"]*$product["qtt"], 2, ",", "&nbsp;")?>&nbsp;&euro;</td>
                                </tr>
                                <?php
                                    $totalGeneral += $product["price"]*$product["qtt"];
                                    $nb += $product["qtt"];
                            }
                            ?>
                        <tr>
                            <td colspan=4><strong>Total général : </strong></td>
                            <td><?=$nb?></td>
                            <td><strong><?=number_format($totalGeneral, 2, ",", "&nbsp;")?>&nbsp;&euro;</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <a href='?ctrl=cart&action=emptyAll' class='trash fas fa-trash'> Vider le panier</a>
            <?php
        }
        ?>
</section>
        