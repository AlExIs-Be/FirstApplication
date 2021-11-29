<section>
    <h1>Connexion</h1>
    <form action="?ctrl=security&action=login" method="post">
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
                <input type="submit" value="Inscription">
            </p>
    </form>
</section>
    