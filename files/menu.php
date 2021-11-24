<header>
    <div>
        <i class="fas fa-bars menuBtn"></i>
        <nav id="menu">
            <a href="index.php">Accueil</a>
            <a href="recap.php">Panier</a>
            <?php
                if(isset($_SESSION['user'])){
                    ?>
                    <a href="files/security.php?action=logout">Déconnexion</a>
                    <?php
                }else{
                    ?>
                    <a href="register.php">Inscription</a>
                    <a href="login.php">Connexion</a>
                    <?php
                }
            ?>
        </nav>
    </div>
    <a  href="admin.php"><i class="hidden fas fa-user-cog"></i></a>
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