<?php
$db = new Mypdo();
$collaborateurManager = new CollaborateurManager($db);
$listesParamManager = new ListesParamManager($db);

if (!empty($_POST["id_suppression"])) {
    $aEteSupprime = $collaborateurManager->supprimerCollaborateur((int)$_POST["id_suppression"]);
}

if (!empty($_POST["rechercher"]))
    $resultatsRecherche = $collaborateurManager->rechercher(isset($_POST["complet"]), isset($_POST["incomplet"]), $_POST["nom"], $_POST["prenom"], (int)$_POST["fonction"], (int)$_POST["etablissement"]);
?>

    <div id="contenu" class="hidden col-xs-12 col-sm-12 col-md-10 col-md-push-1 col-lg-8 col-lg-push-2">

<?php
include("protected/include/navbar.inc.php");
?>

    <div id="titre_page">
        <h1>Gérer collaborateurs</h1>
    </div>

    <div class="row">

        <form id="rechercher_collaborateur" class="col-md-9" method="POST">
            <div id="recherche_complet_incomplet">
                <label class="mi_largeur" for="recherche_complet">Profils complets</label> <input id="recherche_complet" class="mi_largeur" type="checkbox" name="complet" <?php
                if (!empty($_POST["complet"]) || empty($_POST["incomplet"])) echo 'checked';
                ?>>
                <label class="mi_largeur" for="recherche_incomplet">Profils incomplets</label> <input id="recherche_incomplet" class="mi_largeur" type="checkbox" name="incomplet" <?php
                if (!empty($_POST["incomplet"]) || empty($_POST["complet"])) echo 'checked';
                ?>>
            </div>
            <input id="recherche_nom" class="mi_largeur" type="text" name="nom" placeholder="Nom..." <?php if (!empty($_POST["nom"])) echo 'value="' . $_POST["nom"] . '"'; ?>>
            <input id="recherche_prenom" class="mi_largeur" type="text" name="prenom" placeholder="Prenom..." <?php if (!empty($_POST["prenom"])) echo 'value="' . $_POST["prenom"] . '"'; ?>>
            <br>
            <select id="recherche_fonction" name="fonction">
                <option value="aucun">Sélectionnez une fonction</option>
                <?php
                $emploisCCN = $listesParamManager->getAll(ListesParamManager::EMPLOI_CCN);
                foreach ($emploisCCN as $emploiCCN) {
                    echo '<option value="' . $emploiCCN->getId() . '" ';
                    if (!empty($_POST["fonction"]) && $_POST["fonction"] == $emploiCCN->getId())
                        echo 'selected';
                    echo '>' . $emploiCCN->getIntitule() . '</option>' . "\n";
                }
                ?>
            </select>
            <select id="recherche_etablissement" name="etablissement">
                <option value="aucun">Sélectionnez un établissement</option>
                <?php
                $etablissements = $listesParamManager->getAll(ListesParamManager::ETABLISSEMENT);
                foreach ($etablissements as $etablissement) {
                    echo '<option value="' . $etablissement->getId() . '" ';
                    if (!empty($_POST["etablissement"]) && $_POST["etablissement"] == $etablissement->getId())
                        echo 'selected';
                    echo '>' . $etablissement->getIntitule() . '</option>' . "\n";
                }
                ?>
            </select><br>
            <input class="btn" type="submit" name="rechercher" value="Rechercher">
        </form>
    </div>

    <div class="row">

        <form id="liste" class="col-md-9" action="index.php?page=<?php echo $pages["modifier_collaborateur"]; ?>"
              method="POST">
            <select id="liste_collaborateurs" name="id" size="20" required>
                <?php
                if (isset($resultatsRecherche))
                    $collaborateurs = $resultatsRecherche;
                else
                    $collaborateurs = $collaborateurManager->getAllCollaborateur();

                foreach ($collaborateurs as $collaborateur) {
                    echo '<option ';
                    if (!$collaborateur["estcomplet"])
                        echo 'style="font-weight: bold" ';
                    echo 'value="';
                    echo $collaborateur["id"];
                    echo '">';
                    if (!$collaborateur["estcomplet"])
                        echo '*';
                    echo $collaborateur["nom"] . " " . $collaborateur["prenom"] . " | " . $collaborateur["etablissement"] . " | " . $collaborateur["fonction"] . '</option>' . "\n";
                }
                ?>
            </select>
        </form>

        <div id="boutons" class="col-md-3">
            <ul class="nav">
                <li><a id="ajouter" class="btn btn-primary"
                       href="index.php?page=<?php echo $pages["ajouter_collaborateur"]; ?>">+ Ajouter</a></li>
                <br>
                <li><a id="modifier" class="btn btn-primary">Modifier</a></li>
                <br>
                <?php
                if ($_SESSION["admin"])
                    echo '<li><a id="bouton_supprimer" class="btn btn-primary">- Supprimer</a></li>';
                ?>
            </ul>
        </div>
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

    <div id="retour_js"></div>

<?php
if (isset($aEteSupprime)) {
    if ($aEteSupprime)
        echo '<div id="retour_suppression" class="alert alert-success text-center">Le collaborateur a bien été supprimé.</div>';
    else
        echo '<div id="retour_suppression" class="alert alert-danger text-center"><strong>ERREUR !</strong> Le collaborateur n\'a pas pu être supprimé. Merci de reporter cette erreur.</div>';
    ?>
    <script>
        setTimeout(function () {
            const retour = document.getElementById("retour_suppression");
            retour.parentNode.removeChild(retour);
        }, 4000);
    </script>
    <?php
}
?>

    <script type="text/javascript" src="js/notification.js"></script>
    <script type="text/javascript" src="js/gerer_collaborateurs.js"></script>

<?php
$_SESSION["historique"] = $pages["gerer_collaborateurs"];
?>