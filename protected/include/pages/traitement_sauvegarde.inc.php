<?php

///////////////////////////////
/// Traitement AJAX
///////////////////////////////

$collaborateurManager = new CollaborateurManager(new Mypdo());

if (empty($_POST["id"]) && !empty($_POST["nom"]) && !empty($_POST["prenom"])) {
    $collaborateurManager->add($collaborateurManager->getCollaborateurSaisi());
} else {
    $collaborateurManager->modifierCollaborateur($collaborateurManager->getCollaborateurSaisi(), (int)$_POST["id"]);
}
$id = $collaborateurManager->getCurrentCollaborateur();
echo '<p id="response">' . $id . '</p>';
?>