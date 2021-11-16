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
            <p id="nbArticles"><?=countProducts()?></p>
            <i class="fas fa-shopping-cart"></i>
        </a>
    </div>
</header>
<div class="message">
    <?=message()?>
</div>