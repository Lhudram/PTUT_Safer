<?php
$db = new MyPDO();
$collaborateurManager = new CollaborateurManager($db);
?>

<div id="contenu" class="hidden col-xs-12 col-sm-12 col-md-10 col-md-push-1 col-lg-8 col-lg-push-2">

    <?php
    include("protected/include/subnavbar.inc.php");
    if (!empty($_POST["id"])) {

        $collaborateur = $collaborateurManager->getFullCollaborateur($_POST["id"]);
        $etatCivil = $collaborateur->getEtatCivil();
        $nom = strtoupper($etatCivil->getNom());
        $prenom = $etatCivil->getPrenom();
        ?>

        <div id="titre_page">
            <h1>Générer la lettre d'embauche de <?php echo $prenom . " " . $nom ?></h1>
        </div>

        <div class="row">

            <div id="apercu" class="col-md-6 col-md-offset-3">

                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h2>Aperçu modèle</h2>
                    </div>

                    <div class="panel-body">

                        <table>
                            <tr>
                                <td>Coordonnées</td>
                            </tr>
                            <tr>
                                <td>Lieu et date</td>
                            </tr>
                            <tr>
                                <td>Objet</td>
                            </tr>
                            <tr>
                                <td>Civilité</td>
                            </tr>
                            <tr>
                                <td>Rappel</td>
                            </tr>
                            <tr>
                                <td>Demande retour</td>
                            </tr>
                            <tr>
                                <td>Fixer rendez-vous</td>
                            </tr>
                            <tr>
                                <td>Formule politesse</td>
                            </tr>
                            <tr>
                                <td>Signature</td>
                            </tr>
                        </table>

                    </div>
                </div>
            </div>

        </div>

        <div class="row col-md-6 col-md-offset-3">
            <div id="generer">
                <form id="liste" action="#" method="POST">
                    <label for="date_prescrite">Date retour : (facultatif)</label>
                    <input id="date_prescrite" name="date_prescrite" type="date">
                    <input id="generer_lettre" name="generer_lettre" class="btn btn-primary" type="submit" value="Générer">
                    <input type="hidden" name="id" value="<?php echo $_POST["id"] ?>">
                </form>
            </div>
        </div>


        <?php

        if (!empty($_POST['generer_lettre'])) {

            include_once("protected/include/pages/traitement_donnees_generation.inc.php");

            //Création de la lettre d'embauche à partir du modèle
            $cheminDocuments = "protected\documents_generes\\";
            $cheminDuModele = "modele\modele_lettre_embauche.htm";
            $adresseModele = $cheminDocuments . $cheminDuModele;

            //On récupère le contenu brut du fichier html de la lettre d'embauche modèle
            $contenuModele = file_get_contents($adresseModele);

            //On change l'encodage des variables pour convenir à celui du modèle
            foreach ($variables as &$variable) {
                $variable = iconv('UTF-8', 'WINDOWS-1252', $variable);
            }

            //On remplace chaque "mot-clé" du modèle par les valeurs précédemment définies
            $contenuModele = str_replace(array_keys($variables), $variables, $contenuModele);

            $extensionFichier = "doc";

            //On formate le nom du fichier sous la forme "lettre_embauche_NOM_prenom_jour_mois_annee.extensionFichier"
            $typeFichier = "lettre_embauche";
            $dateCouranteFr = explode('/', $dateCouranteFr);
            $nomFichier = $typeFichier . "_" . strtoupper($nom) . "_" . $prenom . "_" . $dateCouranteFr[0] . "_" . $dateCouranteFr[1] . "_" . $dateCouranteFr[2] . "." . $extensionFichier;

            //On définit un emplacement pour la nouvelle lettre d'embauche (ici dans le projet lui même)
            $emplacementFichier = $cheminDocuments . $nomFichier;

            //Avant de créer une nouvelle lettre d'embauche on supprime la dernière lettre générée qui est encore stockée sur le site
            // /!\ SUPPRIME tous les fichiers contenu dans le repertoire des documents générés commençant par "lettre_embauche"
            array_map('unlink', glob($cheminDocuments . $typeFichier . "*." . $extensionFichier));

            //Création d'une nouvelle lettre d'embauche
            if (!$handle = fopen($emplacementFichier, 'a')) {//On vérifie que l'on peut créer le fichier et on le créer
                exit("Impossible d'ouvrir le fichier ($emplacementFichier)");
            }
            if (fwrite($handle, $contenuModele) === FALSE) {//On vérifie que l'on peut écrire sur le fichier et on écrit le contenu de la nouvelle lettre
                exit("Impossible d'écrire dans le fichier ($emplacementFichier)");
            }
            fclose($handle);
            ?>


            <!-- Affichage du bouton de téléchargement -->
            <div class="row">
                <h4 class="col-md-8 col-md-offset-3">La lettre d'embauche de <?php echo $prenom . " " . $nom ?> a été générée.</h4>

                <a class="col-md-3 col-md-offset-4" href='<?php echo $cheminDocuments . $nomFichier ?>' download='<?php echo $nomFichier ?>'>
                    <input id="telecharger_lettre" class="btn btn-primary" type='button' value="Télécharger lettre d'embauche">
                </a>
            </div>
            <?php
        }
    } else {
        ?>
        <br><br>
        <div class="alert alert-danger text-center"><strong>ERREUR !</strong> Aucun id n'a été fourni.</div>
        <?php
    }
    ?>
