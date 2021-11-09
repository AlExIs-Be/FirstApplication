<?php
include("calculs.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="style.css">
    <title>Ajout de produits</title>
</head>
<body>
    <div class="wrapper">
        <header>
            <div>
                <i class="fas fa-bars menuBtn"></i>
                <nav id="menu">
                    <a href="index.php">Accueil</a>
                    <a href="recap.php">Panier</a>
                </nav>
            </div>
            <div>
                <p id="nbArticles"><?=$nb?></p>
                <i class="fas fa-shopping-cart"></i>
            </div>
        </header>
        <section id="addProduct">
            <h1>Ajouter un produit</h1>
            <form action="traitement.php" method="post">
                <p>
                    <label>
                        Nom du produit :
                        <input type="text" name="name">
                    </label>
                </p>
                <p>
                    <label>
                        prix du produit : 
                        <input type="number" step="any" name="price">
                    </label>
                </p>
                <p>
                    <label>
                        Quantité désirée :
                        <input type="number" name="qtt" value="1">
                    </label>
                </p>
                <p>
                    <input type="submit" name="submit" value="Ajouter le produit">
                </p>
            </form>
        </section>
    </div>
    <script src="script.js"></script>
</body>
</html>