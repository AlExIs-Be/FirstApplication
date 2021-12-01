<?php
    $prod = array_key_exists("product", $response["data"]) ? $response["data"]["product"] : ["name"=>"","description"=>"","price"=>"","image"=>""];
    $products = $response["data"]["products"]
?>

<div class="splitscreen">
    <section class="addProduct">
        <h1><?=$response["data"]["title"]?> un produit</h1>
        <form action="?ctrl=admin&action=<?=$response["data"]["action"]?>" method="post">
            <p>
                <label>
                    Nom du produit :
                    <input type="text" name="name" value="<?=$prod["name"]?>">
                </label>
            </p>
            <p>
                <label>
                    Description :
                    <textarea rows=15 cols=30 name="desc"><?=$prod["description"]?></textarea>
                </label>
            </p>
            <p>
                <label>
                    Prix du produit :
                    <input type="number" name="price" step="0.01" value="<?=$prod["price"]?>">
                </label>
            </p>
            <p>
                <label>
                    Lien d'image :
                    <input type="text" name="img" value="<?=$prod["image"]?>">
                </label>
            </p>
            <p>
                <input type="submit" value="<?=$response["data"]["title"]?> le produit">
            </p>
        </form>
    </section>
    <section class=delProduct>
        <h1>Retirer/Editer un produit</h1>
        <table>
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Nom</th>
                    <th>Prix</th>
                    <th></th>
                </tr>
            </thead
            ><tbody>
                <?php
                 foreach($products as $product){
                     ?>
                    <tr>
                        <td><img src='<?=$product["image"]?>'></td>
                        <td><?=$product["name"]?></td>
                        <td><?=$product["price"]?>&nbsp;&euro;</td>
                        <td>
                            <a href='?ctrl=admin&action=delete&id=<?=$product["id"]?>' class='fas fa-trash' onclick='confirmDelete(event,<?=$product["name"]?>)'></a>
                            <a href='?ctrl=admin&action=editProd&id=<?=$product["id"]?>' class='fas fa-pen'></a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </section>
</div>
    <div class="modal">
        <h4>Attention !!</h4>
        <p>Vous êtes sur le point de supprimer définitivement le produit <span class="prodName"></span>. Êtes-vous sûr ?</p>
        <a class ="modal-action-confirm" href="">Confirmer</a>
        <a class ="modal-action-cancel" href="#">Annuler</a>
    </div>
