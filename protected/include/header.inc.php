<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Mogédoc</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="commonfiles/css/stylesheet.css">
    <link rel="stylesheet" href="commonfiles/css/bootstrap.min.css">
    <script src="commonfiles/js/jquery-3.3.1.js"></script>
    <script src="commonfiles/js/bootstrap.js"></script>
<?php
if (!empty($_POST["login"]) && !empty($_POST["password"])) {
    $connexionModule = new ConnexionModule();
    $res = $connexionModule->connexion($_POST["login"], $_POST["password"]);
    if ($res !== null) {
        $_SESSION["login"] = $_POST["login"];
        $_SESSION["admin"] = $res["admin"];
        $_SESSION["id"] = $res["id"];
    } else
        $echecConnexion = true;
}

if (!empty($_SESSION["login"])) {
    $page = (!empty($_GET["page"])) ? (int)$_GET["page"] : $pages["menu"];
    if ($page == $pages["connexion"])
        $page = $pages["menu"];
} else {
    $page = $pages["connexion"];
}

$nonAdmin = array($pages["modifier_contrat_travail"], $pages["gerer_utilisateur"], $pages["export_donnees"]);
if (isset($_SESSION["admin"]) && !$_SESSION["admin"] && in_array($page, $nonAdmin))
    $page = $pages["menu"];

switch ($page) {
    case $pages["ajouter_collaborateur"]:
        echo '<link rel="stylesheet" type="text/css" href="css/stylesheet_ajouter_et_modifier_collaborateur.css">';
        break;

    case $pages["generer_contrat_travail"]:
        echo '<link rel="stylesheet" type="text/css" href="css/stylesheet_generer_contrat_et_lettre.css">';
        break;

    case $pages["generer_documents"]:
        echo '<link rel="stylesheet" type="text/css" href="css/stylesheet_generer_documents.css">';
        break;

    case $pages["generer_lettre_embauche"]:
        echo '<link rel="stylesheet" type="text/css" href="css/stylesheet_generer_contrat_et_lettre.css">';
        break;

    case $pages["gerer_collaborateurs"]:
        echo '<link rel="stylesheet" type="text/css" href="css/stylesheet_gerer_collaborateurs.css">';
        break;

    case $pages["menu"]:
        echo '<link rel="stylesheet" type="text/css" href="css/stylesheet_menu.css">';
        break;

    case $pages["connexion"]:
        echo '<link rel="stylesheet" type="text/css" href="css/stylesheet_menu.css">';
        break;

    case $pages["modifier_collaborateur"]:
        echo '<link rel="stylesheet" type="text/css" href="css/stylesheet_ajouter_et_modifier_collaborateur.css">';
        break;

    case $pages["modifier_contrat_travail"]:
        echo '<link rel="stylesheet" type="text/css" href="css/stylesheet_modifier_document.css">';
        break;

    case $pages["parametres"]:
        echo '<link rel="stylesheet" type="text/css" href="css/stylesheet_parametres.css">';
        break;

    case $pages["export_donnees"]:
        echo '<link rel="stylesheet" type="text/css" href="css/stylesheet_export_donnees.css">';
        break;

    case $pages["generer_fiche_renseignement"]:
        echo '<link rel="stylesheet" type="text/css" href="css/stylesheet_generer_contrat_et_lettre.css">';
        break;

    case $pages["gerer_utilisateur"]:
        echo '<link rel="stylesheet" type="text/css" href="css/stylesheet_parametres.css">';
        break;
}
