<?php

switch ($page) {
    case $pages["gerer_collaborateurs"]:
        include_once('protected/include/pages/gerer_collaborateurs.inc.php');
        break;
    case $pages["connexion"]:
        include_once("protected/include/pages/connexion.inc.php");
        break;
    case $pages["menu"]:
        include_once("protected/include/pages/menu.inc.php");
        break;
    case $pages["generer_documents"]:
        include_once("protected/include/pages/generer_documents.inc.php");
        break;
    case $pages["parametres"]:
        if ($_SESSION["admin"])
            include_once("protected/include/pages/parametres.inc.php");
        else
            include_once("protected/include/pages/gerer_utilisateur.inc.php");
        break;
    case $pages["ajouter_collaborateur"]:
        include_once("protected/include/pages/ajouter_collaborateur.inc.php");
        break;
    case $pages["generer_contrat_travail"]:
        include_once("protected/include/pages/generer_contrat_travail.inc.php");
        break;
    case $pages["generer_lettre_embauche"]:
        include_once("protected/include/pages/generer_lettre_embauche.inc.php");
        break;
    case $pages["modifier_collaborateur"]:
        include_once("protected/include/pages/modifier_collaborateur.inc.php");
        break;
    case $pages["modifier_contrat_travail"]:
        include_once("protected/include/pages/modifier_contrat_travail.inc.php");
        break;
    case $pages["export_donnees"]:
        include_once("protected/include/pages/export_donnees.inc.php");
        break;
    case $pages["traitement_sauvegarde"]:
        include_once("protected/include/pages/traitement_sauvegarde.inc.php");
        break;
    case $pages["traitement_suppression"]:
        include_once("protected/include/pages/traitement_suppression.inc.php");
        break;
    case $pages["traitement_liste"]:
        include_once("protected/include/pages/traitement_liste.inc.php");
        break;
    case $pages["generer_fiche_renseignement"]:
        include_once("protected/include/pages/generer_fiche_renseignement.inc.php");
        break;
    case $pages["gerer_utilisateur"]:
        include_once("protected/include/pages/gerer_utilisateurs.inc.php");
        break;

    default:
        include_once("protected/include/pages/connexion.inc.php");
        break;
}

?>
