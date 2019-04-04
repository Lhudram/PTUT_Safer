<div id="contenu" class="hidden col-xs-12 col-sm-12 col-md-10 col-md-push-1 col-lg-8 col-lg-push-2">

    <div id="titre_page">
        <h1>Connexion</h1>
    </div>

    <div class="row">
        <form id="formulaire_connexion" action="index.php" method="POST">
            <label for="nom_utilisateur">Nom d'utilisateur : </label><br>
            <input id="nom_utilisateur" name="login" type="text"
                <?php if (!empty($_POST["login"])) echo 'value="' . $_POST["login"] . '"'; else echo 'autofocus' ?>
                   required>

            <br>

            <label for="mot_de_passe">Mot de passe :</label><br>
            <input id="mot_de_passe" name="password"
                   type="password" <?php if (!empty($_POST["login"])) echo 'autofocus'; ?> required>

            <br>
            <input id="se_connecter" class="btn btn-lg btn-success" type="submit" value="Se connecter">
        </form>

        <?php
        if (!empty($echecConnexion)) {
            ?>
            <div class="alert alert-danger text-center">
                <strong>ERREUR !</strong> Vos identifiants sont erronés.
            </div>
            <?php
        }
        ?>
    </div>

</div>
