<nav id="barre_superieure">
    <ul class="nav nav-justified">
        <li <?php if ($_GET["page"] == $pages["gerer_collaborateurs"]) echo 'id="page_actuelle"' ?> class="gerer"><a
                    href="index.php?page=<?php echo $pages["gerer_collaborateurs"]; ?>">Gérer
                collaborateurs</a></li>
        <?php
        if ($_SESSION["admin"]) { ?>
            <li <?php if ($_GET["page"] == $pages["modifier_contrat_travail"]) echo 'id="page_actuelle"' ?> class="editer"><a
                        href="index.php?page=<?php echo $pages["modifier_contrat_travail"]; ?>">Structure contrat</a>
            </li>
        <?php } ?>
        <li <?php if ($_GET["page"] == $pages["generer_documents"]) echo 'id="page_actuelle"' ?> class="generer"><a
                    href="index.php?page=<?php echo $pages["generer_documents"]; ?>">Générer
                documents</a></li>
        <?php
        if ($_SESSION["admin"]) { ?>
            <li <?php if ($_GET["page"] == $pages["parametres"]) echo 'id="page_actuelle"' ?> class="parametres"><a
                        href="index.php?page=<?php echo $pages["parametres"]; ?>">Paramètres</a></li>
        <?php } ?>
        <li class="deconnexion"><a href="#" data-toggle="modal" data-target="#popup_confirmation_deconnexion"><img
                        src="commonfiles/images/icone_deconnexion.svg"/></a>
        </li>
    </ul>
</nav>