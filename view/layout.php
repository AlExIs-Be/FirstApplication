<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="<?=CSS_PATH?>/style.css">
    <title>STORE</title>
</head>
<body>
    <div class="wrapper">
        <header>
            <div>
                <i class="fas fa-bars menuBtn"></i>
                <nav id="menu">
                    <a href="?ctrl=store">Accueil</a>
                    <a href="?ctrl=cart&action=recap">Panier</a>
                    <?php
                        if($user = Session::get("user")){
                            if($user["role"] == "ROLE_ADMIN"){
                                ?>
                                <a href="?ctrl=admin">Administration</a>
                                <?php
                            }
                            ?>
                            <a href="?ctrl=security&action=logout">Déconnexion</a>
                            <?php
                        }
                        else{
                            ?>
                            <a href="?ctrl=security&action=login">Connexion</a>
                            <a href="?ctrl=security&action=register">Inscription</a>
                            <?php
                        }
                    ?>
                </nav>
            </div>
            <div>
                <a href="?ctrl=cart&action=recap" class="fas fa-shopping-cart">
                    <?php 
                        $nb = 0;
                        if($products = Session::get("products")){
                            foreach($products as $product){
                                $nb += $product["qtt"];
                            }
                    }
                    ?>
                    <p id="nbArticles"><?=$nb?></p>
                </a>
            </div>
        </header>

        <div class="message">
            <?php
                if($message = Session::get("message")){
                    ?>
                    <p id="message" class='<?= $message['type'] ?>'>
                        <?= $message['msg'] ?> 
                    </p>
                    <?php
                    Session::remove("message");
                }
            ?>
        </div>

        <?= $content?>

        <footer>
            <p id="switchMode">&#9789;</p>
        </footer>
    </div>
    <script src="<?=JS_PATH?>/script.js"></script>
</body>
</html>