<?php

$db = new Mypdo();
$listeParamManager = new ListesParamManager($db);
$estParametres = $_GET["page"] == $pages["parametres"];

if ($estParametres) { ?>
    <h2 class="rubrique pli" id="titre_situation_familiale">Situation familiale</h2>
    <fieldset id="fieldset_situation_familiale" class="contenu_fieldset">
    <div id="editer_situation_familiale" class="contenu_pli">
    <div class='col-md-6'>
    <?php
} else { ?>
    <div id="popup_edition_situations_familiale" class="modal fade" role="dialog">
    <div class="modal-dialog">
    <div class="modal-content">
    <h3>Ajouter situation familiale</h3>
    <?php
}
?>
    <form action="#" method="post">
        <table>
            <tr>
                <td><label for='ajout_intitule_situation_familiale'>Intitulé situation
                        familiale </label></td>
                <td><input id='ajout_intitule_situation_familiale' class="situation_familiale"
                           name='ajout_intitule_situation_familiale' type='text' maxlength='50'
                           required></td>
            </tr>
            <tr>
                <?php
                if (!$estParametres) { ?>
                    <td>
                        <button class='btn' type='button' data-dismiss='modal'>Annuler</button>
                    </td>
                    <?php
                } ?>
                <td><input type="button" value='Ajouter' data-dismiss='modal'
                           class='btn btn-success'/></td>
            </tr>
        </table>
        <p class="retour_js"></p>
    </form>
<?php
if ($estParametres) {
    $situations = $listeParamManager->getAll(ListesParamManager::SITUATION_FAMILIALE);
    ?>
    </div>
    <div class='col-md-6'>
        <form>
            <table>
                <tr>
                    <td><label for='liste_situations_fam'>Intitulé situation
                            familiale</label>
                    </td>
                    <td>
                        <select id='liste_situations_fam' name='id_situation'><?php
                            foreach ($situations as $situation) {
                                echo '<option value="';
                                echo $situation->getId();
                                echo '">' . $situation->getIntitule() . '</option>' . "\n";
                            }
                            ?></select>
                </tr>
                <tr>
                    <td><input type='button' value='Supprimer' class='btn btn-success'/></td>
                </tr>
            </table>
            <p class="retour_js"></p>
        </form>
    </div>
    </div>
    </fieldset>
<?php } else { ?>
    </div>
    </div>
    </div>
<?php }




if ($estParametres) { ?>
    <h2 class="rubrique pli" id="titre_departement">Département</h2>
    <fieldset id="fieldset_departement" class="contenu_fieldset">
    <div id="editer_departement" class="contenu_pli">
    <div class='col-md-6'>
<?php } else { ?>
    <div id="popup_edition_departements" class="modal fade" role="dialog">
    <div class="modal-dialog">
    <div class="modal-content">
    <h3>Ajouter département</h3><?php
} ?>
    <form>
        <table>
            <tr>
                <td><label for='ajout_numero_departement'>Numéro département</label></td>
                <td><input id='ajout_numero_departement' class='departement'
                           name='ajout_numero_departement' type='text'
                           maxlength='3' required></td>
            </tr>
            <tr>
                <td><label for='ajout_nom_departement'>Nom département</label></td>
                <td><input id='ajout_nom_departement' name='ajout_nom_departement' type='text'
                           maxlength='50' required></td>
            </tr>
            <tr>
                <?php if (!$estParametres) { ?>
                    <td>
                        <button class='btn' type='button' data-dismiss='modal'>Annuler</button>
                    </td>
                <?php } ?>
                <td><input type="button" value='Ajouter' data-dismiss='modal'
                           class='btn btn-success'/></td>
            </tr>
        </table>
        <p class="retour_js"></p>
    </form>
<?php
if ($estParametres) {
    $departements = $listeParamManager->getAll(ListesParamManager::DEPARTEMENT);
    ?>
    </div>
    <div class='col-md-6'>
        <form>
            <table>
                <tr>
                    <td><label for='liste_departements'>Intitulé département</label></td>
                    <td>
                        <select id='liste_departements' name='id_departement'>

                            <?php foreach ($departements as $departement) {
                                echo '<option ';
                                echo 'value="';
                                echo $departement->getNumero();
                                echo '">';
                                echo $departement->getIntitule() . ' (' . $departement->getNumero() .
                                    ')</option>' . "\n";
                            } ?>
                        </select>
                </tr>
                <tr>
                    <td><input type='button' value='Supprimer' class='btn btn-success'/></td>
                </tr>
            </table>
            <p class="retour_js"></p>
        </form>
    </div>
    </div>
    </fieldset>
<?php }
if (!$estParametres) { ?>
    </div>
    </div>
    </div>
<?php }




if ($estParametres) { ?>
    <h2 class="rubrique pli" id="titre_pays">Pays</h2>
    <fieldset id="fieldset_pays" class="contenu_fieldset">
    <div id="editer_pays" class="contenu_pli">
    <div class='col-md-6'><?php
} else { ?>
    <div id="popup_edition_code_pays" class="modal fade" role="dialog">
    <div class="modal-dialog">
    <div class="modal-content">
    <h3>Ajouter pays</h3>
<?php } ?>
    <form>
        <table>
            <tr>
                <td><label for='ajout_code_pays'>Code pays</label></td>
                <td><input id='ajout_code_pays' class='code_pays' name='ajout_code_pays' type='text'
                           maxlength='3'
                           required></td>
            </tr>
            <tr>
                <td><label for='ajout_intitule_pays'>Intitulé pays</label></td>
                <td><input id='ajout_intitule_pays' name='ajout_intitule_pays' type='text'
                           maxlength='50' required></td>
            </tr>
            <tr>
                <?php
                if (!$estParametres) { ?>
                    <td>
                        <button class='btn' type='button' data-dismiss='modal'>Annuler</button>
                    </td>

                <?php } ?>
                <td><input type='button' value='Ajouter' data-dismiss='modal'
                           class='btn btn-success'/></td>
            </tr>
        </table>
        <p class="retour_js"></p>
    </form>

<?php
if ($estParametres) {
    $pays = $listeParamManager->getAll(ListesParamManager::PAYS);
    ?>
    </div>
    <div class='col-md-6'>
        <form>
            <table>
                <tr>
                    <td><label for='liste_intitule_pays'>Intitulé pays</label></td>
                    <td>
                        <select id='liste_intitule_pays' name='id_pays'>
                            <?php
                            foreach ($pays as $pay) {
                                echo '
                                        <option
                                        ';
                                echo 'value="';
                                echo $pay->getCode();
                                echo '">';
                                echo $pay->getIntitule() . ' (' . $pay->getCode() . ')</option>' . "\n";
                            } ?>
                        </select>
                </tr>
                <tr>
                    <td><input type='button' value='Supprimer' class='btn btn-success'/></td>
                </tr>
            </table>
            <p class="retour_js"></p>
        </form>
    </div>
    </div>
    </fieldset>
    <?php
} else { ?>
    </div>
    </div>
    </div>
<?php }




if ($estParametres) { ?>
    <h2 class="rubrique pli" id="titre_nature_contrat">Nature contrat</h2>
    <fieldset id="fieldset_nature_contrat" class="contenu_fieldset">
    <div id="editer_nature_contrat" class="contenu_pli">
    <div class='col-md-6'>
<?php } else { ?>
    <div id="popup_edition_nature_contrat" class="modal fade" role="dialog">
    <div class="modal-dialog">
    <div class="modal-content">
    <h3>Ajouter nature de contrat</h3>
<?php } ?>
    <form>
        <table>
            <tr>
                <td><label for='ajout_intitule_nature_contrat'>Intitulé nature contrat</label></td>
                <td><input id='ajout_intitule_nature_contrat' class='nature_contrat'
                           name='ajout_intitule_nature_contrat'
                           type='text' maxlength='50' required></td>
            <tr>
                <?php
                if (!$estParametres) { ?>
                    <td>
                        <button class='btn' type='button' data-dismiss='modal'>Annuler</button>
                    </td>
                <?php } ?>
                <td><input type='button' value='Ajouter' data-dismiss='modal'
                           class='btn btn-success'/></td>
            </tr>
        </table>
        <p class="retour_js"></p>
    </form>

<?php
if ($estParametres) {
    $natureContrats = $listeParamManager->getAll(ListesParamManager::NATURE_CONTRAT);
    ?>
    </div>
    <div class='col-md-6'>
        <form>
            <table>
                <tr>
                    <td><label for='liste_nature_contrat'>Intitulé nature contrat</label></td>
                    <td>
                        <select id='liste_nature_contrat' name='id_nature_contrat'>

                            <?php foreach ($natureContrats as $natureContrat) {
                                echo '
                                        <option
                                        ';
                                echo 'value="';
                                echo $natureContrat->getId();
                                echo '">';
                                echo $natureContrat->getIntitule() . '</option>' . "\n";
                            } ?>
                        </select>
                </tr>
                <tr>
                    <td><input type='button' value='Supprimer' class='btn btn-success'/></td>
                </tr>
            </table>
            <p class="retour_js"></p>
        </form>
    </div>
    </div>
    </fieldset>
<?php } else { ?>
    </div>
    </div>
    </div>
<?php }





if ($estParametres) { ?>
    <h2 class="rubrique pli" id="titre_type_entree_contrat">Type entrée contrat</h2>
    <fieldset id="fieldset_type_entree_contrat" class="contenu_fieldset">
    <div id="editer_type_entree_contrat" class="contenu_pli">
    <div class='col-md-6'>
<?php } else { ?>
    <div id="popup_edition_entree_contrat" class="modal fade" role="dialog">
    <div class="modal-dialog">
    <div class="modal-content">
    <h3>Ajouter type entrée contrat</h3>
<?php } ?>
    <form>
        <table>
            <tr>
                <td><label for='ajout_intitule_type_entree_contrat'>Intitulé type entrée
                        contrat</label>
                </td>
                <td><input id='ajout_intitule_type_entree_contrat'
                           name='ajout_intitule_type_entree_contrat' class='type_entree_contrat'
                           type='text' maxlength='50'
                           required></td>
            <tr>
                <?php if (!$estParametres) { ?>
                    <td>
                        <button class='btn' type='button' data-dismiss='modal'>Annuler</button>
                    </td>
                <?php } ?>
                <td><input type='button' value='Ajouter' data-dismiss='modal'
                           class='btn btn-success'/></td>
            </tr>
        </table>
        <p class="retour_js"></p>
    </form>

<?php
if ($estParametres) {
    $typeEntreeContrats = $listeParamManager->getAll(ListesParamManager::TYPE_ENTREE_CONTRAT);
    ?>
    </div>
    <div class='col-md-6'>
        <form>
            <table>
                <tr>
                    <td><label for='liste_type_entree_contrat'>Intitulé type entrée
                            contrat</label>
                    </td>
                    <td>
                        <select id='liste_type_entree_contrat' name='id_type_entree'>
                            <?php
                            foreach ($typeEntreeContrats as $typeEntreeContrat) {
                                echo '
                                        <option
                                        ';
                                echo 'value="';
                                echo $typeEntreeContrat->getId();
                                echo '">';
                                echo $typeEntreeContrat->getIntitule() . '</option>' . "\n";
                            } ?>
                        </select>
                </tr>
                <tr>
                    <td><input type='button' value='Supprimer' class='btn btn-success'/></td>
                </tr>
            </table>
            <p class="retour_js"></p>
        </form>
    </div>
    </div>
    </fieldset>
<?php } else { ?>
    </div>
    </div>
    </div>
<?php }





if ($estParametres) { ?>
    <h2 class="rubrique pli" id="titre_etablissement">Etablissement</h2>
    <fieldset id="fieldset_etablissement" class="contenu_fieldset">
    <div id="editer_etablissement" class="contenu_pli">
    <div class='col-md-6'>
<?php } else { ?>
    <div id="popup_edition_etablissement" class="modal fade" role="dialog">
    <div class="modal-dialog">
    <div class="modal-content">
    <h3>Ajouter établissement</h3>
<?php } ?>
    <form>
        <table>
            <tr>
                <td><label for='ajout_intitule_etablissement'>Intitulé établissement</label></td>
                <td><input id='ajout_intitule_etablissement' class='etablissement'
                           name='ajout_intitule_etablissement'
                           type='text' maxlength='50' required></td>
            </tr>
            <tr>
                <td><label for='ajout_adresse_etablissement'>Adresse établissement</label></td>
                <td><input id='ajout_adresse_etablissement' class='etablissement'
                           name='ajout_adresse_etablissement'
                           type='text' maxlength='300' required></td>
            </tr>
            <tr>
                <?php if (!$estParametres) { ?>
                    <td>
                        <button class='btn' type='button' data-dismiss='modal'>Annuler</button>
                    </td>
                <?php }; ?>
                <td><input type='button' value='Ajouter' data-dismiss='modal'
                           class='btn btn-success'/></td>
            </tr>
        </table>
        <p class="retour_js"></p>
    </form>
<?php
if ($estParametres) {
    $etablissements = $listeParamManager->getAll(ListesParamManager::ETABLISSEMENT); ?>
    </div>
    <div class='col-md-6'>
        <form>
            <table>
                <tr>
                    <td><label for='liste_intitule_etablissement'>Intitulé établissement</label></td>
                    <td>
                        <select id='liste_intitule_etablissement' name='id_etablissement'>
                            <?php
                            foreach ($etablissements as $etablissement) {
                                echo '
                                        <option
                                        ';
                                echo 'value="';
                                echo $etablissement->getId();
                                echo '">';
                                echo $etablissement->getIntitule() . '</option>' . "\n";
                            } ?>
                        </select>
                </tr>
                <tr>
                    <td><input type='button' value='Supprimer' class='btn btn-success'/></td>
                </tr>
            </table>
            <p class="retour_js"></p>
        </form>
    </div>
    </div>
    </fieldset>
<?php } else { ?>
    </div>
    </div>
    </div>
<?php }





if ($estParametres) { ?>
    <h2 class="rubrique pli" id="titre_departement_poste">Département poste</h2>
    <fieldset id="fieldset_departement_poste" class="contenu_fieldset">
    <div id="editer_departement_poste" class="contenu_pli">
    <div class='col-md-6'>
<?php } else { ?>
    <div id="popup_edition_departement_poste" class="modal fade" role="dialog">
    <div class="modal-dialog">
    <div class="modal-content">
    <h3>Ajouter département poste</h3>
<?php } ?>
    <form>
        <table>
            <tr>
                <td><label for='ajout_intitule_departement_poste'>Intitulé département poste</label>
                </td>
                <td><input id='ajout_intitule_departement_poste' class='departement_poste'
                           name='ajout_intitule_departement_poste'
                           type='text' maxlength='50' required></td>
            <tr>
                <?php if (!$estParametres) { ?>
                    <td>
                        <button class='btn' type='button' data-dismiss='modal'>Annuler</button>
                    </td>
                <?php } ?>
                <td><input type='button' value='Ajouter' data-dismiss='modal'
                           class='btn btn-success'/></td>
            </tr>
        </table>
        <p class="retour_js"></p>
    </form>

<?php
if ($estParametres) {
    $departementPostes = $listeParamManager->getAll(ListesParamManager::DEPARTEMENT_POSTE); ?>
    </div>
    <div class='col-md-6'>
        <form>
            <table>
                <tr>
                    <td><label for='liste_departement_poste'>Intitulé département poste</label>
                    </td>
                    <td>
                        <select id='liste_departement_poste' name='id_departements_poste'>
                            <?php
                            foreach ($departementPostes as $departementPoste) {
                                echo '
                                        <option
                                        ';
                                echo 'value="';
                                echo $departementPoste->getId();
                                echo '">';
                                echo $departementPoste->getIntitule() . '</option>' . "\n";
                            } ?>
                        </select>
                </tr>
                <tr>
                    <td><input type='button' value='Supprimer' class='btn btn-success'/></td>
                </tr>
            </table>
            <p class="retour_js"></p>
        </form>
    </div>
    </div>
    </fieldset>
<?php } else { ?>
    </div>
    </div>
    </div>
<?php }





if ($estParametres) { ?>
    <h2 class="rubrique pli" id="titre_categorie_poste">Catégorie poste</h2>
    <fieldset id="fieldset_categorie_poste" class="contenu_fieldset">
    <div id="editer_categorie_poste" class="contenu_pli">
    <div class='col-md-6'>
<?php } else { ?>
    <div id="popup_edition_categorie_poste" class="modal fade" role="dialog">
    <div class="modal-dialog">
    <div class="modal-content">
    <h3>Ajouter catégorie poste</h3>
<?php } ?>
    <form>
        <table>
            <tr>
                <td><label for='ajout_intitule_categorie_poste'>Intitulé catégorie poste</label>
                </td>
                <td><input id='ajout_intitule_categorie_poste' class='categorie_poste'
                           name='ajout_intitule_categorie_poste'
                           type='text' maxlength='50' required></td>
            <tr>
                <?php if (!$estParametres) { ?>
                    <td>
                        <button class='btn' type='button' data-dismiss='modal'>Annuler</button>
                    </td>
                <?php } ?>
                <td><input type='button' value='Ajouter' data-dismiss='modal'
                           class='btn btn-success'/></td>
            </tr>
        </table>
        <p class="retour_js"></p>
    </form>

<?php
if ($estParametres) {
    $categoriePostes = $listeParamManager->getAll(ListesParamManager::CAT_POSTE); ?>
    </div>
    <div class='col-md-6'>
        <form>
            <table>
                <tr>
                    <td><label for='liste_categorie'>Intitulé catégorie poste</label>
                    </td>
                    <td>
                        <select id='liste_categorie' name='id_categorie_poste'>";

                            <?php foreach ($categoriePostes as $categoriePoste) {
                                echo '
                                        <option
                                        ';
                                echo 'value="';
                                echo $categoriePoste->getId();
                                echo '">';
                                echo $categoriePoste->getIntitule() . '</option>' . "\n";
                            } ?>
                        </select>
                </tr>
                <tr>
                    <td><input type='button' value='Supprimer' class='btn btn-success'/></td>
                </tr>
            </table>
            <p class="retour_js"></p>
        </form>
    </div>
    </div>
    </fieldset>
<?php } else { ?>
    </div>
    </div>
    </div>
<?php }





if ($estParametres) { ?>
    <h2 class="rubrique pli" id="titre_emploi">Emploi (nomenclature CCN)</h2>
    <fieldset id="fieldset_emploi" class="contenu_fieldset">
    <div id="editer_emploi" class="contenu_pli">
    <div class='col-md-6'>
<?php } else { ?>
    <div id="popup_edition_emploi_CCN" class="modal fade" role="dialog">
    <div class="modal-dialog">
    <div class="modal-content">
    <h3>Ajouter emploi (nomenclature CCN)</h3>
<?php } ?>
    <form>
        <table>
            <tr>
                <td><label for='ajout_intitule_emploi_CCN'>Intitulé emploi CCN</label></td>
                <td><input id='ajout_intitule_emploi_CCN' class='emploi_CCN'
                           name='ajout_intitule_emploi_CCN' type='text'
                           maxlength='50' required></td>
            </tr>
            <tr>
                <td><label for='selection_categorie_sp'>Catégorie SP</label></td>
                <td><select id='selection_categorie_sp' name='selection_categorie_sp'>
                        <?php $categoriesSP = $listeParamManager->getAll(ListesParamManager::CAT_SP);
                        foreach ($categoriesSP as $categorieSP) {
                            echo '
                                        <option
                                        ';
                            echo 'value="';
                            echo $categorieSP->getId();
                            echo '">';
                            echo $categorieSP->getCode() . '</option>' . "\n";
                        } ?>
                    </select>
            </tr>
            <?php if (!$estParametres) { ?>
                <tr>
                    <td>
                        <button class="boutonmodif btn" type="button" data-toggle="modal"
                                data-target="#popup_edition_categorie_sp">
                            <img class="imagehover" src="commonfiles/images/modifier-noir.png">
                        </button>
                    </td>
                </tr>
            <?php } ?>
            <tr>
                <td><label for='selection_niveau'>Niveau</label></td>
                <td><select id='selection_niveau' name='selection_niveau'>

                        <?php $niveaux = $listeParamManager->getAll(ListesParamManager::NIVEAU);
                        foreach ($niveaux as $niveau) {
                            echo '<option ';
                            echo 'value="';
                            echo $niveau->getId();
                            echo '">';
                            echo $niveau->getCode() . '</option>' . "\n";
                        } ?>
                    </select>
            </tr>
            <?php if (!$estParametres) { ?>
                <tr>
                    <td>
                        <button class="boutonmodif btn" type="button" data-toggle="modal"
                                data-target="#popup_edition_niveau">
                            <img class="imagehover" src="commonfiles/images/modifier-noir.png">
                        </button>
                    </td>
                    <td>
                        <button class='btn' type='button' data-dismiss='modal'>Annuler</button>
                    </td>
                </tr>
            <?php } ?>
            <tr>
                <td><input type='button' value='Ajouter' data-dismiss='modal'
                           class='btn btn-success'/></td>
            </tr>
        </table>
        <p class="retour_js"></p>
    </form>

<?php
if ($estParametres) {
    $emploisCCN = $listeParamManager->getAll(ListesParamManager::EMPLOI_CCN); ?>
    </div>
    <div class='col-md-6'>
        <form>
            <table>
                <tr>
                    <td><label for='liste_emploi_ccn'>Intitulé Emploi CCN</label></td>
                    <td>
                        <select id='liste_emploi_ccn' name='id_emploi_ccn'>";
                            <?php
                            foreach ($emploisCCN as $emploiCCN) {
                                echo '
                                        <option
                                        ';
                                echo 'value="';
                                echo $emploiCCN->getId();
                                echo '">';
                                echo $emploiCCN->getIntitule() . '</option>' . "\n";
                            } ?>
                        </select>
                </tr>
                <tr>
                    <td><input type='button' value='Supprimer' class='btn btn-success'/></td>
                </tr>
            </table>
            <p class="retour_js"></p>
        </form>
    </div>
    </div>
    </fieldset>
<?php } else { ?>
    </div>
    </div>
    </div>
<?php }





if ($estParametres) { ?>
    <h2 class="rubrique pli" id="titre_convention">Convention</h2>
    <fieldset id="fieldset_convention" class="contenu_fieldset">
    <div id="editer_convention" class="contenu_pli">
    <div class='col-md-6'>
<?php } else { ?>
    <div id="popup_edition_convention" class="modal fade" role="dialog">
    <div class="modal-dialog">
    <div class="modal-content">
    <h3>Ajouter convention</h3>
<?php } ?>
    <form>
        <table>
            <tr>
                <td><label for='ajout_intitule_convention'>Intitulé convention</label></td>
                <td><input id='ajout_intitule_convention' class='convention'
                           name='ajout_intitule_convention' type='text'
                           maxlength='50' required></td>
            <tr>
                <?php if (!$estParametres) { ?>
                    <td>
                        <button class='btn' type='button' data-dismiss='modal'>Annuler</button>
                    </td>
                <?php } ?>
                <td><input type='button' value='Ajouter' data-dismiss='modal'
                           class='btn btn-success'/></td>
            </tr>
        </table>
        <p class="retour_js"></p>
    </form>
<?php
if ($estParametres) {
    $conventions = $listeParamManager->getAll(ListesParamManager::CONVENTION); ?>
    </div>
    <div class='col-md-6'>
        <form>
            <table>
                <tr>
                    <td><label for='liste_convention'>Intitulé convention</label></td>
                    <td>
                        <select id='liste_convention' name='id_convention'>
                            <?php foreach ($conventions as $convention) {
                                echo '
                                        <option
                                        ';
                                echo 'value="';
                                echo $convention->getId();
                                echo '">';
                                echo $convention->getIntitule() . '</option>' . "\n";
                            } ?>
                        </select>
                </tr>
                <tr>
                    <td><input type='button' value='Supprimer' class='btn btn-success'/></td>
                </tr>
            </table>
            <p class="retour_js"></p>
        </form>
    </div>
    </div>
    </fieldset>
<?php } else { ?>
    </div>
    </div>
    </div>
<?php }





if ($estParametres) { ?>
    <h2 class="rubrique pli" id="titre_bulletin_modele_salaire">Bulletin modèle salaire</h2>
    <fieldset id="fieldset_bulletin_modele_salaire" class="contenu_fieldset">
    <div id="editer_bulletin_modele_salaire" class="contenu_pli">
    <div class='col-md-6'>
<?php } else { ?>
    <div id="popup_edition_bulletin_modele" class="modal fade" role="dialog">
    <div class="modal-dialog">
    <div class="modal-content">
    <h3>Ajouter bulletin modèle salaire</h3>
<?php } ?>
    <form>
        <table>
            <tr>
                <td><label for='ajout_intitule_bulletin_modele'>Intitulé bulletin modèle</label>
                </td>
                <td><input id='ajout_intitule_bulletin_modele' class='bulletin_modele'
                           name='ajout_intitule_bulletin_modele'
                           type='text' maxlength='50' required></td>
            <tr>
                <?php if (!$estParametres) { ?>
                    <td>
                        <button class='btn' type='button' data-dismiss='modal'>Annuler</button>
                    </td>
                <?php } ?>
                <td><input type='button' value='Ajouter' data-dismiss='modal'
                           class='btn btn-success'/></td>
            </tr>
        </table>
        <p class="retour_js"></p>
    </form>
<?php

if ($estParametres) {
    $bulletinmodeles = $listeParamManager->getAll(ListesParamManager::BULLETIN_MODELE_SALAIRE); ?>
    </div>
    <div class='col-md-6'>
        <form>
            <table>
                <tr>
                    <td><label for='liste_bulletin_modele'>Intitulé bulletin modèle</label>
                    </td>
                    <td>
                        <select id='liste_bulletin_modele' name='id_bulletin_modele'>

                            <?php foreach ($bulletinmodeles as $bulletinmodele) {
                                echo '
                                        <option
                                        ';
                                echo 'value="';
                                echo $bulletinmodele->getId();
                                echo '">';
                                echo $bulletinmodele->getIntitule() . '</option>' . "\n";
                            } ?>
                        </select>
                </tr>
                <tr>
                    <td><input type='button' value='Supprimer' class='btn btn-success'/></td>
                </tr>
            </table>
            <p class="retour_js"></p>
        </form>
    </div>
    </div>
    </fieldset>
<?php } else { ?>
    </div>
    </div>
    </div>
<?php }





if ($estParametres) { ?>
    <h2 class="rubrique pli" id="titre_modalite_exercice_travail">Modalité exercice travail</h2>
    <fieldset id="fieldset_modalite_exercice_travail" class="contenu_fieldset">
    <div id="editer_modalite_exercice_travail" class="contenu_pli">
    <div class='col-md-6'>
<?php } else { ?>
    <div id="popup_edition_modalite_exercice_travail" class="modal fade" role="dialog">
    <div class="modal-dialog">
    <div class="modal-content">
    <h3>Ajouter modalité exercice travail</h3>
<?php } ?>
    <form>
        <table>
            <tr>
                <td><label for='ajout_intitule_modalite_exercice_travail'>Intitulé modalité exercice
                        travail</label></td>
                <td><input id='ajout_intitule_modalite_exercice_travail'
                           class='modalite_exercice_travail'
                           name='ajout_intitule_modalite_exercice_travail' type='text'
                           maxlength='50'
                           required></td>
            <tr>

                <?php if (!$estParametres) { ?>
                    <td>
                        <button class='btn' type='button' data-dismiss='modal'>Annuler</button>
                    </td>
                <?php } ?>
                <td><input type='button' value='Ajouter' data-dismiss='modal'
                           class='btn btn-success'/></td>
            </tr>
        </table>
        <p class="retour_js"></p>
    </form>

<?php
if ($estParametres) {
    $modaliteExercices = $listeParamManager->getAll(ListesParamManager::MODALITE_EXERCICE_TRAVAIL) ?>
    </div>
    <div class='col-md-6'>
        <form>
            <table>
                <tr>
                    <td><label for='liste_modalite_exerice_travail'>Intitulé modalité exercice
                            travail </label></td>
                    <td>
                        <select id='liste_modalite_exerice_travail' name='id_exerice_travail'>

                            <?php foreach ($modaliteExercices as $modaliteExercice) {
                                echo '
                                        <option
                                        ';
                                echo 'value="';
                                echo $modaliteExercice->getId();
                                echo '">';
                                echo $modaliteExercice->getIntitule() . '</option>' . "\n";
                            } ?>
                        </select>
                </tr>
                <tr>
                    <td><input type='button' value='Supprimer' class='btn btn-success'/></td>
                </tr>
            </table>
            <p class="retour_js"></p>
        </form>
    </div>
    </div>
    </fieldset>
<?php } else { ?>
    </div>
    </div>
    </div>
<?php }





if ($estParametres) { ?>
    <h2 class="rubrique pli" id="titre_categorieSP">Code catégorie SP</h2>
    <fieldset id="fieldset_categorieSP" class="contenu_fieldset">
    <div id="editer_categorieSP" class="contenu_pli">
    <div class='col-md-6'>
<?php } else { ?>
    <div id="popup_edition_niveau" class="modal fade" role="dialog">
    <div class="modal-dialog">
    <div class="modal-content">
    <h3>Ajouter code catégorie SP</h3>
<?php } ?>
    <form>
        <table>
            <tr>
                <td><label for='ajout_code_categorie_SP'>Code catégorie SP </label></td>
                <td><input id='ajout_code_categorie_SP'
                           name='ajout_intitule_ajout_code_categorie_SP'
                           type='text' maxlength='5' required></td>
            </tr>
            <tr>

                <?php if (!$estParametres) { ?>
                    <td>
                        <button class='btn' type='button' data-dismiss='modal'>Annuler</button>
                    </td>
                <?php } ?>
                <td><input type='button' value='Ajouter' data-dismiss='modal'
                           class='btn btn-success'/></td>
            </tr>
        </table>
        <p class="retour_js"></p>
    </form>
<?php
if ($estParametres) {
    $categoriesSP = $listeParamManager->getAll(ListesParamManager::CAT_SP) ?>
    </div>
    <div class='col-md-6'>
        <form>
            <table>
                <tr>
                    <td><label for='liste_cat_sp'>Intitulé categorie
                            SP</label>
                    </td>
                    <td>
                        <select id='liste_cat_sp' name='id_cat_sp'>
                            <?php
                            foreach ($categoriesSP as $categorieSP) {
                                echo '
                                    <option
                                    ';
                                echo 'value="';
                                echo $categorieSP->getId();
                                echo '">';
                                echo $categorieSP->getCode() . '</option>' . "\n";
                            } ?>
                        </select></td>
                </tr>
                <tr>
                    <td><input type='button' value='Supprimer' class='btn btn-success'/></td>
                </tr>
            </table>
            <p class="retour_js"></p>
        </form>
    </div>
    </div>
    </fieldset>
<?php } else { ?>
    </div>
    </div>
    </div>
<?php }




if ($estParametres) { ?>
    <h2 class="rubrique pli" id="titre_niveau">Niveau</h2>
    <fieldset id="fieldset_niveau" class="contenu_fieldset">
    <div id="editer_niveau" class="contenu_pli">
    <div class='col-md-6'>
<?php } else { ?>
    <div id="popup_edition_categorie_sp" class="modal fade" role="dialog">
    <div class="modal-dialog">
    <div class="modal-content">
    <h3>Ajouter niveau</h3>
<?php } ?>
    <form>
        <table>
            <tr>
                <td><label for='ajout_code_niveau'>Intitulé niveau</label></td>
                <td><input id='ajout_code_niveau' name='ajout_code_niveau' type='text'
                           maxlength='50'
                           required></td>
            </tr>
            <tr>
                <td><label for='min_remuneration'>Rémuneration minimale</label></td>
                <td><input id='min_remuneration' name='min_remuneration' type='number' min='0'
                           step='0.01' placeholder='0,00' required></td>
            </tr>
            <tr>
                <td><label for='max_remuneration'>Rémuneration maximale</label></td>
                <td><input id='max_remuneration' name='max_remuneration' type='number' min='0'
                           step='0.01' placeholder='0,00' required></td>
            </tr>
            <tr>
                <?php if (!$estParametres) { ?>
                    <td>
                        <button class='btn' type='button' data-dismiss='modal'>Annuler</button>
                    </td>
                <?php } ?>
                <td><input type='button' value='Ajouter' data-dismiss='modal'
                           class='btn btn-success'/></td>
            </tr>
        </table>
        <p class="retour_js"></p>
    </form>

<?php

if ($estParametres) {
    $niveaux = $listeParamManager->getAll(ListesParamManager::NIVEAU); ?>
    </div>
    <div class='col-md-6'>
        <form>
            <table>
                <tr>
                    <td><label for='liste_niveaux'>Intitulé niveau</label></td>
                    <td>
                        <select id='liste_niveaux' name='id_niveau'>

                            <?php foreach ($niveaux as $niveau) {
                                echo '
                                        <option
                                        ';
                                echo 'value="';
                                echo $niveau->getId();
                                echo '">';
                                echo $niveau->getCode() . '</option>' . "\n";
                            } ?>
                        </select>
                </tr>
                <tr>
                    <td><input type='button' value='Supprimer' class='btn btn-success'/></td>
                </tr>
            </table>
            <p class="retour_js"></p>
        </form>
    </div>
    </div>
    </fieldset>
<?php } else { ?>
    </div>
    </div>
    </div>
<?php } ?>