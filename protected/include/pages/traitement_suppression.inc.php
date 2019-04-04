<?php

///////////////////////////////
/// Traitement AJAX
///////////////////////////////

$collaborateurManager = new CollaborateurManager(new Mypdo());

if (empty($_POST["id"]))
    $response = "error";
else
    $response = $collaborateurManager->supprimerCollaborateur((int)$_POST["id"]);

echo '<p id="response">' . $response . '</p>';

?>