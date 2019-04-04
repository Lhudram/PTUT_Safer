<?php
$db = new Mypdo();
$collaborateurManager = new CollaborateurManager($db);
$listesParamManager = new ListesParamManager($db);

if (!empty($_POST["rechercher"]))
    //On recherche uniquement les collaborateurs complets
    $resultatsRecherche = $collaborateurManager->rechercher(true, false, $_POST["nom"], $_POST["prenom"], (int)$_POST["fonction"], (int)$_POST["etablissement"]);
?>

<div id="contenu" class="hidden col-xs-12 col-sm-12 col-md-10 col-md-push-1 col-lg-8 col-lg-push-2">

    <?php
    include("protected/include/navbar.inc.php");
    ?>

    <div id="titre_page">
        <h1>Générer documents</h1>
    </div>

    <div class="row">
        <form id="rechercher_collaborateur" class="col-md-6" method="POST">

            <input id="recherche_nom" class="mi_largeur" type="text" name="nom" placeholder="Nom..." <?php
            if (!empty($_POST["nom"])) echo 'value="' . $_POST["nom"] . '"';
            ?>>
            <input id="recherche_prenom" class="mi_largeur" type="text" name="prenom" placeholder="Prenom..." <?php
            if (!empty($_POST["prenom"])) echo 'value="' . $_POST["prenom"] . '"';
            ?>><br>
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

        <form id="liste" class="col-md-6" method="POST">
            <select id="liste_collaborateurs" name="id" size="20" required>
                <?php
                if (isset($resultatsRecherche))
                    $collaborateurs = $resultatsRecherche;
                else
                    $collaborateurs = $collaborateurManager->getAllCollaborateur();

                foreach ($collaborateurs as $collaborateur) {
                    if ($collaborateur["estcomplet"]) {//On affiche que les collaborateurs complets
                        echo '<option ';
                        echo 'value="';
                        echo $collaborateur["id"];
                        echo '">';
                        echo $collaborateur["nom"] . " " . $collaborateur["prenom"] . " | " . $collaborateur["etablissement"] . " | " . $collaborateur["fonction"] . '</option>' . "\n";
                    }
                }
                ?>
            </select>
        </form>

        <div id="choisir_document" class="col-md-6">
            <ul class="nav">
                <li><a id="generer_contrat" class="btn btn-primary">Générer contrat de travail</a></li>
                <br>
                <li><a id="generer_lettre" class="btn btn-primary">Générer lettre d'embauche</a></li>
                <br>
                <li><a id="generer_fiche_renseignement" class="btn btn-primary" >Générer fiche de renseignements</a></li>
            </ul>
        </div>

    </div>

    <div id="retour_js"></div>

    <script type="text/javascript" src="js/notification.js"></script>
    <script>
        document.getElementById('generer_lettre').addEventListener('click', lettre, false);
        document.getElementById('generer_contrat').addEventListener('click', contrat, false);
        document.getElementById('generer_fiche_renseignement').addEventListener('click', ficheRenseignement, false);

        function lettre() {
            if (document.getElementById("liste_collaborateurs").selectedIndex === -1)
                notification("warning", "<strong>ATTENTION !</strong> Vous devez sélectionner un collaborateur.");
            else
                $("#liste")
                    .attr("action", "index.php?page=<?php echo $pages["generer_lettre_embauche"]; ?>")
                    .submit();
        }

        function contrat() {
            if (document.getElementById("liste_collaborateurs").selectedIndex === -1)
                notification("warning", "<strong>ATTENTION !</strong> Vous devez sélectionner un collaborateur.");
            else
                $("#liste")
                    .attr("action", "index.php?page=<?php echo $pages["generer_contrat_travail"]; ?>")
                    .submit();
        }

        function ficheRenseignement() {
            if (document.getElementById("liste_collaborateurs").selectedIndex === -1)
                notification("warning", "<strong>ATTENTION !</strong> Vous devez sélectionner un collaborateur.");
            else
                $("#liste")
                    .attr("action", "index.php?page=<?php echo $pages["generer_fiche_renseignement"]; ?>")
                    .submit();
        }
    </script>

    <?php
    $_SESSION["historique"] = $pages["generer_documents"];
    ?>
