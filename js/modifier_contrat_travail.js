$(document).ready(choisirVariable);

$('#liste_paragraphe').click(function () {
    const paragraphe = $("#liste_paragraphe").find("option:selected").val().split("|");

    $("#indice_suppression").val(paragraphe[0]);
    $("#ancien_indice").val(paragraphe[0]);
    $("#indice").val(paragraphe[0]);
    $("#intitule").val(paragraphe[4]);
    $("#contenu_paragraphe").val(paragraphe[5]);
    $("#contenu_paragraphe_invisible").val(paragraphe[5]);

    $("#estObligatoire").attr("checked", paragraphe[1] === "1");
    $("#estArticle").attr("checked", paragraphe[2] === "1");
    $("#afficheTitre").attr("checked", paragraphe[3] === "1");
});

$('#contenu_paragraphe').change(function () {
    $('#contenu_paragraphe_invisible').val($(this).val());
});

$('#contenu_paragraphe_invisible').change(function () {
    $('#contenu_paragraphe').val($(this).val());
});

$('#indice_suppression').change(function () {
    $('#indice').val($(this).val());
});

$("#categorie_variable").click(choisirVariable);

function choisirVariable() {
    const variable = $("#variable");
    switch ($("#categorie_variable").val()) {
        case "Etat Civil":
            variable.html(
                "<option value='1'>Préfixe genre (M, Mme)</option>" +
                "<option value='2'>Genre (Monsieur, Madame)</option>" +
                "<option value='3'>Nom</option>" +
                "<option value='4'>Prénom</option>" +
                "<option value='5'>Nom de jeune fille</option>" +
                "<option value='6'>Situation familiale</option>" +
                "<option value='7'>Nombre d'enfants</option>"
            );
            break;

        case "Immatriculation":
            variable.html(
                "<option value='1'>Date de naissance</option>" +
                "<option value='2'>Département de naissance</option>" +
                "<option value='3'>Code pays de naissance</option>" +
                "<option value='4'>Commune de naissance</option>" +
                "<option value='5'>Code commune de naissance</option>" +
                "<option value='6'>Nationalite</option>" +
                "<option value='7'>Numéro d'immatriculation</option>" +
                "<option value='8'>Email</option>"
            );
            break;

        case "Coordonnées":
            variable.html(
                "<option value='1'>Adresse</option>" +
                "<option value='2'>Complément d'adresse</option>" +
                "<option value='3'>Code postal</option>" +
                "<option value='4'>Commune</option>" +
                "<option value='5'>Code pays</option>" +
                "<option value='6'>Iban</option>" +
                "<option value='7'>Bic</option>"
            );
            break;

        case "Contrat":
            variable.html(
                "<option value='1'>Nature du contrat</option>" +
                "<option value='2'>Date de début</option>" +
                "<option value='3'>Fin de période d'essai</option>" +
                "<option value='4'>Type d'entree du contrat</option>" +
                "<option value='5'>Etablissement</option>"
            );
            break;

        case "Poste":
            variable.html(
                "<option value='1'>Département du poste</option>" +
                "<option value='2'>Catégorie du poste</option>"
            );
            break;

        case "Emploi":
            variable.html(
                "<option value='1'>Emploi (nomenclature CCN)</option>" +
                "<option value='2'>Missions</option>" +
                "<option value='3'>Coéfficient salaire</option>" +
                "<option value='4'>Statut (grille)</option>"
            );
            break;

        case "Statut et Bulletin":
            variable.html(
                "<option value='1'>Convention</option>" +
                "<option value='2'>Bulletin modèle</option>" +
                "<option value='3'>AGIRC (1 si AGIRC, 0 sinon)</option>"
            );
            break;

        case "Horaire":
            variable.html(
                "<option value='1'>Nombres d'heures travaillées</option>" +
                "<option value='2'>Modalité d'exercice du travail</option>"
            );
            break;

        case "Administratif":
            variable.html(
                "<option value='1'>Nom première personne à prévenir</option>" +
                "<option value='2'>Nom deuxième personne à prévenir</option>" +
                "<option value='3'>Téléphone première à prévenir</option>" +
                "<option value='4'>Téléphone deuxième à prévenir</option>"
            );
            break;

        case "Autres":
            variable.html(
                "<option value='1'>Indice des salaires</option>" +
                "<option value='2'>Date courante</option>" +
                "<option value='3'>Rémunération</option>" +
                "<option value='4'>Durée de la période d'essai</option>" +
                "<option value='5'>A compléter</option>" +
                "<option value='6'>Pronoms majuscules (Il, Elle)</option>" +
                "<option value='7'>Pronoms minuscules (il, elle)</option>"
            );
            break;
    }
}

$("#inserer").click(function () {
    let nouvelleVal;
    const variable = $("#variable");

    switch ($("#categorie_variable").val()) {
        case "Etat Civil":
            switch (variable.val()) {
                case "1":
                    nouvelleVal = "@PREFIXE_GENRE@";
                    break;
                case "2":
                    nouvelleVal = "@GENRE@";
                    break;
                case "3":
                    nouvelleVal = "@NOM@";
                    break;
                case "4":
                    nouvelleVal = "@PRENOM@";
                    break;
                case "5":
                    nouvelleVal = "@NOM_JEUNE_FILLE@";
                    break;
                case "6":
                    nouvelleVal = "@SITUATION_FAMILIALE@";
                    break;
                case "7":
                    nouvelleVal = "@NOMBRE_ENFANTS@";
                    break;
            }
            break;

        case "Immatriculation":
            switch (variable.val()) {
                case "1":
                    nouvelleVal = "@DATE_NAISSANCE@";
                    break;
                case "2":
                    nouvelleVal = "@DEPARTEMENT_NAISSANCE@";
                    break;
                case "3":
                    nouvelleVal = "@PAYS_NAISSANCE@";
                    break;
                case "4":
                    nouvelleVal = "@COMMUNE_NAISSANCE@";
                    break;
                case "5":
                    nouvelleVal = "@CODE_COMMUNE_NAISSANCE@";
                    break;
                case "6":
                    nouvelleVal = "@NATIONALITE@";
                    break;
                case "7":
                    nouvelleVal = "@NUMERO_IMMATRICULATION@";
                    break;
                case "8":
                    nouvelleVal = "@EMAIL@";
                    break;
            }
            break;

        case "Coordonnées":
            switch (variable.val()) {
                case "1":
                    nouvelleVal = "@ADRESSE@";
                    break;
                case "2":
                    nouvelleVal = "@COMPLEMENT_ADRESSE@";
                    break;
                case "3":
                    nouvelleVal = "@CODE_POSTAL@";
                    break;
                case "4":
                    nouvelleVal = "@COMMUNE@";
                    break;
                case "5":
                    nouvelleVal = "@CODE_PAYS@";
                    break;
                case "6":
                    nouvelleVal = "@IBAN@";
                    break;
                case "7":
                    nouvelleVal = "@BIC@";
                    break;
            }
            break;

        case "Contrat":
            switch (variable.val()) {
                case "1":
                    nouvelleVal = "@NATURE_CONTRAT@";
                    break;
                case "2":
                    nouvelleVal = "@DATE_DE_DEBUT@";
                    break;
                case "3":
                    nouvelleVal = "@DATE_FIN_PERIODE_ESSAI@";
                    break;
                case "4":
                    nouvelleVal = "@TYPE_ENTREE_CONTRAT@";
                    break;
                case "5":
                    nouvelleVal = "@ETABLISSEMENT@";
                    break;
            }
            break;

        case "Poste":
            switch (variable.val()) {
                case "1":
                    nouvelleVal = "@DEPARTEMENT_POSTE@";
                    break;
                case "2":
                    nouvelleVal = "@CATEGORIE_POSTE@";
                    break;
            }
            break;

        case "Emploi":
            switch (variable.val()) {
                case "1":
                    nouvelleVal = "@EMPLOI_CCN@";
                    break;
                case "2":
                    nouvelleVal = "@MISSIONS@";
                    break;
                case "3":
                    nouvelleVal = "@COEFFICIENT@";
                    break;
                case "4":
                    nouvelleVal = "@STATUT@";
                    break;
            }
            break;

        case "Statut et Bulletin":
            switch (variable.val()) {
                case "1":
                    nouvelleVal = "@CONVENTION@";
                    break;
                case "2":
                    nouvelleVal = "@BULLETIN_MODELE@";
                    break;
                case "3":
                    nouvelleVal = "@AGIRC@";
                    break;
                default:
            }
            break;

        case "Horaire":
            switch (variable.val()) {
                case "1":
                    nouvelleVal = "@NOMBRE_HEURES_TRAVAILLEES@";
                    break;
                case "2":
                    nouvelleVal = "@MODALITE_EXERCICE_TRAVAIL@";
                    break;
            }
            break;

        case "Administratif":
            switch (variable.val()) {
                case "1":
                    nouvelleVal = "@NOM_PERS_PREVENIR_1@";
                    break;
                case "2":
                    nouvelleVal = "@NOM_PERS_PREVENIR_2@";
                    break;
                case "3":
                    nouvelleVal = "@TEL_PERS_PREVENIR_1@";
                    break;
                case "4":
                    nouvelleVal = "@TEL_PERS_PREVENIR_2@";
                    break;
            }
            break;

        case "Autres":
            switch (variable.val()) {
                case "1":
                    nouvelleVal = "@INDICE_SALAIRE@";
                    break;
                case "2":
                    nouvelleVal = "@DATE_COURANTE@";
                    break;
                case "3":
                    nouvelleVal = "@REMUNERATION@";
                    break;
                case "4":
                    nouvelleVal = "@DUREE_PERIODE_ESSAI@";
                    break;
                case "5":
                    nouvelleVal = "@A_COMPLETER@";
                    break;
                case "6":
                    nouvelleVal = "@Il_Elle@";
                    break;
                case "7":
                    nouvelleVal = "@il_elle@";
                    break;
            }
            break;
    }


    if (nouvelleVal) {
        const para_invi = $("#contenu_paragraphe_invisible");
        const para = $("#contenu_paragraphe");

        if (startPos || startPos == 0) {
            para_invi.val(para_invi.val().substring(0, startPos) + " " + nouvelleVal + " " + para_invi.val().substring(endPos, para_invi.val().length));
            para.val(para.val().substring(0, startPos) + " " + nouvelleVal + " " + para.val().substring(endPos, para.val().length));
        } else {
            para_invi.val(para_invi.val() + " " + nouvelleVal);
            para.val(para.val() + " " + nouvelleVal);
        }

    }
});

//On récupère la position du curseur dans le paragraphe à chaque clic sur le paragraphe
let startPos;
let endPos;
$("#contenu_paragraphe").on('click', function () {
    startPos = this.selectionStart;
    endPos = this.selectionEnd;
});

//Gestion des différentes balises (gras, italique et souligné) et l'ajout de condition
$(".balise").click(function () {
    let debutBalise;
    let finBalise;

    switch ($(this).attr("id")) {
        case "gras":
            debutBalise = "@B@";
            finBalise = "@/B@";
            break;
        case "italique":
            debutBalise = "@I@";
            finBalise = "@/I@";
            break;
        case "souligne":
            debutBalise = "@S@";
            finBalise = "@/S@";
            break;
        case "condition":
            debutBalise = "@SI@ VARIABLE=Valeur @ALORS@";
            finBalise = "@SINON@ @/SI@";
            break;
    }

    if (debutBalise) {
        const para_invi = $("#contenu_paragraphe_invisible");
        const para = $("#contenu_paragraphe");

        if (startPos || startPos == 0) {
            //Traitement pour avoir DebutBalise + Sélection + FinBalise
            para_invi.val(para_invi.val().substring(0, startPos) + " " + debutBalise + " " + para_invi.val().substring(startPos, endPos) + " " + finBalise + " " + para_invi.val().substring(endPos, para_invi.val().length));
            para.val(para.val().substring(0, startPos) + " " + debutBalise + " " + para.val().substring(startPos, endPos) + " " + finBalise + " " + para.val().substring(endPos, para.val().length));
        } else {
            para_invi.val(para_invi.val() + " " + debutBalise + " " + finBalise);
            para.val(para.val() + " " + debutBalise + " " + finBalise);
        }

    }
});
