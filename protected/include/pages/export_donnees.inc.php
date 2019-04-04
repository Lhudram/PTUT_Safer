<?php
if (!empty($_POST["export"])) {
    $collaborateurManager = new CollaborateurManager(new Mypdo());
    $nomFichier = $collaborateurManager->exporter();
}
?>
<div id="contenu" class="hidden col-xs-12 col-sm-12 col-md-10 col-md-push-1 col-lg-8 col-lg-push-2">

    <?php
    include("protected/include/subnavbar.inc.php");
    ?>

    <div id="titre_page">
        <h1>Export données</h1>
    </div>

    <div class="row center-block">
        <?php
        if (!empty($_POST["export"])) {
            ?>
            <h4 class="col-md-offset-3 col-md-3">Le fichier d'export a été généré : </h4>
            <a class="col-md-3" href="protected/documents_generes/export/<?php echo $nomFichier; ?>" download="<?php echo $nomFichier; ?>">
                <button type="button" class="btn btn-success">Télécharger le fichier d'export</button>
            </a>
            <?php
        }
        ?>
    </div>

    <div class="row">

        <div class="col-md-3">
            <h2 id="intitule_etat_civil" class="rubrique">Etat civil</h2>
            <h2 id="intitule_immatriculation" class="rubrique">Immatriculation</h2>
            <h2 id="intitule_coordonnees" class="rubrique">Coordonnées</h2>
            <h2 id="intitule_contrat_poste_emploi" class="rubrique">Contrat, poste et emploi</h2>
            <h2 id="intitule_statut_salaire_horaire" class="rubrique">Statut, salaire et horaires</h2>
            <h2 id="intitule_administratif" class="rubrique">Administratif</h2>
        </div>

        <form action="#" method="POST">
            <input type="hidden" name="export" value="1"/>
            <div class="col-md-9">

                <fieldset id="etat_civil" class="contenu_fieldset">
                    <legend>Etat Civil</legend>

                    <table>
                        <tr>
                            <td><label for="civilite">Civilité</label></td>
                            <td><input id="civilite" name="civilite" type="number" value="0" min="0" max="41"></td>
                        </tr>
                        <tr>
                            <td><label for="nom">Nom</label></td>
                            <td><input id="nom" name="nom" type="number" value="0" min="0" max="41"></td>
                        </tr>
                        <tr>
                            <td><label for="prenom">Prenom</label></td>
                            <td><input id="prenom" name="prenom" type="number" value="0" min="0" max="41"></td>
                        </tr>
                        <tr>
                            <td><label for="nom_jeune_fille">Nom jeune fille </label></td>
                            <td><input id="nom_jeune_fille" name="nom_jeune_fille" type="number" value="0" min="0" max="41"></td>
                        </tr>
                        <tr>
                            <td><label for="id_situation_familiale">Id situation familiale</label></td>
                            <td><input id="id_situation_familiale" name="id_situation_familiale" type="number" value="0" min="0" max="41"></td>
                        </tr>
                        <tr>
                            <td><label for="nb_enfants">Nombre enfants</label></td>
                            <td><input id="nb_enfants" name="nb_enfants" type="number" value="0" min="0" max="41"></td>
                        </tr>
                        <tr>
                            <td><label for="est_complet">Est complet</label></td>
                            <td><input id="est_complet" name="est_complet" type="number" value="0" min="0" max="41"></td>
                        </tr>
                    </table>

                </fieldset>

                <fieldset id="immatriculation" class="contenu_fieldset">
                    <legend>Immatriculation</legend>

                    <table>
                        <tr>
                            <td><label for="date_naissance">Date naissance</label></td>
                            <td><input id="date_naissance" name="date_naissance" type="number" value="0" min="0" max="41"></td>
                        </tr>
                        <tr>
                            <td><label for="numero_departement_naissance">Département naissance</label></td>
                            <td><input id="numero_departement_naissance" name="numero_departement_naissance" type="number" value="0" min="0" max="41"></td>
                        </tr>
                        <tr>
                            <td><label for="code_pays_naissance">Id code pays naissance</label></td>
                            <td><input id="code_pays_naissance" name="code_pays_naissance" type="number" value="0" min="0" max="41"></td>
                        </tr>
                        <tr>
                            <td><label for="code_commune_naissance">Commune naissance</label></td>
                            <td><input id="code_commune_naissance" name="code_commune_naissance" type="number" value="0" min="0" max="41"></td>
                        </tr>
                        <tr>
                            <td><label for="code_commune_naissance">Code commune naissance</label></td>
                            <td><input id="code_commune_naissance" name="code_commune_naissance" type="number" value="0" min="0" max="41"></td>
                        </tr>
                        <tr>
                            <td><label for="nationalite">Nationalite</label></td>
                            <td><input id="nationalite" name="nationalite" type="number" value="0" min="0" max="41"></td>
                        </tr>
                        <tr>
                            <td><label for="numero_immatriculation">Numéro immatriculation</label></td>
                            <td><input id="numero_immatriculation" name="numero_immatriculation" type="number" value="0" min="0" max="41"></td>
                        </tr>
                        <tr>
                            <td><label for="email">Email</label></td>
                            <td><input id="email" name="email" type="number" value="0" min="0" max="41"></td>
                        </tr>
                    </table>

                </fieldset>

                <fieldset id="coordonnees" class="contenu_fieldset">
                    <legend>Coordonnées</legend>

                    <table>
                        <tr>
                            <td><label for="adresse">Adresse</label></td>
                            <td><input id="adresse" name="adresse" type="number" value="0" min="0" max="41"></td>
                        </tr>
                        <tr>
                            <td><label for="complement_adresse">Complement adresse</label></td>
                            <td><input id="complement_adresse" name="complement_adresse" type="number" value="0" min="0" max="41"></td>
                        </tr>
                        <tr>
                            <td><label for="code_postal">Code postal</label></td>
                            <td><input id="code_postal" name="code_postal" type="number" value="0" min="0" max="41"></td>
                        </tr>
                        <tr>
                            <td><label for="commune">Commune</label></td>
                            <td><input id="commune" name="commune" type="number" value="0" min="0" max="41"></td>
                        </tr>
                        <tr>
                            <td><label for="code_pays">Code pays</label></td>
                            <td><input id="code_pays" name="code_pays" type="number" value="0" min="0" max="41"></td>
                        </tr>
                        <tr>
                            <td><label for="iban">Iban</label></td>
                            <td><input id="iban" name="iban" type="number" value="0" min="0" max="41">
                            </td>
                        </tr>
                        <tr>
                            <td><label for="bic">Bic</label></td>
                            <td><input id="bic" name="bic" type="number" value="0" min="0" max="41"></td>
                        </tr>
                    </table>

                </fieldset>

                <fieldset id="contrat" class="contrat_poste_emploi contenu_fieldset">
                    <legend>Contrat</legend>

                    <table>
                        <tr>
                            <td><label for="id_nature_contrat">Id nature contrat</label></td>
                            <td><input id="id_nature_contrat" name="id_nature_contrat" type="number" value="0" min="0" max="41"></td>
                        </tr>
                        <tr>
                            <td><label for="date_debut">Date début</label></td>
                            <td><input id="date_debut" name="date_debut" type="number" value="0" min="0" max="41"></td>
                        </tr>
                        <tr>
                            <td><label for="fin_periode_essai">Fin période d'essai</label></td>
                            <td><input id="fin_periode_essai" name="fin_periode_essai" type="number" value="0" min="0" max="41"></td>
                        </tr>
                        <tr>
                            <td><label for="id_type_entree_contrat">Id type entrée contrat</label></td>
                            <td><input id="id_type_entree_contrat" name="id_type_entree_contrat" type="number" value="0" min="0" max="41"></td>
                        </tr>
                        <tr>
                            <td><label for="id_etablissement">Id établissement</label></td>
                            <td><input id="id_etablissement" name="id_etablissement" type="number" value="0" min="0" max="41"></td>
                        </tr>
                    </table>

                </fieldset>

                <fieldset id="poste" class="contrat_poste_emploi contenu_fieldset">
                    <legend>Poste</legend>

                    <table>
                        <tr>
                            <td><label for="id_departement_poste">Id département poste</label></td>
                            <td><input id="id_departement_poste" name="id_departement_poste" type="number" value="0" min="0" max="41"></td>
                        </tr>
                        <tr>
                            <td><label for="id_categorie_poste">Id catégorie poste</label></td>
                            <td><input id="id_categorie_poste" name="id_categorie_poste" type="number" value="0" min="0" max="41"></td>
                        </tr>
                    </table>

                </fieldset>

                <fieldset id="emploi" class="contrat_poste_emploi contenu_fieldset">
                    <legend>Emploi</legend>

                    <table>
                        <tr>
                            <td><label for="id_emploi_ccn">Id emploi (nomenclature CCN)</label></td>
                            <td><input id="id_emploi_ccn" name="id_emploi_ccn" type="number" value="0" min="0" max="41"></td>
                        </tr>
                        <tr>
                            <td><label for="id_indice">Indice</label></td>
                            <td><input id="id_indice" name="id_indice" type="number" value="0" min="0" max="41"></td>
                        </tr>
                        <tr>
                            <td><label for="coefficient">Coefficient salaire</label></td>
                            <td><input id="coefficient" name="coefficient" type="number" value="0" min="0" max="41"></td>
                        </tr>
                    </table>

                </fieldset>

                <fieldset id="statut" class="statut_salaire_horaire contenu_fieldset">
                    <legend>Statut</legend>

                    <table>
                        <tr>
                            <td><label for="id_convention">Id convention</label></td>
                            <td><input id="id_convention" name="id_convention" type="number" value="0" min="0" max="41"></td>
                        </tr>
                        <tr>
                            <td><label for="est_agirc">Est AGIRC</label></td>
                            <td><input id="est_agirc" name="est_agirc" type="number" value="0" min="0" max="41"></td>
                        </tr>
                    </table>

                </fieldset>

                <fieldset id="salaire" class="statut_salaire_horaire contenu_fieldset">
                    <legend>Salaire</legend>

                    <table>
                        <tr>
                            <td><label for="id_bulletin_modele_salaire">Id bulletin modèle</label></td>
                            <td><input id="id_bulletin_modele_salaire" name="id_bulletin_modele_salaire" type="number" value="0" min="0" max="41"></td>
                        </tr>
                    </table>

                </fieldset>

                <fieldset id="horaire" class="statut_salaire_horaire contenu_fieldset">
                    <legend>Horaire</legend>

                    <table>
                        <tr>
                            <td><label for="nb_heures_travaillees">Nombre heures travaillées</label></td>
                            <td><input id="nb_heures_travaillees" name="nb_heures_travaillees" type="number" value="0" min="0" max="41"></td>
                        </tr>
                        <tr>
                            <td><label for="id_modalite_exercice_travail">Id modalité exercice travail</label></td>
                            <td><input id="id_modalite_exercice_travail" name="id_modalite_exercice_travail" type="number" value="0" min="0" max="41">
                        </tr>
                    </table>

                </fieldset>

                <fieldset id="administratif" class="contenu_fieldset">
                    <legend>Administratif</legend>

                    <h4>Personne à prévenir en cas d'accident n°1</h4>

                    <br>

                    <table>
                        <tr>
                            <td><label for="nom_personne_a_prevenir_1">Nom</label></td>
                            <td><input id="nom_personne_a_prevenir_1" name="nom_personne_a_prevenir_1" type="number" value="0" min="0" max="41"></td>
                        </tr>
                        <tr>
                            <td><label for="telephone_personne_a_prevenir_1">Téléphone </label></td>
                            <td><input id="telephone_personne_a_prevenir_1" name="tel_personne_a_prevenir_1" type="number" value="0" min="0" max="41">
                            </td>
                        </tr>
                    </table>

                    <br><br>

                    <h4>Personne à prévenir en cas d'accident n°2</h4>

                    <br>

                    <table>
                        <tr>
                            <td><label for="nom_personne_a_prevenir_2">Nom </label></td>
                            <td><input id="nom_personne_a_prevenir_2" name="nom_personne_a_prevenir_2" type="number" value="0" min="0" max="41"></td>
                        </tr>
                        <tr>
                            <td><label for="telephone_personne_a_prevenir_2">Téléphone </label></td>
                            <td><input id="telephone_personne_a_prevenir_2" name="tel_personne_a_prevenir_2" type="number" value="0" min="0" max="41"></td>
                        </tr>
                    </table>

                </fieldset>

            </div>

            <button id="exporter" class="btn btn-danger" type="submit">Exporter</button>
            <button id="texporter" class="btn btn-danger" type="button">Tout exporter</button>
            <br><br>
            <div id="retour_js"></div>

        </form>


    </div>


    <script src="js/notification.js"></script>
    <script src="js/export_donnees.js"></script>