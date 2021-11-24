<?php
    session_start();
    include "files/functions.php";
    include "files/db-security.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="files/style.css">
    <title>Connexion</title>
</head>
<body>
    <div class="wrapper">
        <?php 
            include "files/menu.php";
        ?>
    <section>
        <h1>Connexion</h1>
        <form action="files/security.php?action=login" method="post">
            <div class="labelInput">
                <label>
                    Nom d'utilisateur ou adresse email:
                </label>
                <input type="text" name="credentials" required>
            </div>
            <div class="labelInput">
                <label>
                    Mot de passe :
                </label>
                <input type="password" name="password" required>
                
            </div>
            <p>
                    <input type="submit" name="submit" value="Inscription">
                </p>
        </form>
    </section>
    <?php
        include "files/footer.php"
    ?>
    </div>
    <script src="files/script.js"></script>
</body>
</html>