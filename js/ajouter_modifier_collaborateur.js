$(document).ready(function () {
    $("#etat_civil").toggle();
    $("#intitule_etat_civil").toggleClass('clique');

    const now = new Date();
    const day = ("0" + now.getDate()).slice(-2);
    const day2 = ("0" + (now.getDate() + 1)).slice(-2);
    const month = ("0" + (now.getMonth() + 1)).slice(-2);
    const today = now.getFullYear() + "-" + (month) + "-" + (day);
    const today2 = now.getFullYear() + "-" + (month) + "-" + (day2);
    const finPeriodeEssai = $('#fin_periode_essai');
    const dateDebut = $('#date_debut');

    finPeriodeEssai.val(today2);
    finPeriodeEssai.attr("min", today2);
    dateDebut.val(today);
    $('#date_naissance').attr("max", today);
    dateDebut.attr("min", today);
    dateDebut.attr("max", finPeriodeEssai.attr("min"));
});

$(".boutonmodif").hover(function () {
    $('img', this).attr("src", "commonfiles/images/modifier-orange.png");
}, function () {
    $('img', this).attr('src', 'commonfiles/images/modifier-noir.png');
});

$("h2").click(function () {
    const h2clique = $("h2.clique");
    const differentElement = h2clique[0].id !== this.id;

    if (differentElement) {
        $("fieldset:visible").toggle("fast", "linear");
        h2clique.removeClass("clique");
        $(this).addClass('clique');

        $("#" + this.id.substring(9, this.id.length)).toggle("fast", "linear");
        $("." + this.id.substring(9, this.id.length)).toggle("fast", "linear");
    }
});

const num_sexe = $("#numeros_immatriculation_sexe");
const num_annee = $("#numeros_immatriculation_annee_naissance");
const num_mois = $("#numeros_immatriculation_mois_naissance");
const num_departement = $("#numeros_immatriculation_departement_naissance");
const num_commune = $("#numeros_immatriculation_commune_naissance");
const num_acte_naissance = $("#numeros_immatriculation_acte_naissance");

num_commune.change(function () {
    controleCodeCommune.call(this);
    calculCleControle();
});

num_annee.change(calculCleControle);
num_acte_naissance.change(calculCleControle);
num_departement.change(calculCleControle);
num_mois.change(calculCleControle);
num_sexe.change(calculCleControle);

function calculCleControle() {
    const longueur = num_sexe.val().length +
        num_annee.val().length +
        num_mois.val().length +
        num_departement.val().length +
        num_commune.val().length +
        num_acte_naissance.val().length;
    if (longueur === 13) {
        const chiffres = num_sexe.val() +
            num_annee.val() +
            num_mois.val() +
            num_departement.val() +
            num_commune.val() +
            num_acte_naissance.val();
        const cle = 97 - (chiffres % 97);
        $("#numeros_immatriculation_controle").val(cle);
    }
}

const civilite = $("#civilite");
civilite.change(function () {
    num_sexe.val(civilite.val());
    calculCleControle();
});

const dateNaissance = $("#date_naissance");
dateNaissance.change(function () {
    const anneeNaissance = new Date(dateNaissance.val()).getFullYear();
    num_annee.val((anneeNaissance === anneeNaissance) ? anneeNaissance.toString().substr(2, 2) : "");

    let moisNaissance = new Date(dateNaissance.val()).getMonth();
    if (moisNaissance === moisNaissance && dateNaissance.length < 2)
        moisNaissance = "0" + (moisNaissance + 1);
    num_mois.val((moisNaissance === moisNaissance) ? moisNaissance : "");
    calculCleControle();
});

$("#departement").change(function () {
    num_departement.val($(this, "#option:selected").val());
    calculCleControle();
});

function controleCodeCommune() {
    while ($(this).val().length < 3) {
        $(this).val("0" + $(this).val());
    }
    if ($(this).val().length > 3)
        $(this).val($(this).val().toString().substr(0, 3));
}

$("#code_commune").change(function () {
    controleCodeCommune.call(this);
    num_commune.val($(this).val());
    calculCleControle();
});

const code_postal = $("#code_postal");
code_postal.change(function () {
    if (code_postal.val().length > 5)
        code_postal.val(code_postal.val().toString().substr(0, 5));
});

const iban = $("#iban");
iban.change(function () {
    const iban_val = iban.val();
    iban.val("");
    let i = 0;
    let j = 0;
    while (iban.val().length < 33 && i < iban_val.length) {
        while (iban_val[i] === " ")
            i++;
        iban.val(iban.val() + iban_val[i]);
        j++;
        i++;
        if (j % 4 === 0)
            iban.val(iban.val() + " ");
    }
});

$("input[type='button']").click(function () {
    const input = $(this).closest("tr").prevAll("tr").find("input");
    $.ajax({
        method: "POST",
        url: "index.php?page=14",
        data: $($(this).closest("form")).serialize()
    })
        .done(function (response) {
            const retour = $(response).find("#response")[0].innerText;
            if (retour !== "0" && retour !== "-1") {
                notificationFormulaire("success", "Le paramètre a bien été ajouté.");
                if (input.length > 1)
                    $("#" + input.first().attr("class")).append("<option value='" + retour + "'>" + input.last().val() + " (" + input.first().val() + ")" + "</option>");
                else
                    $("#" + input.first().attr("class")).append("<option value='" + retour + "'>" + input.last().val() + "</option>");
            } else if (retour === "0") {
                notificationFormulaire("success", "<strong>ERREUR IMPOSSIBLE !</strong> Une erreur normalement impossible est survenue. Merci de reporter cette erreur.");
            } else
                notificationFormulaire("danger", "<strong>ERREUR !</strong> Une erreur est survenue lors de l'ajout. Merci de reporter cette erreur.");
        })
        .fail(function () {
            notificationFormulaire("danger", "<strong>ERREUR CRITIQUE !</strong> Une erreur est survenue l'ajout. Merci de reporter cette erreur.");
        });
});

function notificationFormulaire(type, msg) {
    const notif = $("#retour_js");
    switch (type) {
        case "danger":
            notif.attr("class", "alert alert-danger text-center");
            break;

        case "warning":
            notif.attr("class", "alert alert-warning text-center");
            break;

        case "success":
            notif.attr("class", "alert alert-success text-center");
            break;

        default:
            return null;
    }
    notif.html(msg);
    setTimeout(function () {
        notif.attr("class", "retour_js");
        notif.html("");
    }, 4000);
}

const coefficient = $("#coefficient");
coefficient.change(function () {
    const coefficient_val = coefficient.val();
    const coefficient_max_val = 4;
    if (coefficient_val.length > coefficient_max_val) {
        coefficient.val(coefficient.val().substr(0, 4));
    }
});

const date_debut = $("#date_debut");
const fin_periode_essai = $("#fin_periode_essai");
fin_periode_essai.change(function () {
    date_debut.attr("max", fin_periode_essai.val());
});