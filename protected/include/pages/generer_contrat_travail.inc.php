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
            <h1>Générer le contrat de travail de <?php echo $prenom . " " . $nom ?></h1>
        </div>

        <div class="row">

            <div id="gauche" class=col-md-6>

                <form id="liste_paragraphe" name="liste_paragraphe" action="#" method="POST">
                    <table>
                        <?php
                        $paragrapheContratTravailManager = new ParagrapheContratTravailManager($db);
                        $tabAllParagraphesContrat = $paragrapheContratTravailManager->getAll();

                        foreach ($tabAllParagraphesContrat as $paragraphe) {
                            ?>
                            <tr>
                                <td><label for="<?php echo $paragraphe->getIntitule() ?> "><?php if ($paragraphe->getEstArticle()) {
                                            echo "Article - ";
                                        }
                                        echo $paragraphe->getIntitule() ?> </label></td>
                                <td><input id="<?php echo $paragraphe->getIndice() ?>" name="<?php echo $paragraphe->getIndice() ?>" type="checkbox" <?php

                                    if ($paragraphe->getEstObligatoire()) {
                                        echo "checked=true class=hidden ";
                                    } else if (isset($_POST[$paragraphe->getIndice()])) {
                                        echo "checked=true  class=paragrapheNonObligatoire";
                                    } else {
                                        echo "class=paragrapheNonObligatoire";
                                    }
                                    ?>>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </table>

                    <br>
                    <input type="hidden" name="id" value="<?php echo $_POST["id"] ?>">

                </form>


            </div>

            <div id="apercu" class="col-md-6">

                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h2>Aperçu</h2>
                    </div>

                    <div class="panel-body">
                        <table id="table_apercu">
                            <?php
                            $indiceArticle = 1;

                            foreach ($tabAllParagraphesContrat as $paragraphe) {
                                ?>
                                <tr id="apercu<?php echo $paragraphe->getIndice() ?>" <?php echo "class=\"apercu";
                                if (!$paragraphe->getEstObligatoire()) {
                                    echo " apercuNonObligatoire\"";
                                } else {
                                    echo "\"";
                                }

                                if (!isset($_POST[$paragraphe->getIndice()]) && !$paragraphe->getEstObligatoire()) {
                                    echo " hidden=true";
                                }

                                if ($paragraphe->getEstArticle()) {
                                    echo " estarticle=true";
                                } else {
                                    echo " estarticle=false";
                                }
                                ?>>
                                    <td><?php
                                        if ($paragraphe->getEstArticle()) {
                                            echo "Article ";
                                        }

                                        if (($paragraphe->getEstArticle() && $paragraphe->getEstObligatoire()) || ($paragraphe->getEstArticle() && isset($_POST[$paragraphe->getIndice()]))) {
                                            echo $indiceArticle;
                                            $indiceArticle++;
                                        } else if ($paragraphe->getEstArticle()) {
                                            echo "0";
                                        }

                                        if ($paragraphe->getEstArticle()) {
                                            echo " - ";
                                        }

                                        echo $paragraphe->getIntitule()
                                        ?></td>
                                </tr>
                                <?php
                            }
                            ?>
                        </table>
                    </div>
                </div>

            </div>

        </div>
        <div  id="generer">
            <input class="btn btn-primary" value="Générer" >
        </div>

        <?php
        if (!empty($_POST['generer_contrat'])) {

            include_once("protected/include/pages/traitement_donnees_generation.inc.php");

            ///////////////////////////////////////////
            //Récupération des paragraphes sélectionnés
            ///////////////////////////////////////////

            $paragraphesSelectionnes = array();

            foreach ($_POST as $key => $value) {
                if (gettype($key) != "string") {
                    $paragraphe = $paragrapheContratTravailManager->get($key);
                    $paragraphesSelectionnes[] = new ParagrapheContratTravail($paragraphe->getIndice(), $paragraphe->getEstObligatoire(), $paragraphe->getEstArticle(), $paragraphe->getAfficheTitre(), $paragraphe->getIntitule(), $paragraphe->getContenu());
                }
            }


            ////////////////////////////
            // Création du fichier Word
            ////////////////////////////

            include("vendor/autoload.php");
            $contratTravail = new \PhpOffice\PhpWord\PhpWord();
            $contratTravail->setDefaultFontName('Calibri');

            $contratTravail->addParagraphStyle('justifier', array('align' => 'both', 'spaceAfter' => 100, 'keepLines' => true));
            $contratTravail->addParagraphStyle('titreStyle', array('align' => 'center', 'spaceAfter' => 100));
            $contratTravail->addFontStyle('titreFont', array('bold' => true, 'size' => 15));

            $section = $contratTravail->addSection(array('marginLeft' => 2200, 'marginRight' => 900));

            //Ajout du logo
            $section->addImage(
                'protected\documents_generes\modele\logo_safer.png',
                array(
                    'width' => 120,
                    'height' => 50,
                    'wrappingStyle' => 'behind'
                )
            );

            //Ajout des paragraphes
            $indiceArticle = 1;

            foreach ($paragraphesSelectionnes as $paragraphe) {

                ///////////
                //Intitule
                ///////////
                if ($paragraphe->getIndice() != 1) {
                    if ($paragraphe->getAfficheTitre()) {
                        $intitule = '';
                        if ($paragraphe->getEstArticle()) {
                            $intitule = 'Article ' . $indiceArticle . ' - ';
                            $indiceArticle += 1;
                        }
                        $intitule .= $paragraphe->getIntitule();

                        $section->addText(
                            $intitule,
                            array('bold' => true),
                            array('keepNext' => true)
                        );
                    }
                }

                /////////////////////
                //Contenu paragraphe
                /////////////////////
                $contenuParagraphe = $paragraphe->getContenu();

                //Remplacement des variables par les données du collaborateur
                $contenuParagrapheModifie = str_replace(array_keys($variables), $variables, $contenuParagraphe);

                if ($paragraphe->getIndice() == 1) {//Si le paragraphe est le titre, on lui applique un certain Style
                    $section->addText($contenuParagrapheModifie, 'titreFont', 'titreStyle');
                    $section->addTextBreak();
                } else {
                    $contenuParagrapheDecomposeParSautDeLigne = explode("\n", $contenuParagrapheModifie);
                    $contenuParagrapheDecomposeParSautDeLigne = str_replace("@A_COMPLETER@", "@A_COMPLETER@ ", $contenuParagrapheDecomposeParSautDeLigne);
                    $textrun = $section->addTextRun();

                    //On décompose chaque paragraphe en plus petits paragraphes séparer par des sauts de lignes
                    foreach ($contenuParagrapheDecomposeParSautDeLigne as $ligne) {
                        $mots = explode(" ", $ligne);
                        $fontStyle = array('bold' => false, 'italic' => false, 'underline' => 'none');
                        $afficher = true;
                        $traiterCondition = false;
                        $condition = "";

                        //On décompose chaque ligne de ces petits paragraphes en mots pour pouvoir traiter le style d'affichage de chaque mot
                        foreach ($mots as $mot) {

                            switch ($mot) {
                                //Traitement des styles de caractères
                                case "@B@":
                                    $fontStyle['bold'] = true;
                                    break;
                                case "@/B@":
                                    $fontStyle['bold'] = false;
                                    break;
                                case "@I@":
                                    $fontStyle['italic'] = true;
                                    break;
                                case "@/I@":
                                    $fontStyle['italic'] = false;
                                    break;
                                case "@S@":
                                    $fontStyle['underline'] = 'single';
                                    break;
                                case "@/S@":
                                    $fontStyle['underline'] = 'none';
                                    break;
                                case "@A_COMPLETER@":
                                    $textrun->addText("A COMPLETER ", array('color' => 878787, 'italic' => true));//Les "A_COMPLETER" seront en gris et en italique
                                    break;

                                //Traitement des conditions
                                case "@SI@":
                                    $traiterCondition = true;
                                    break;
                                case "@ALORS@":
                                    $traiterCondition = false;

                                    //On cherche à déternminer le signe de la condition, ex = @VARIABLE@=Valeur
                                    if (sizeof(explode("=", $condition)) == 2) {
                                        $valeurs = explode("=", $condition);
                                        if ($valeurs[0] == $valeurs[1]) {
                                            $afficher = true;
                                        } else {
                                            $afficher = false;
                                        }
                                    }
                                    /* TODO à changer
                                    }else if(sizeof(explode(">", $condition))==2){
                                        var_dump("signe >");
                                    }else if(sizeof(explode("<", $condition)==2){
                                        var_dump("signe <");
                                    */

                                    $condition = "";
                                    break;
                                case "@/SI@":
                                    $afficher = true;
                                    break;
                                case "@SINON@":
                                    if ($afficher) {//Si la condition était remplie, on n'affiche pas ce que contient le @SINON@
                                        $afficher = false;
                                    } else {//Sinon on affiche ce qu'il y a entre le @SINON@ et @/SI@
                                        $afficher = true;
                                    }
                                    break;

                                default:
                                    if ($traiterCondition) {//Permet de gérer s'il y a des espaces dans la condition
                                        $condition .= $mot;
                                    } else if ($afficher) {
                                        $textrun->addText($mot . " ", $fontStyle);
                                    }
                                    break;
                            }
                        }
                        $textrun->addTextBreak();//Saut de ligne
                    }
                }
            }

            //Détails sur le fichier du contrat
            $dateCouranteFr = explode('/', $dateCouranteFr);

            $extensionFichier = "doc";
            $typeFichier = "contrat_travail";
            $nomFichier = $typeFichier . "_" . $nom . "_" . $prenom . "_" . $dateCouranteFr[0] . "_" . $dateCouranteFr[1] . "_" . $dateCouranteFr[2] . "." . $extensionFichier;
            $cheminDocuments = "protected\documents_generes\\";

            //On définit un emplacement pour le nouveau contrat de travail (ici dans le projet lui même)
            $emplacementFichier = $cheminDocuments . $nomFichier;

            //Avant de créer un nouveau contrat de travail on supprime lle dernier contrat généré qui est encore stocké sur le site
            // /!\ SUPPRIME tous les fichiers contenu dans le repertoire des documents générés commençant par "contrat_travail"
            array_map('unlink', glob($cheminDocuments . $typeFichier . "*." . $extensionFichier));

            $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($contratTravail, 'Word2007');
            $objWriter->save($emplacementFichier);

            ?>

            <!-- Affichage du bouton de téléchargement -->
            <div class="row" id="telechargement">
                    <h4>Le contrat de travail de <?php echo $prenom . " " . $nom ?> a été généré.</h4>
                    <a href='<?php echo $emplacementFichier ?>' download='<?php echo $nomFichier ?>'>
                        <input id="telecharger_contrat" class="btn btn-primary" type='button' value="Télécharger contrat de travail">
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

    <script type="text/javascript" src="js/generer_contrat.js"></script>
