<section>
    <h1>Inscription</h1>
    <form action="?ctrl=security&action=register" method="post">
        <div class="labelInput">
            <label>
                Nom d'utilisateur :
                <input type="text" name="username" required>
            </label>
        </div>
        <div class="labelInput">
            <label>
                Adresse E-mail :
                <input type="email" name="email" required>
            </label>
        </div>
        <div class="labelInput">
            <label>
                Mot de passe :
                <input type="password" name="pass1" required>
            </label>
        </div>
        <div class="labelInput">
            <label>
                Répeter le mot de passe :
                <input type="password" name="pass2" required>
            </label>
        </div>
        <p>
            <input type="submit" value="Inscription">
        </p>
    </form>
</section>