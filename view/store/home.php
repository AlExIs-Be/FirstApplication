<?php
    $products = $response["data"]["products"];
?>

<div class='store'>
    <?php
    foreach($products as $product){
        ?>
        <div class='product'>
            <h4>
                <a href="?ctrl=store&action=product&id=<?=$product['id']?>"><?=$product['name']?></a>
            </h4>
            <figure class='mini'>
                <a href='?ctrl=store&action=product&id=<?=$product['id']?>'>
                    <img src='<?=$product['image']?>' alt='image de <?=$product['name']?>'>
                </a>
            </figure>
            <p> <?=mb_strimwidth($product["description"], 0, 50, "...")?></p>
            <p class='price'>
                <?=$product['price']?>&nbsp;&euro;
                <a href='?ctrl=store&action=addProd&id=<?=$product['id']?>'>Ajouter&nbsp;au&nbsp;panier</a>
            </p>
        </div>
        <?php
    } 
    ?>
</div>

         