<div id="contenu" class="hidden col-xs-12 col-sm-12 col-md-10 col-md-push-1 col-lg-8 col-lg-push-2">

    <?php
    if (!isset($listeParamManager)) {
        $db = new Mypdo();
        $listeParamManager = new ListesParamManager($db);
    }
    include("protected/include/navbar.inc.php");
    if (!empty($_POST["modifier_indice_salaires"]))
        $listeParamManager->update(ListesParamManager::INDICE, $_POST["modifier_indice_salaires"], 1);

    $indiceManager = new IndiceManager(new Mypdo());
    $indice = $indiceManager->get(1);
    ?>

    <div id="groupe_boutons_param" class="row">
        <a type="button" class="btn btn-danger bouton_param"
           href="index.php?page=<?php echo $pages["export_donnees"]; ?>">Exporter données</a>
        <a type="button" class="btn btn-danger bouton_param"
           href="index.php?page=<?php echo $pages["gerer_utilisateur"]; ?>">Gérer utilisateurs</a>
    </div>

        <h2 class="rubrique pli" id="titre_indice">Modifier indice des salaires</h2>
        <fieldset id="fieldset_indice" class="contenu_fieldset">

            <form action="#" method="post">
                <table>
                    <tr>
                        <td><label for="modifier_indice_salaires">Valeur du point</label></td>
                        <td><input id="modifier_indice_salaires" name="modifier_indice_salaires" type="number" min="0"
                                   step="0.01" value="<?php echo $indice->getValeur(); ?>" required>
                        </td>
                    </tr>
                    <tr>
                        <td><input type="submit" value="Modifier" class="btn btn-success"></td>
                    </tr>
                </table>
            </form>
        </fieldset>

        <h2 class="rubrique pli" id="titre_missions">Modifier missions</h2>
        <fieldset id="fieldset_missions" class="contenu_fieldset">

            <form action="#" method="post">
                <table>
                    <tr>
                        <td><label for="modifier_missions_emploi">Emploi</label></td>
                        <td>
                            <select id='modifier_missions_emploi' name='id_emploi_ccn'>";
                                <?php
                                $emploisCCN = $listeParamManager->getAll(ListesParamManager::EMPLOI_CCN);
                                foreach ($emploisCCN as $emploiCCN) {
                                    echo '<option ';
                                    echo 'value="';
                                    echo $emploiCCN->getId();
                                    echo '">';
                                    echo $emploiCCN->getIntitule() . '</option>' . "\n";
                                } ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="contenu_paragraphe">Contenu</label></td>
                        <td><textarea id="contenu_paragraphe"
                                      maxlength="5000"><?php echo $listeParamManager->fonction(ListesParamManager::EMPLOI_CCN, "getMission", $emploisCCN[0]->getId()); ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <button id="modifier_paragraphe" type="button" class="btn btn-success">Modifier</button>
                        </td>
                    </tr>
                </table>
            </form>
            <p id="retour_js"></p>
        </fieldset>
    <?php
    include("protected/include/formulaire.inc.php");
    ?>

    <script type="text/javascript" src="js/formulaire.js"></script>

<?php
$_SESSION["historique"] = $pages["parametres"];
?>