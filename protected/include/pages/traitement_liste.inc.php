<?php

/////////////////////////
/// TRAITEMENT AJAX
/////////////////////////
$listeParamManager = new ListesParamManager(new Mypdo());

////////
//AJOUT
///////
if (!empty($_POST["ajout_intitule_situation_familiale"])) {
    if ($listeParamManager->add(ListesParamManager::SITUATION_FAMILIALE,
        $_POST["ajout_intitule_situation_familiale"]))
        echo '<p id="response">' . $listeParamManager->getLast(ListesParamManager::SITUATION_FAMILIALE) . '</p>';
    else
        echo '<p id="response">' . -1 . '</p>';
}
if (!empty($_POST["ajout_numero_departement"]) && !empty($_POST["ajout_nom_departement"])) {
    if ($listeParamManager->add(ListesParamManager::DEPARTEMENT, $_POST["ajout_numero_departement"],
        $_POST["ajout_nom_departement"]))
        echo '<p id="response">' . $_POST["ajout_numero_departement"] . '</p>';
    else
        echo '<p id="response">' . -1 . '</p>';
}
if (!empty($_POST["ajout_code_pays"]) && !empty($_POST["ajout_intitule_pays"])) {
    if ($listeParamManager->add(ListesParamManager::PAYS, $_POST["ajout_intitule_pays"],
        $_POST["ajout_code_pays"]))
        echo '<p id="response">' . $_POST["ajout_code_pays"] . '</p>';
    else
        echo '<p id="response">' . -1 . '</p>';
}
if (!empty($_POST["ajout_intitule_nature_contrat"])) {
    if ($listeParamManager->add(ListesParamManager::NATURE_CONTRAT,
        $_POST["ajout_intitule_nature_contrat"]))
        echo '<p id="response">' . $listeParamManager->getLast(ListesParamManager::NATURE_CONTRAT) . '</p>';
    else
        echo '<p id="response">' . -1 . '</p>';
}
if (!empty($_POST["ajout_intitule_type_entree_contrat"])) {
    if ($listeParamManager->add(ListesParamManager::TYPE_ENTREE_CONTRAT,
        $_POST["ajout_intitule_type_entree_contrat"]))
        echo '<p id="response">' . $listeParamManager->getLast(ListesParamManager::TYPE_ENTREE_CONTRAT) . '</p>';
    else
        echo '<p id="response">' . -1 . '</p>';
}
if (!empty($_POST["ajout_intitule_etablissement"])) {
    if ($listeParamManager->add(ListesParamManager::ETABLISSEMENT, $_POST["ajout_intitule_etablissement"], $_POST["ajout_adresse_etablissement"]))
        echo '<p id="response">' . $listeParamManager->getLast(ListesParamManager::ETABLISSEMENT) . '</p>';
    else
        echo '<p id="response">' . -1 . '</p>';
}
if (!empty($_POST["ajout_intitule_departement_poste"])) {
    if ($listeParamManager->add(ListesParamManager::DEPARTEMENT_POSTE, $_POST["ajout_intitule_departement_poste"]))
        echo '<p id="response">' . $listeParamManager->getLast(ListesParamManager::DEPARTEMENT_POSTE) . '</p>';
    else
        echo '<p id="response">' . -1 . '</p>';
}
if (!empty($_POST["ajout_intitule_categorie_poste"])) {
    if ($listeParamManager->add(ListesParamManager::CAT_POSTE, $_POST["ajout_intitule_categorie_poste"]))
        echo '<p id="response">' . $listeParamManager->getLast(ListesParamManager::CAT_POSTE) . '</p>';
    else
        echo '<p id="response">' . -1 . '</p>';
}
if (!empty($_POST["selection_categorie_sp"]) && !empty($_POST["selection_niveau"]) &&
    !empty($_POST["ajout_intitule_emploi_CCN"])) {
    if ($listeParamManager->add(ListesParamManager::EMPLOI_CCN, $_POST["ajout_intitule_emploi_CCN"],
        $_POST["selection_categorie_sp"], $_POST["selection_niveau"]))
        echo '<p id="response">' . $listeParamManager->getLast(ListesParamManager::EMPLOI_CCN) . '</p>';
    else
        echo '<p id="response">' . -1 . '</p>';
}
if (!empty($_POST["ajout_intitule_convention"])) {
    if ($listeParamManager->add(ListesParamManager::CONVENTION, $_POST["ajout_intitule_convention"]))
        echo '<p id="response">' . $listeParamManager->getLast(ListesParamManager::CONVENTION) . '</p>';
    else
        echo '<p id="response">' . -1 . '</p>';
}
if (!empty($_POST["ajout_intitule_bulletin_modele"])) {
    if ($listeParamManager->add(ListesParamManager::BULLETIN_MODELE_SALAIRE,
        $_POST["ajout_intitule_bulletin_modele"]))
        echo '<p id="response">' . $listeParamManager->getLast(ListesParamManager::BULLETIN_MODELE_SALAIRE) . '</p>';
    else
        echo '<p id="response">' . -1 . '</p>';
}
if (!empty($_POST["ajout_intitule_modalite_exercice_travail"])) {
    if ($listeParamManager->add(ListesParamManager::MODALITE_EXERCICE_TRAVAIL,
        $_POST["ajout_intitule_modalite_exercice_travail"]))
        echo '<p id="response">' . $listeParamManager->getLast(ListesParamManager::MODALITE_EXERCICE_TRAVAIL) . '</p>';
    else
        echo '<p id="response">' . -1 . '</p>';
}
if (!empty($_POST["ajout_intitule_ajout_code_categorie_SP"])) {
    if ($listeParamManager->add(ListesParamManager::CAT_SP,
        $_POST["ajout_intitule_ajout_code_categorie_SP"]))
        echo '<p id="response">' . $listeParamManager->getLast(ListesParamManager::CAT_SP) . '</p>';
    else
        echo '<p id="response">' . -1 . '</p>';
}
if (!empty($_POST["ajout_code_niveau"]) && !empty($_POST["min_remuneration"]) &&
    !empty($_POST["max_remuneration"])) {
    if ($listeParamManager->add(ListesParamManager::NIVEAU, $_POST["ajout_code_niveau"],
        $_POST["min_remuneration"], $_POST["max_remuneration"]))
        echo '<p id="response">' . $listeParamManager->getLast(ListesParamManager::NIVEAU) . '</p>';
    else
        echo '<p id="response">' . -1 . '</p>';
}
//////////////
//SUPPRESSION
//////////////
if (!empty($_POST["id_departement"])) {
    if ($listeParamManager->delete(ListesParamManager::DEPARTEMENT, $_POST["id_departement"]))
        echo '<p id="response">' . 0 . '</p>';
    else
        echo '<p id="response">' . -1 . '</p>';
}

if (!empty($_POST["id_pays"])) {
    if ($listeParamManager->delete(ListesParamManager::PAYS, $_POST["id_pays"]))
        echo '<p id="response">' . 0 . '</p>';
    else
        echo '<p id="response">' . -1 . '</p>';
}
if (!empty($_POST["id_nature_contrat"])) {
    if ($listeParamManager->delete(ListesParamManager::NATURE_CONTRAT, $_POST["id_nature_contrat"]))
        echo '<p id="response">' . 0 . '</p>';
    else
        echo '<p id="response">' . -1 . '</p>';
}
if (!empty($_POST["id_type_entree"])) {
    if ($listeParamManager->delete(ListesParamManager::TYPE_ENTREE_CONTRAT, $_POST["id_type_entree"]))
        echo '<p id="response">' . 0 . '</p>';
    else
        echo '<p id="response">' . -1 . '</p>';
}
if (!empty($_POST["id_etablissement"])) {
    if ($listeParamManager->delete(ListesParamManager::ETABLISSEMENT, $_POST["id_etablissement"]))
        echo '<p id="response">' . 0 . '</p>';
    else
        echo '<p id="response">' . -1 . '</p>';
}
if (!empty($_POST["id_departements_poste"])) {
    if ($listeParamManager->delete(ListesParamManager::DEPARTEMENT_POSTE, $_POST["id_departements_poste"]))
        echo '<p id="response">' . 0 . '</p>';
    else
        echo '<p id="response">' . -1 . '</p>';
}

if (!empty($_POST["id_categorie_poste"])) {
    if ($listeParamManager->delete(ListesParamManager::CAT_POSTE, $_POST["id_categorie_poste"]))
        echo '<p id="response">' . 0 . '</p>';
    else
        echo '<p id="response">' . -1 . '</p>';
}
if (!empty($_POST["id_emploi_ccn"])) {
    if ($listeParamManager->delete(ListesParamManager::EMPLOI_CCN, $_POST["id_emploi_ccn"]))
        echo '<p id="response">' . 0 . '</p>';
    else
        echo '<p id="response">' . -1 . '</p>';
}

if (!empty($_POST["id_bulletin_modele"])) {
    if ($listeParamManager->delete(ListesParamManager::BULLETIN_MODELE_SALAIRE, $_POST["id_bulletin_modele"]))
        echo '<p id="response">' . 0 . '</p>';
    else
        echo '<p id="response">' . -1 . '</p>';
}

if (!empty($_POST["id_exerice_travail"])) {
    if ($listeParamManager->delete(ListesParamManager::MODALITE_EXERCICE_TRAVAIL, $_POST["id_exerice_travail"]))
        echo '<p id="response">' . 0 . '</p>';
    else
        echo '<p id="response">' . -1 . '</p>';
}
if (!empty($_POST["id_cat_sp"])) {
    if ($listeParamManager->delete(ListesParamManager::CAT_SP, $_POST["id_cat_sp"]))
        echo '<p id="response">' . 0 . '</p>';
    else
        echo '<p id="response">' . -1 . '</p>';
}

if (!empty($_POST["id_niveau"])) {
    if ($listeParamManager->delete(ListesParamManager::NIVEAU, $_POST["id_niveau"]))
        echo '<p id="response">' . 0 . '</p>';
    else
        echo '<p id="response">' . -1 . '</p>';
}

if (!empty($_POST["id_situation"])) {
    if ($listeParamManager->delete(ListesParamManager::SITUATION_FAMILIALE, $_POST["id_situation"]))
        echo '<p id="response">' . 0 . '</p>';
    else
        echo '<p id="response">' . -1 . '</p>';
}
if (!empty($_POST["id_convention"])) {
    if ($listeParamManager->delete(ListesParamManager::CONVENTION, $_POST["id_convention"]))
        echo '<p id="response">' . 0 . '</p>';
    else
        echo '<p id="response">' . -1 . '</p>';
}

/////////////////////
/// Gestion missions
/////////////////////

if (!empty($_POST["id_emploi_mission"]) && empty($_POST["paragraphe_mission"]))
    if (($res = $listeParamManager->fonction(ListesParamManager::EMPLOI_CCN, "getMission", $_POST["id_emploi_mission"])) !== null)
        echo '<p id="response">' . $res . '</p>';
    else
        echo '<p id="response">' . -1 . '</p>';

if (!empty($_POST["paragraphe_mission"]) && !empty($_POST["id_emploi_mission"]))
    if ($listeParamManager->fonction(ListesParamManager::EMPLOI_CCN, "updateMission", $_POST["paragraphe_mission"], $_POST["id_emploi_mission"]))
        echo '<p id="response">' . 0 . '</p>';
    else
        echo '<p id="response">' . -1 . '</p>';