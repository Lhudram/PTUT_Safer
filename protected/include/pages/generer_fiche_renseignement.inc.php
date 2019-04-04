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
            <h1>Générer la fiche de renseignements de <?php echo $prenom . " " . $nom ?></h1>
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
                                <td>Fiche de renseignements salarié</td>
                            </tr>
                            <tr>
                                <td>Situation de famille</td>
                            </tr>
                            <tr>
                                <td>Enfants</td>
                            </tr>
                            <tr>
                                <td>Dernier emploi occupé</td>
                            </tr>
                            <tr>
                                <td>Personnes à prévenir en cas d'accident</td>
                            </tr>
                            <tr>
                                <td>Références bancaires</td>
                            </tr>
                            <tr>
                                <td>Carte d'identite</td>
                            </tr>
                            <tr>
                                <td>Permis de conduire</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div id="generer" class="col-md-4 col-md-offset-4">
                <form action="#" method="POST">
                    <input id="generer" name="generer_fiche_renseignement" class="btn btn-primary" type="submit" value="Générer"><br>
                    <input type="hidden" name="id" value="<?php echo $_POST["id"] ?>">
                </form>
            </div>
        </div>

        <?php
        if (!empty($_POST['generer_fiche_renseignement'])) {

            include_once("protected/include/pages/traitement_donnees_generation.inc.php");

            //Création de la fiche de renseignement à partir du modèle
            $cheminDocuments = "protected\documents_generes\\";
            $cheminDuModele = "modele\modele_fiche_renseignement.htm";
            $adresseModele = $cheminDocuments . $cheminDuModele;

            //On récupère le contenu brut du fichier htm de la fiche de renseignement modèle
            $contenuModele = file_get_contents($adresseModele);

            //On change l'encodage des variables pour convenir à celui du modèle
            foreach ($variables as &$variable) {
                $variable = iconv('UTF-8', 'WINDOWS-1252', $variable);
            }

            //On remplace chaque "mot-clé" du modèle par les valeurs précédemment définies
            $contenuModele = str_replace(array_keys($variables), $variables, $contenuModele);

            $extensionFichier = "doc";

            //On formate le nom du fichier sous la forme "fiche_renseignements_NOM_prenom_jour_mois_annee.extensionFichier"
            $typeFichier = "fiche_renseignements";
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
            <br>
            <div class="row">
                <div class="col-md-offset-3 col-md-5">
                    <h4 class="col-md-8 ">La fiche de renseignement pour <?php echo $prenom . " " . $nom ?> a été générée.</h4>

                    <a class="col-md-4" href='<?php echo $cheminDocuments . $nomFichier ?>' download='<?php echo $nomFichier ?>'>
                        <input id="telecharger_fiche" class="btn btn-primary" type='button' value="Télécharger fiche de renseignements">
                    </a>
                </div>
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
