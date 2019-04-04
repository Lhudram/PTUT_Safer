<div id="contenu" class="hidden col-xs-12 col-sm-12 col-md-8 col-md-push-2 col-lg-6 col-lg-push-3">

    <div id="titre_page">
        <h1>Menu</h1>
    </div>

    <nav id="menu" class="row">
        <ul class="nav">

            <li class="bouton_menu bouton_menu_gauche gerer"><a
                        href="index.php?page=<?php echo $pages["gerer_collaborateurs"]; ?>">Gérer collaborateurs</li>
            </a>

            <li class="bouton_menu bouton_menu_droite editer<?php if (!$_SESSION["admin"]) echo ' desactive'; ?>">
                <a href="index.php?page=<?php echo $pages["modifier_contrat_travail"]; ?>">Structure contrat</a>
            </li>

            <li class="bouton_menu bouton_menu_gauche generer"><a
                        href="index.php?page=<?php echo $pages["generer_documents"]; ?>">Générer documents</a></li>

            <li class="bouton_menu bouton_menu_droite parametres"><a
                        href="index.php?page=<?php echo $pages["parametres"]; ?>">Paramètres</a></li>

            <li class="bouton_menu deconnexion"><a class="deconnexion" href="#" data-toggle="modal"
                                                   data-target="#popup_confirmation_deconnexion">Déconnexion</a></li>

        </ul>
    </nav>
<?php
$_SESSION["historique"] = $pages["menu"];
?>