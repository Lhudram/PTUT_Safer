<div id="contenu" class="hidden col-xs-12 col-sm-12 col-md-10 col-md-push-1 col-lg-8 col-lg-push-2">

    <?php
    include("protected/include/subnavbar.inc.php");

    //TODO : gérer les espaces

    $connexionModule = new ConnexionModule();

    if (!empty($_POST["login"]) && !empty($_POST["password"]) && !empty($_POST["confirmation_password"]))
        if ($_POST["password"] === $_POST["confirmation_password"])
            $modification = $connexionModule->modifyUser($_SESSION["id"], $_POST["login"], $_POST["password"]);
        else
            $diffPassword = true;
    ?>

    <div id="titre_page">
        <h1>Gérer son compte</h1>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-12">
            <form action="#" method="post">
                <h2>Mes identifiants</h2>
                <br>
                <table>
                    <tr>
                        <td>
                            <label for="login">Login : </label>
                        </td>
                        <td>
                            <input id="login" type="text" name="login" value="<?php echo $_SESSION["login"]; ?>"
                                   required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="password">Nouveau mot de passe : </label>
                        </td>
                        <td>
                            <input id="password" type="password" name="password" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="confirmation_password">Confirmation du mot de passe : </label>
                        </td>
                        <td>
                            <input id="confirmation_password" type="password" name="confirmation_password" required>
                        </td>
                    </tr>
                </table>
                <br>
                <button type="submit" class="btn btn-success">Modifier</button>
            </form>
            <br>
            <?php
            if (isset($modification)) {
                if ($modification) {
                    ?>
                    <div class="alert alert-success text-center">Vos identifiants ont bien été modifiés.</div>
                    <?php
                } else {
                    ?>
                    <div class="alert alert-danger text-center"><strong>ERREUR !</strong> Vos identifiants n'ont pas pu
                        être modifiés. Merci de reporter cette erreur.
                    </div>
                    <?php
                }
            }
            if (!empty($diffPassword))
                echo '<div class="alert alert-danger text-center"><strong>ERREUR !</strong> Les mots de passe sont différents.</div>';
            ?>
        </div>
    </div>

    <script type="text/javascript" src="js/notification.js"></script>