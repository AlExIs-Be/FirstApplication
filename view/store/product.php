<?php
    $product = $response["data"]["product"];
?>

    <div class='product full'>
        <h3><?=$product["name"]?></h3>
        <div class='imgDescr'>
            <figure>
                <img class='img full' src='<?=$product["image"]?>' alt='image de <?=$product["name"]?>'>
            </figure>
            <div class='desc'>
                <p><?=$product["description"]?></p>
                <p class='price'>
                    <?=$product["price"]?>&nbsp;&euro; 
                    <a href='?ctrl=store&'> Ajouter au panier</a>
                </p>
            </div>
        </div>
    </div>