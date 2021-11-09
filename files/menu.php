<?php
$nb=0;
if(isset($_SESSION["products"])){
    foreach($_SESSION["products"] as $index => $product){
        $nb += $product["qtt"];
    }
}
?>
<header>
    <div>
        <i class="fas fa-bars menuBtn"></i>
        <nav id="menu">
            <a href="index.php">Accueil</a>
            <a href="recap.php">Panier</a>
        </nav>
    </div>
    <div>
        <a href="recap.php">
            <p id="nbArticles"><?=$nb?></p>
            <i class="fas fa-shopping-cart"></i>
        </a>
    </div>
</header>
<div class="message">
    <?php 
    if(isset($_SESSION["message"])){
        foreach($_SESSION["message"] as $value => $notif){
            echo "<p class='$value'>".$notif."</p>";
        }
    }
    unset($_SESSION["message"]);
    ?>
</div>