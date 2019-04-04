<div id="contenu" class="hidden col-xs-12 col-sm-12 col-md-10 col-md-push-1 col-lg-8 col-lg-push-2">

    <?php
    include("protected/include/subnavbar.inc.php");

    //TODO : gérer les espaces

    $connexionModule = new ConnexionModule();

    if (!empty($_POST["password_admin"]) && !empty($_POST["confirmation_password_admin"]))
        if ($_POST["password_admin"] === $_POST["confirmation_password_admin"])
            $modifPasswordPerso = $connexionModule->modifyUser($_SESSION["id"], $_SESSION["login"], $_POST["password_admin"]);
        else
            $diffPasswordAdmin = true;

    if (!empty($_POST["id_utilisateur"]) && !empty($_POST["login_utilisateur"]) && !empty($_POST["password_user"]) && !empty($_POST["confirmation_password_user"]))
        if ($_POST["password_user"] === $_POST["confirmation_password_user"])
            $modifPasswordAutre = $connexionModule->modifyUser($_POST["id_utilisateur"], $_POST["login_utilisateur"], $_POST["password_user"]);
        else
            $diffPasswordUser = true;

    if (!empty($_POST["login_nouveau_utilisateur"]) && !empty($_POST["password_nouveau_user"]) && !empty($_POST["confirmation_password_nouveau_user"]))
        if ($_POST["password_nouveau_user"] === $_POST["confirmation_password_nouveau_user"])
            $ajoutUtilisateur = $connexionModule->add($_POST["login_nouveau_utilisateur"], $_POST["password_nouveau_user"], false);
        else
            $diffPasswordNouveauUser = true;

    if (!empty($_POST["id_suppression"]))
        if ($connexionModule->delete($_POST["id_suppression"]))
            echo '<p id="response">1</p>';
        else
            echo '<p id="response">0</p>';

    $users = $connexionModule->getAll();
    ?>

    <div id="titre_page">
        <h1>Gérer utilisateurs</h1>
    </div>

    <div class="row">
        <div class="col-lg-6 col-md-6">
            <h2>Modifier votre mot de passe</h2>
            <br>
            <form action="#" method="post">
                <table>
                    <tr>
                        <td>
                            <label for="password_admin">Nouveau mot de passe : </label>
                        </td>
                        <td>
                            <input id="password_admin" type="password" name="password_admin" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="confirmation_password_admin">Confirmation du mot de passe : </label>
                        </td>
                        <td>
                            <input id="confirmation_password_admin" type="password" name="confirmation_password_admin"
                                   required>
                        </td>
                    </tr>
                </table>
                <br>
                <button type="submit" class="btn btn-success">Modifier</button>
            </form>
            <br>
            <?php
            if (isset($modifPasswordPerso)) {
                if ($modifPasswordPerso) {
                    ?>
                    <div class="alert alert-success text-center">Votre mot de passe a bien été modifié.</div>
                    <?php
                } else {
                    ?>
                    <div class="alert alert-danger text-center"><strong>ERREUR !</strong> Votre mot de passe n'a pas pu
                        être modifié. Merci de reporter cette erreur.
                    </div>
                    <?php
                }
            }
            if (!empty($diffPasswordAdmin))
                echo '<div class="alert alert-danger text-center"><strong>ERREUR !</strong> Les mots de passe sont différents.</div>';
            ?>
        </div>

        <div class="col-lg-6 col-md-6">
            <h2>Ajouter un utilisateur</h2>
            <br>
            <form action="#" method="post">
                <table>
                    <tr>
                        <td>
                            <label for="login_nouveau_utilisateur">Login : </label>
                        </td>
                        <td>
                            <input type="text" maxlength="30" id="login_nouveau_utilisateur"
                                   name="login_nouveau_utilisateur" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="password_nouveau_user">Mot de passe : </label>
                        </td>
                        <td>
                            <input type="password" id="password_nouveau_user" name="password_nouveau_user" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="confirmation_password_nouveau_user">Confirmation du mot de passe : </label>
                        </td>
                        <td>
                            <input type="password" id="confirmation_password_nouveau_user"
                                   name="confirmation_password_nouveau_user" required>
                        </td>
                    </tr>
                </table>
                <br>
                <button type="submit" class="btn btn-success">Ajouter</button>
            </form>
            <br>
            <?php
            if (isset($ajoutUtilisateur))
                if ($ajoutUtilisateur)
                    echo '<div class="alert alert-success text-center">Le nouvel utilisateur a bien été ajouté.</div>';
                else
                    echo '<div class="alert alert-danger text-center"><strong>ERREUR !</strong> Le nouvel utilisateur n\'a pas pu être ajouté. Merci de reporter cette erreur.</div>';

            if (!empty($diffPasswordNouveauUser))
                echo '<div class="alert alert-danger text-center"><strong>ERREUR !</strong> Les mots de passe sont différents.</div>';
            ?>
        </div>
    </div>
    <div class="row">
        <h2 class="text-center">Autres utilisateurs</h2>
        <form action="#" method="post" class="col-md-12 col-lg-12">
            <div class="col-lg-offset-1 col-lg-4  col-md-offset-1 col-md-4 ">
                    <select id="id_utilisateur" name="id_utilisateur" size="8" required>
                        <?php
                        foreach ($users as $user)
                            if ($_SESSION["login"] != $user->login)
                                echo '<option value="' . $user->id . '">' . $user->id . '] ' . $user->login . '</option>';
                        ?>
                    </select>
                    <a id="supprimer_utilisateur" class="btn btn-success">Supprimer</a>
                <br><br>
                    <div id="retour_js"></div>
                </div>
            <div class="col-lg-offset-1 col-lg-6 col-md-offset-1 col-md-6">
                    <table>
                        <tr>
                            <td>
                                <label for="login_utilisateur">Login : </label>
                            </td>
                            <td>
                                <input id="login_utilisateur" type="text" maxlength="30"
                                       name="login_utilisateur" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="password_user">Nouveau mot de passe : </label>
                            </td>
                            <td>
                                <input id="password_user" type="password" name="password_user" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="confirmation_password_user">Confirmation mot de passe : </label>
                            </td>
                            <td>
                                <input id="confirmation_password_user" type="password"
                                       name="confirmation_password_user"
                                       required>
                            </td>
                        </tr>
                    </table>
                <button type="submit" class="btn btn-success">Modifier</button>
                <br><br>
                <?php
                if (isset($modifPasswordAutre)) {
                    if ($modifPasswordAutre) {
                        ?>
                        <div class="alert alert-success text-center text-center">Le mot de passe a bien été modifié.</div>
                        <?php
                    } else {
                        ?>
                        <div class="alert alert-danger text-center text-center"><strong>ERREUR !</strong> Le mot de passe
                            n'a pas pu
                            être modifié. Merci de reporter cette erreur.
                        </div>
                        <?php
                    }
                }
                if (!empty($diffPasswordUser))
                    echo '<div class="alert alert-danger text-center text-center"><strong>ERREUR !</strong> Les mots de passe sont différents.</div>';
                ?>
                </div>
            </form>
    </div>
    <div id="popup_confirmation_suppression" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <p>Voulez-vous vraiment supprimer ce collaborateur?</p>
                <button class="btn" type="button" data-dismiss="modal">Non</button>
                <button id="supprimer" class="btn btn-danger" type="button" data-dismiss="modal">Oui</button>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="js/notification.js"></script>
    <script type="text/javascript" src="js/gerer_utilisateurs.js"></script>