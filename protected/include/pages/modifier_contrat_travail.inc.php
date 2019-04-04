<?php
$db = new MyPDO();

$paragrapheContratTravailManager = new ParagrapheContratTravailManager($db);

if (!empty($_POST['indice_suppression'])) {
    if ($_POST['indice_suppression'] != "") {
        $paragrapheContratTravailManager->supprimer($_POST['indice_suppression']);
    }
}

if (!empty($_POST['indice'])) {

    if (isset($_POST['estObligatoire'])) {
        $estObligatoire = true;
    } else {
        $estObligatoire = false;
    }

    if (isset($_POST['estArticle'])) {
        $estArticle = true;
    } else {
        $estArticle = false;
    }

    if (isset($_POST['afficheTitre'])) {
        $afficheTitre = true;
    } else {
        $afficheTitre = false;
    }

    $nouveauParagraphe = new ParagrapheContratTravail($_POST['indice'], $estObligatoire, $estArticle, $afficheTitre, $_POST['intitule'], $_POST['contenu_paragraphe_invisible']);

    $ancienIndice = $_POST['ancien_indice'];
    $indice = $nouveauParagraphe->getIndice();
    $nbParagraphes = $paragrapheContratTravailManager->getNbParagraphes();


    if ($ancienIndice === "") {
        $paragrapheContratTravailManager->add($nouveauParagraphe);
    } else {
        if ($ancienIndice === $indice) {
            $paragrapheContratTravailManager->modifier($ancienIndice, $nouveauParagraphe);
        } else {
            if ($indice > $nbParagraphes) {

                $ancienParagraphe = $paragrapheContratTravailManager->get($ancienIndice);
                $paragrapheContratTravailManager->supprimer($ancienIndice);
                $paragrapheContratTravailManager->add($nouveauParagraphe);

            } else {
                $paragrapheContratTravailManager->echangerIndices($ancienIndice, $indice);
            }
            $paragrapheContratTravailManager->modifier($indice, $nouveauParagraphe);
        }
    }
}
?>

<div id="contenu" class="hidden col-xs-12 col-sm-12 col-md-10 col-md-push-1 col-lg-8 col-lg-push-2">

    <?php
    include("protected/include/navbar.inc.php");
    ?>

    <div id="titre_page">
        <h1>Structure contrat de travail</h1>
    </div>

    <div class="row">

        <div class="col-md-3">

            <select id="liste_paragraphe" name="liste_paragraphe" size="20">
                <?php
                $paragraphes = $paragrapheContratTravailManager->getAll();
                $estPremierIndice = true;

                foreach ($paragraphes as $paragraphe) {
                    echo '<option ';
                    echo 'value="';
                    echo $paragraphe->getIndice() . "|" . $paragraphe->getEstObligatoire() . "|" . $paragraphe->getEstArticle() . "|" . $paragraphe->getAfficheTitre() . "|" . $paragraphe->getIntitule() . "|" . $paragraphe->getContenu() . "\"";

                    if ($estPremierIndice) {
                        echo ' selected';
                        $estPremierIndice = false;
                    }

                    echo '>';
                    echo $paragraphe->getIndice() . " | ";

                    if ($paragraphe->getEstArticle())
                        echo "Article - ";

                    echo $paragraphe->getIntitule() . '</option>' . "\n";
                }
                ?>

                <option id="creer_nouveau_paragraphe" value="|0|0||">| + | Créer un nouveau paragraphe</option>
            </select>

        </div>

        <div class="col-md-6 col-md-offset-1">

            <form id="informations_paragraphe" method="post">

                <?php
                $premierIndice = $paragrapheContratTravailManager->get(1);
                ?>

                <table id="table_informations_paragraphe">
                    <tr class="hidden">
                        <td><input id="ancien_indice" name="ancien_indice" type="number"
                                   value="<?php echo $premierIndice->getIndice(); ?>"></td>
                    </tr>
                    <tr>
                        <td><label for="indice">Indice position</label></td>
                        <td><input id="indice" name="indice" type="number"
                                   value="<?php echo $premierIndice->getIndice(); ?>" required></td>
                    </tr>
                    <tr>
                        <td><label for="estObligatoire">Est obligatoire</label></td>
                        <td><input id="estObligatoire" name="estObligatoire"
                                   type="checkbox" <?php if ($premierIndice->getEstObligatoire()) {
                                echo "checked";
                            } ?>></td>
                    </tr>
                    <tr>
                        <td><label for="estArticle">Est un article</label></td>
                        <td><input id="estArticle" name="estArticle"
                                   type="checkbox" <?php if ($premierIndice->getEstArticle()) {
                                echo "checked";
                            } ?>></td>
                    </tr>
                    <tr>
                        <td><label for="afficheTitre">Afficher le titre</label></td>
                        <td><input id="afficheTitre" name="afficheTitre"
                                   type="checkbox" <?php if ($premierIndice->getAfficheTitre()) {
                                echo "checked";
                            } ?>></td>
                    </tr>
                    <tr>
                        <td><label for="intitule">Intitulé</label></td>
                        <td><input id="intitule" name="intitule" type="text"
                                   value="<?php echo $premierIndice->getIntitule(); ?>" maxlength="50" required></td>
                    </tr>
                    <tr class="hidden">
                        <td><textarea id="contenu_paragraphe_invisible" name="contenu_paragraphe_invisible"
                                      type="text"><?php echo $premierIndice->getContenu(); ?></textarea></td>
                    </tr>
                </table id="table_informations_paragraphe">

                <button id="enregistrer" class="btn btn-success" type="submit">Valider</button>

            </form>

            <button id="supprimer" class="btn btn-danger" data-toggle="modal"
                    data-target="#popup_confirmation_suppression">Supprimer le paragraphe
            </button>


        </div>
    </div>

    <textarea id="contenu_paragraphe" maxlength="5000"><?php echo $premierIndice->getContenu(); ?></textarea>
    <div class="row balises">
        <div class="col-md-12">
        <table id="inserer_variable">
            <tr>
                <td>
                    <button id="gras" class="btn btn-success balise">Gras</button>
                </td>
                <td>
                    <button id="italique" class="btn btn-success balise">Italique</button>
                </td>
                <td>
                    <button id="souligne" class="btn btn-success balise droite">Souligné</button>
                </td>
                <td><label for="categorie_variable">Catégorie variable</label><select id="categorie_variable" name="categorie_variable">
                        <option value="Etat Civil">Etat Civil</option>
                        <option value="Immatriculation">Immatriculation</option>
                        <option value="Coordonnées">Coordonnées</option>
                        <option value="Contrat">Contrat</option>
                        <option value="Poste">Poste</option>
                        <option value="Emploi">Emploi</option>
                        <option value="Statut et Bulletin">Statut</option>
                        <option value="Horaire">Horaire</option>
                        <option value="Administratif">Administratif</option>
                        <option value="Autres">Autres</option>
                    </select></td>
                <td><label for="variable">Choisir variable</label>
                    <select id="variable" name="variable">
                        <option value="">Sélectionner une catégorie</option>
                    </select></td>
                <td>
                    <button id="inserer" class="btn btn-success droite">Insérer la variable</button>
                </td>
                <td>
                    <button id="condition" class="btn btn-success balise">Ajouter une condition</button>
                </td>
            </tr>

        </table>
        </div>
    </div>



    <div id="popup_confirmation_suppression" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">

                <form id="confirmation_suppression" method="post">

                    <input id="indice_suppression" class="hidden" name="indice_suppression" type="number"
                           value="<?php echo $premierIndice->getIndice(); ?>">

                    <p>Voulez-vous vraiment supprimer ce paragraphe?</p><br>
                    <button class="btn" type="button" data-dismiss="modal">Non</button>
                    <button class="btn btn-danger" type="submit">Oui</button>

                </form>

            </div>
        </div>
    </div>

    <script src="js/modifier_contrat_travail.js" type="text/javascript"></script>
