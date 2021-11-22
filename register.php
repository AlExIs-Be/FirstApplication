<?php
    session_start();
    include "files/functions.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="files/style.css">
    <title>Inscription</title>
</head>
<body>
    <div class="wrapper">
        <?php 
        include "files/menu.php";
        ?>
        <section>
            <h1>Inscription</h1>
            <form action="files/security.php?action=register" method="post">
                <p>
                    <label>
                        Nom d'utilisateur :
                        <input type="text" name="username" required>
                    </label>
                </p>
                <p>
                    <label>
                        Adresse E-mail :
                        <input type="email" name="email" required>
                    </label>
                </p>
                <p>
                    <label>
                        Mot de passe :
                        <input type="password" name="pass1" required>
                    </label>
                </p>
                <p>
                    <label>
                        Répeter le mot de passe :
                        <input type="password" name="pass2" required>
                    </label>
                </p>
                <p>
                    <input type="submit" name="submit" value="Inscription">
                </p>
            </form>
        </section>
        <?php
        include "files/footer.php"
        ?>
    </div>
</body>
</html>