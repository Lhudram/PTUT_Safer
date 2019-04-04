<?php
$db = new MyPDO();

$collaborateurManager = new CollaborateurManager($db);

$listeParamManager = new ListesParamManager($db);

$tabAllBulletinModeleSalaire = $listeParamManager->getAll(ListesParamManager::BULLETIN_MODELE_SALAIRE);
$tabAllCategoriePoste = $listeParamManager->getAll(ListesParamManager::CAT_POSTE);
$tabAllConvention = $listeParamManager->getAll(ListesParamManager::CONVENTION);
$tabAllDepartement = $listeParamManager->getAll(ListesParamManager::DEPARTEMENT);
$tabAllDepartementPoste = $listeParamManager->getAll(ListesParamManager::DEPARTEMENT_POSTE);
$tabAllEmploiCCN = $listeParamManager->getAll(ListesParamManager::EMPLOI_CCN);
$tabAllEtablissement = $listeParamManager->getAll(ListesParamManager::ETABLISSEMENT);
$tabAllModaliteExerciceTravail = $listeParamManager->getAll(ListesParamManager::MODALITE_EXERCICE_TRAVAIL);
$tabAllNatureContrat = $listeParamManager->getAll(ListesParamManager::NATURE_CONTRAT);
$tabAllPays = $listeParamManager->getAll(ListesParamManager::PAYS);
$tabAllSituationFamiliale = $listeParamManager->getAll(ListesParamManager::SITUATION_FAMILIALE);
$tabAllTypeEntreeContrat = $listeParamManager->getAll(ListesParamManager::TYPE_ENTREE_CONTRAT);

if (empty($_POST["id"])) {
    echo '<div class="alert alert-danger text-center"><strong>ERREUR !</strong> Aucun id de collaborateur n\'a été fourni. Merci de reporter cette erreur.</div>';
} else {
    if (!empty($_POST['nom'])) {
        $aEteModifie = $collaborateurManager->modifierCollaborateur($collaborateurManager->getCollaborateurSaisi(), $_POST["id"]);
    }
    $collaborateur = $collaborateurManager->getFullCollaborateur((int)$_POST["id"]);
    $civilite = $collaborateur->getEtatCivil()->getCivilite();
    ?>

    <div id="contenu" class="hidden col-xs-12 col-sm-12 col-md-10 col-md-push-1 col-lg-8 col-lg-push-2">

    <?php
    include("protected/include/subnavbar.inc.php");
    ?>

    <div id="titre_page">
        <h1>Modifier collaborateur</h1>
    </div>

    <div class="row">

        <div class="col-md-5">
            <h2 id="intitule_etat_civil" class="rubrique">Etat civil</h2>
            <h2 id="intitule_immatriculation" class="rubrique">Immatriculation</h2>
            <h2 id="intitule_coordonnees" class="rubrique">Coordonnées</h2>
            <h2 id="intitule_contrat_poste_emploi" class="rubrique">Contrat, poste et emploi</h2>
            <h2 id="intitule_statut_salaire_horaire" class="rubrique">Statut, salaire et horaires</h2>
            <h2 id="intitule_administratif" class="rubrique">Administratif</h2>
        </div>

        <form id="formulaire_modification" method="POST">

            <div class="col-md-7">

                <fieldset id="etat_civil" class="contenu_fieldset">
                    <legend>Etat Civil</legend>

                    <p>*champs nécessaires à la génération de documents</p>

                    <table>
                        <tr>
                            <td><label for="civilite">Civilité *</label></td>
                            <td><select id="civilite" name="civilite">
                                    <option value="1" <?php if ($civilite == 1) echo "selected"; ?>>M</option>
                                    <option value="2" <?php if ($civilite == 2) echo "selected"; ?>>Mme</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td><label for="nom">Nom *</label></td>
                            <td><input id="nom" name="nom" type="text" maxlength="50"
                                       value="<?php echo $collaborateur->getEtatCivil()->getNom() ?>" required></td>
                        </tr>
                        <tr>
                            <td><label for="prenom">Prenom *</label></td>
                            <td><input id="prenom" name="prenom" type="text" maxlength="50"
                                       value="<?php echo $collaborateur->getEtatCivil()->getPrenom() ?>"></td>
                        </tr>
                        <tr>
                            <td><label for="nom_jeune_fille">Nom jeune fille</label></td>
                            <td><input id="nom_jeune_fille" name="nom_jeune_fille" type="text" maxlength="50"
                                       value="<?php echo $collaborateur->getEtatCivil()->getNomJeuneFille() ?>"></td>
                        </tr>
                        <tr>
                            <td><label for="situation_familiale">Situation familiale *</label></td>
                            <td>
                                <select id="situation_familiale" name="situation_familiale">

                                    <?php
                                    foreach ($tabAllSituationFamiliale as $situationFamiliale) {
                                        echo "<option value=\"" . $situationFamiliale->getId() . "\" ";

                                        if ($situationFamiliale->getId() == $collaborateur->getEtatCivil()->getIdSituationFamiliale()) {
                                            echo "selected ";
                                        }
                                        echo ">" . $situationFamiliale->getIntitule() . "</option>";
                                    }
                                    ?>

                                </select>
                            </td>
                            <td>
                                <button class="boutonmodif btn situation_familiale" type="button" data-toggle="modal"
                                        data-target="#popup_edition_situations_familiale">
                                    <img class="imagehover" src="commonfiles/images/modifier-noir.png">
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="nombre_enfants">Nombre enfants</label></td>
                            <td><input id="nombre_enfants" name="nombre_enfants" type="number"
                                       value="<?php echo $collaborateur->getEtatCivil()->getNbEnfants() ?>"></td>
                        </tr>
                    </table>

                </fieldset>

                <fieldset id="immatriculation" class="contenu_fieldset">
                    <legend>Immatriculation</legend>

                    <p>*champs nécessaires à la génération de documents</p>

                    <table>
                        <tr>
                            <td><label for="date_naissance">Date naissance *</label></td>
                            <td><input id="date_naissance" name="date_naissance" type="date"
                                       value="<?php echo $collaborateur->getImmatriculation()->getDateNaissance(); ?>">
                            </td>
                        </tr>
                        <tr>
                            <td><label for="departement">Département naissance *</label></td>
                            <td>
                                <select id="departement" name="departement">

                                    <?php
                                    foreach ($tabAllDepartement as $departement) {
                                        echo "<option value=\"" . $departement->getNumero() . "\"";
                                        if ($departement->getNumero() == $collaborateur->getImmatriculation()->getDepNaissance())
                                            echo " selected";
                                        echo ">" . $departement->getNumero() . " (" . $departement->getIntitule() . ")</option>";
                                    }
                                    ?>

                                </select>
                            </td>
                            <td>
                                <button class="boutonmodif btn departement" type="button" data-toggle="modal"
                                        data-target="#popup_edition_departements">
                                    <img class="imagehover" src="commonfiles/images/modifier-noir.png">
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="code_pays">Code pays naissance *</label></td>
                            <td>
                                <select id="code_pays" name="code_pays">

                                    <?php
                                    foreach ($tabAllPays as $pays) {
                                        echo "<option value=\"" . $pays->getCode() . "\"";
                                        if ($pays->getCode() == $collaborateur->getImmatriculation()->getPaysNaissance())
                                            echo " selected";
                                        echo ">" . $pays->getCode() . " (" . $pays->getIntitule() . ")</option>";
                                    }
                                    ?>

                                </select>
                            </td>
                            <td>
                                <button class="boutonmodif btn code_pays" type="button" data-toggle="modal"
                                        data-target="#popup_edition_code_pays">
                                    <img class="imagehover" src="commonfiles/images/modifier-noir.png">
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="commune_naissance">Commune naissance *</label></td>
                            <td><input id="commune_naissance" name="commune_naissance" type="text" maxlength="50"
                                       value="<?php echo $collaborateur->getImmatriculation()->getCommuneNaissance(); ?>">
                            </td>
                        </tr>
                        <tr>
                            <td><label for="code_commune">Code commune naissance *</label></td>
                            <td><input id="code_commune" name="code_commune" type="number"
                                       value="<?php echo $collaborateur->getImmatriculation()->getCodeCommuneNaissance(); ?>">
                            </td>
                        </tr>
                        <tr>
                            <td><label for=" nationalite">Nationalite *</label></td>
                            <td><input id="nationalite" name="nationalite" type="text" maxlength="50"
                                       value="<?php echo $collaborateur->getImmatriculation()->getNationalite(); ?>">
                            </td>
                        </tr>
                        <tr>
                            <td><label for="numero_immatriculation">Numéro immatriculation *</label></td>
                            <td id="numero_immat">

                                <input id="numeros_immatriculation_sexe" name="numeros_immatriculation_sexe" type="text"
                                       maxlength="1"
                                       value="<?php echo $collaborateur->getImmatriculation()->getImmatriculationAff()[0]; ?>"
                                       class="numero_immat_unchiffre">
                                <input id="numeros_immatriculation_annee_naissance"
                                       name="numeros_immatriculation_annee_naissance" type="text"
                                       maxlength="2" class="numero_immat_margin numero_immat_deuxchiffres"
                                       value="<?php echo $collaborateur->getImmatriculation()->getImmatriculationAff()[1]; ?>">
                                <input id="numeros_immatriculation_mois_naissance"
                                       name="numeros_immatriculation_mois_naissance" type="text" maxlength="2"
                                       class="numero_immat_margin numero_immat_deuxchiffres"
                                       value="<?php echo $collaborateur->getImmatriculation()->getImmatriculationAff()[2]; ?>">
                                <input id="numeros_immatriculation_departement_naissance"
                                       name="numeros_immatriculation_departement_naissance" type="text" maxlength="3"
                                       value="<?php echo $collaborateur->getImmatriculation()->getImmatriculationAff()[3]; ?>"
                                       class="numero_immat_margin numero_immat_troischiffres">
                                <input id="numeros_immatriculation_commune_naissance"
                                       name="numeros_immatriculation_commune_naissance" type="text"
                                       maxlength="3" class="numero_immat_margin numero_immat_troischiffres"
                                       value="<?php echo $collaborateur->getImmatriculation()->getImmatriculationAff()[4]; ?>">
                                <input id="numeros_immatriculation_acte_naissance"
                                       name="numeros_immatriculation_acte_naissance" type="text" maxlength="3"
                                       class="numero_immat_margin numero_immat_troischiffres"
                                       value="<?php echo $collaborateur->getImmatriculation()->getImmatriculationAff()[5]; ?>">
                                <input id="numeros_immatriculation_controle" name="numeros_immatriculation_controle"
                                       type="text" maxlength="2" class="numero_immat_margin numero_immat_deuxchiffres"
                                       value="<?php echo $collaborateur->getImmatriculation()->getImmatriculationAff()[6]; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td><label for="email">Email</label></td>
                            <td><input id="email" name="email" type="email" maxlength="50"
                                       value="<?php echo $collaborateur->getImmatriculation()->getEmail(); ?>">
                            </td>
                        </tr>
                    </table>

                </fieldset>

                <fieldset id="coordonnees" class="contenu_fieldset">
                    <legend>Coordonnées</legend>

                    <p>*champs nécessaires à la génération de documents</p>

                    <table>
                        <tr>
                            <td><label for="adresse">Adresse *</label></td>
                            <td><textarea id="adresse" name="adresse"
                                          maxlength="100"><?php echo $collaborateur->getCoordonnees()->getAdresse(); ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="complement_adresse">Complement adresse</label></td>
                            <td><textarea id="complement_adresse" name="complement_adresse"
                                          maxlength="50"><?php echo $collaborateur->getCoordonnees()->getComplementAdresse(); ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="code_postal">Code postal *</label></td>
                            <td><input id="code_postal" name="code_postal" type="number"
                                       value="<?php echo $collaborateur->getCoordonnees()->getCodePostal(); ?>"
                                       max="99999"></td>
                        </tr>
                        <tr>
                            <td><label for="commune">Commune *</label></td>
                            <td><input name="commune" type="text" maxlength="50"
                                       value="<?php echo $collaborateur->getCoordonnees()->getCommune(); ?>"></td>
                        </tr>
                        <tr>
                            <td><label for="code_pays">Code pays *</label></td>
                            <td>
                                <select id="code_pays" name="code_pays">

                                    <?php
                                    foreach ($tabAllPays as $pays) {
                                        echo "<option value=\"" . $pays->getCode() . "\"";
                                        if ($pays->getCode() == $collaborateur->getCoordonnees()->getCodePays())
                                            echo " selected";
                                        echo ">" . $pays->getCode() . " (" . $pays->getIntitule() . ")</option>";
                                    }
                                    ?>

                                </select>
                            </td>
                            <td>
                                <button class="boutonmodif btn code_pays" type="button" data-toggle="modal"
                                        data-target="#popup_edition_code_pays">
                                    <img class="imagehover" src="commonfiles/images/modifier-noir.png">
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="iban">Iban *</label></td>
                            <td><input id="iban" name="iban" type="text" maxlength="33"
                                       value="<?php echo $collaborateur->getCoordonnees()->getIban(); ?>">
                            </td>
                        </tr>
                        <tr>
                            <td><label for="bic">Bic *</label></td>
                            <td><input id="bic" name="bic" type="text" maxlength="11"
                                       value="<?php echo $collaborateur->getCoordonnees()->getBic(); ?>"></td>
                        </tr>
                    </table>

                </fieldset>

                <fieldset id="contrat" class="contrat_poste_emploi contenu_fieldset">
                    <legend>Contrat</legend>

                    <p>*champs nécessaires à la génération de documents</p>

                    <table>
                        <tr>
                            <td><label for="nature_contrat">Nature contrat *</label></td>
                            <td>
                                <select id="nature_contrat" name="nature_contrat">

                                    <?php
                                    foreach ($tabAllNatureContrat as $natureContrat) {

                                        echo "<option value=\"" . $natureContrat->getId() . "\" ";

                                        if ($natureContrat->getId() == $collaborateur->getContrat()->getIdNature()) {
                                            echo "selected ";
                                        }
                                        echo ">" . $natureContrat->getIntitule() . "</option>";
                                    }
                                    ?>

                                </select>
                            </td>
                            <td>
                                <button class="boutonmodif btn nature_contrat" type="button" data-toggle="modal"
                                        data-target="#popup_edition_nature_contrat">
                                    <img class="imagehover" src="commonfiles/images/modifier-noir.png">
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="date_debut">Date début *</label></td>
                            <td><input id="date_debut" name="date_debut" type="date"
                                       value="<?php echo $collaborateur->getContrat()->getDateDebut() ?>"></td>
                        </tr>
                        <tr>
                            <td><label for="fin_periode_essai">Fin période d'essai *</label></td>
                            <td><input id="fin_periode_essai" name="fin_periode_essai" type="date"
                                       value="<?php echo $collaborateur->getContrat()->getFinPeriodeEssai() ?>"></td>
                        </tr>
                        <tr>
                            <td><label for="type_entree_contrat">Type entree contrat *</label></td>
                            <td>
                                <select id="type_entree_contrat" name="type_entree_contrat">

                                    <?php
                                    foreach ($tabAllTypeEntreeContrat as $typeEntreeContrat) {

                                        echo "<option value=\"" . $typeEntreeContrat->getId() . "\" ";

                                        if ($typeEntreeContrat->getId() == $collaborateur->getContrat()->getIdTypeEntree()) {
                                            echo "selected ";
                                        }
                                        echo ">" . $typeEntreeContrat->getIntitule() . "</option>";
                                    }
                                    ?>

                                </select>
                            </td>
                            <td>
                                <button class="boutonmodif btn type_entree_contrat" type="button" data-toggle="modal"
                                        data-target="#popup_edition_entree_contrat">
                                    <img class="imagehover" src="commonfiles/images/modifier-noir.png">
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="etablissement">Etablissement *</label></td>
                            <td>
                                <select id="etablissement" name="etablissement">

                                    <?php
                                    foreach ($tabAllEtablissement as $etablissement) {

                                        echo "<option value=\"" . $etablissement->getId() . "\" ";

                                        if ($etablissement->getId() == $collaborateur->getContrat()->getIdEtablissement()) {
                                            echo "selected ";
                                        }
                                        echo ">" . $etablissement->getIntitule() . "</option>";
                                    }
                                    ?>

                                </select>
                            </td>
                            <td>
                                <button class="boutonmodif btn etablissement" type="button" data-toggle="modal"
                                        data-target="#popup_edition_etablissement">
                                    <img class="imagehover" src="commonfiles/images/modifier-noir.png">
                                </button>
                            </td>
                        </tr>
                    </table>

                </fieldset>

                <fieldset id="poste" class="contrat_poste_emploi contenu_fieldset">
                    <legend>Poste</legend>

                    <table>
                        <tr>
                            <td><label for="departement_poste">Département poste *</label></td>
                            <td>
                                <select id="departement_poste" name="departement_poste">

                                    <?php
                                    foreach ($tabAllDepartementPoste as $departementPoste) {

                                        echo "<option value=\"" . $departementPoste->getId() . "\" ";

                                        if ($departementPoste->getId() == $collaborateur->getPoste()->getIdDepartementPoste()) {
                                            echo "selected ";
                                        }
                                        echo ">" . $departementPoste->getIntitule() . "</option>";
                                    }
                                    ?>

                                </select>
                            </td>
                            <td>
                                <button class="boutonmodif btn departement_poste" type="button" data-toggle="modal"
                                        data-target="#popup_edition_departement_poste">
                                    <img class="imagehover" src="commonfiles/images/modifier-noir.png">
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="categorie_poste">Catégorie poste *</label></td>
                            <td>
                                <select id="categorie_poste" name="categorie_poste">

                                    <?php
                                    foreach ($tabAllCategoriePoste as $categoriePoste) {

                                        echo "<option value=\"" . $categoriePoste->getId() . "\" ";

                                        if ($categoriePoste->getId() == $collaborateur->getPoste()->getIdCategorie()) {
                                            echo "selected ";
                                        }
                                        echo ">" . $categoriePoste->getIntitule() . "</option>";
                                    }
                                    ?>

                                </select>
                            </td>
                            <td>
                                <button class="boutonmodif btn categorie_poste" type="button" data-toggle="modal"
                                        data-target="#popup_edition_categorie_poste">
                                    <img class="imagehover" src="commonfiles/images/modifier-noir.png">
                                </button>
                            </td>
                        </tr>
                    </table>

                </fieldset>

                <fieldset id="emploi" class="contrat_poste_emploi contenu_fieldset">
                    <legend>Emploi</legend>

                    <table>
                        <tr>
                            <td><label for="emploi_CCN">Emploi (nomenclature CCN) *</label></td>
                            <td>
                                <select id="emploi_CCN" name="emploi_CCN">

                                    <?php
                                    foreach ($tabAllEmploiCCN as $emploiCCN) {

                                        echo "<option value=\"" . $emploiCCN->getId() . "\" ";

                                        if ($emploiCCN->getId() == $collaborateur->getEmploi()->getIdEmploiCCN()) {
                                            echo "selected ";
                                        }
                                        echo ">" . $emploiCCN->getIntitule() . "</option>";
                                    }
                                    ?>

                                </select>
                            </td>
                            <td>
                                <button class="boutonmodif btn emploi_CCN" type="button" data-toggle="modal"
                                        data-target="#popup_edition_emploi_CCN">
                                    <img class="imagehover" src="commonfiles/images/modifier-noir.png">
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="coefficient">Coefficient salaire *</label></td>
                            <td><input id="coefficient" name="coefficient" type="number" min="0"
                                       value="<?php echo $collaborateur->getEmploi()->getCoefficient(); ?>"></td>
                        </tr>
                    </table>

                </fieldset>

                <fieldset id="statut" class="statut_salaire_horaire contenu_fieldset">
                    <legend>Statut</legend>

                    <p>*champs nécessaires à la génération de documents</p>

                    <table>
                        <tr>
                            <td><label for="convention">Convention *</label></td>
                            <td>
                                <select id="convention" name="convention">

                                    <?php
                                    foreach ($tabAllConvention as $convention) {

                                        echo "<option value=\"" . $convention->getId() . "\" ";

                                        if ($convention->getId() == $collaborateur->getStatut()->getIdConvention()) {
                                            echo "selected ";
                                        }
                                        echo ">" . $convention->getIntitule() . "</option>";
                                    }
                                    ?>

                                </select>
                            </td>
                            <td>
                                <button class="boutonmodif btn convention" type="button" data-toggle="modal"
                                        data-target="#popup_edition_convention">
                                    <img class="imagehover" src="commonfiles/images/modifier-noir.png">
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="agirc">AGIRC</label></td>
                            <td><input id="agirc" name="agirc"
                                       type="checkbox" <?php if ($collaborateur->getStatut()->getEstAgirc()) echo 'checked'; ?>>
                            </td>
                        </tr>
                    </table>

                </fieldset>

                <fieldset id="salaire" class="statut_salaire_horaire contenu_fieldset">
                    <legend>Salaire</legend>

                    <table>
                        <tr>
                            <td><label for="bulletin_modele">Bulletin modèle *</label></td>
                            <td>
                                <select id="bulletin_modele" name="bulletin_modele">

                                    <?php
                                    foreach ($tabAllBulletinModeleSalaire as $bulletinModeleSalaire) {

                                        echo "<option value=\"" . $bulletinModeleSalaire->getId() . "\" ";

                                        if ($bulletinModeleSalaire->getId() == $collaborateur->getIdBulletinModele()) {
                                            echo "selected ";
                                        }
                                        echo ">" . $bulletinModeleSalaire->getIntitule() . "</option>";
                                    }
                                    ?>

                                </select>
                            </td>
                            <td>
                                <button class="boutonmodif btn bulletin_modele" type="button" data-toggle="modal"
                                        data-target="#popup_edition_bulletin_modele">
                                    <img class="imagehover" src="commonfiles/images/modifier-noir.png">
                                </button>
                            </td>
                        </tr>
                    </table>

                </fieldset>

                <fieldset id="horaire" class="statut_salaire_horaire contenu_fieldset">
                    <legend>Horaire</legend>

                    <table>
                        <tr>
                            <td><label for="nb_heures_travaillees">Nombre heures travaillées *</label></td>
                            <td><input id="nb_heures_travaillees" name="nb_heures_travaillees" type="number" min="0"
                                       step="0.01"
                                       value="<?php echo $collaborateur->getHoraire()->getNbHeuresTravaillees() ?>">
                            </td>
                        </tr>
                        <tr>
                            <td><label for="modalite_exercice_travail">Modalité exercice travail *</label></td>
                            <td>
                                <select id="modalite_exercice_travail" name="modalite_exercice_travail">

                                    <?php
                                    foreach ($tabAllModaliteExerciceTravail as $modaliteExerciceTravail) {

                                        echo "<option value=\"" . $modaliteExerciceTravail->getId() . "\" ";

                                        if ($modaliteExerciceTravail->getId() == $collaborateur->getHoraire()->getIdModaliteExerciceTravail()) {
                                            echo "selected ";
                                        }
                                        echo ">" . $modaliteExerciceTravail->getIntitule() . "</option>";
                                    }
                                    ?>

                                </select>
                            </td>
                            <td>
                                <button class="boutonmodif btn modalite_exercice_travail" type="button"
                                        data-toggle="modal"
                                        data-target="#popup_edition_modalite_exercice_travail">
                                    <img class="imagehover" src="commonfiles/images/modifier-noir.png">
                                </button>
                            </td>
                        </tr>
                    </table>

                </fieldset>

                <fieldset id="administratif" class="contenu_fieldset">
                    <legend>Administratif</legend>

                    <h4>Personne à prévenir en cas d'accident n°1</h4>

                    <br>

                    <table>
                        <tr>
                            <td><label for="nom_personne_a_prevenir_1">Nom </label></td>
                            <td><input id="nom_personne_a_prevenir_1" name="nom_personne_a_prevenir_1" type="text"
                                       maxlength="50"
                                       value="<?php echo $collaborateur->getPersonnesAPrevenir()->getNom1() ?>"></td>
                        </tr>
                        <tr>
                            <td><label for="telephone_personne_a_prevenir_1">Téléphone</label></td>
                            <td><input id="telephone_personne_a_prevenir_1" name="telephone_personne_a_prevenir_1"
                                       type="text" class="input-medium bfh-phone" data-format="(+dd) d dd dd dd dd"
                                       value="<?php echo $collaborateur->getPersonnesAPrevenir()->getTel1() ?>">
                            </td>
                        </tr>
                    </table>

                    <br><br>

                    <h4>Personne à prévenir en cas d'accident n°2</h4>

                    <br>

                    <table>
                        <tr>
                            <td><label for="nom_personne_a_prevenir_2">Nom </label></td>
                            <td><input id="nom_personne_a_prevenir_2" name="nom_personne_a_prevenir_2" type="text"
                                       maxlength="50"
                                       value="<?php echo $collaborateur->getPersonnesAPrevenir()->getNom2() ?>"></td>
                        </tr>
                        <tr>
                            <td><label for="telephone_personne_a_prevenir_2">Téléphone</label></td>
                            <td><input id="telephone_personne_a_prevenir_2" name="telephone_personne_a_prevenir_2"
                                       type="text" class="input-medium bfh-phone"
                                       data-format="(+dd) d dd dd dd dd"
                                       value="<?php echo $collaborateur->getPersonnesAPrevenir()->getTel2() ?>">
                            </td>
                        </tr>
                    </table>

                </fieldset>

            </div>

            <button id="sauvegarder" class="btn btn-success">Sauvegarder</button>

        </form>

    </div>

    <div id="retour_js"></div>

    <?php
    if (isset($aEteModifie))
        if ($aEteModifie) {
            echo '<div id="retour_confirmation" class="alert alert-success text-center">Modifications enregistrées.</div>';
            ?>
            <script type="text/javascript">
                setTimeout(function () {
                    $("#retour_confirmation").remove();
                }, 4000);
            </script>
            <?php
        } else
            echo '<div id="retour_confirmation" class="alert alert-danger text-center"><strong>ERREUR !</strong> La modification a échouée. Merci de reporter cette erreur.</div>';

    require_once("protected/include/formulaire.inc.php");
    ?>

    <script src="commonfiles/js/bootstrap-formhelpers-phone.js"></script>
    <script type="text/javascript" src="js/ajouter_modifier_collaborateur.js"></script>
    <script type="text/javascript" src="js/notification.js"></script>
    <script type="text/javascript">
        document.getElementById('sauvegarder').addEventListener('click', rechargement, false);

        function rechargement() {
            var value = <?php echo $_POST["id"]; ?>;
            var cache = document.createElement("input");
            cache.setAttribute("type", "hidden");
            cache.setAttribute("name", "id");
            cache.setAttribute("value", value);
            document.getElementById("formulaire_modification").appendChild(cache);
        }

        $("h2").click(sauvegarder);

        function sauvegarder() {
            if (document.getElementById("nom").value === "" || document.getElementById("prenom").value === "") {
                notification("warning", "<strong>ERREUR !</strong> Vous devez spécifier un nom et un prénom.");
            } else {
                ajout_id_form();
                var donnees = $($("#formulaire_modification")).serialize();
                $.ajax({
                    method: "POST",
                    url: "index.php?page=12",
                    data: donnees
                })
                    .done(function () {
                        notification("success", "Le collaborateur a bien été sauvegardé.");
                    })
                    .fail(function () {
                        notification("danger", "<strong>ERREUR CRITIQUE !</strong> Une erreur est survenue lors de la sauvegarde. Merci de reporter cette erreur.");
                    });
            }
        }

        function ajout_id_form() {
            var form = document.getElementById("formulaire_modification");
            var input = document.createElement("input");
            input.setAttribute("name", "id");
            input.setAttribute("type", "hidden");
            input.setAttribute("value", <?php echo $_POST["id"]; ?>);
            form.appendChild(input);
        }
    </script>
<?php }
?>