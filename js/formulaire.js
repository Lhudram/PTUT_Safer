$("input[type='button']").click(function () {
    const item = this;
    const input = $(this).closest("tr").prevAll("tr").find("input");
    const retour_js = $(this).closest("form").find(".retour_js");
    $.ajax({
        method: "POST",
        url: "index.php?page=14",
        data: $($(this).closest("form")).serialize()
    })
        .done(function (response) {
            console.log(response);
            const retour = $(response).find("#response")[0].innerText;
            if (retour !== "0" && retour !== "-1") {
                notificationFormulaire("success", "Le paramètre a bien été ajouté.", retour_js);
                if (input.length > 1)
                    $(item).closest("div").next("div").find("select").append("<option value='" + retour + "'>" + input.last().val() + " (" + input.first().val() + ")" + "</option>");
                else
                    $(item).closest("div").next("div").find("select").append("<option value='" + retour + "'>" + input.last().val() + "</option>");
            } else if (retour === "0") {
                notificationFormulaire("success", "Le paramètre a bien été supprimé.", retour_js);
                $(item).closest("tr").prev("tr").find("select option:selected").remove();
            } else
                notificationFormulaire("danger", "<strong>ERREUR !</strong> Une erreur est survenue lors de l" + (($(item).attr("value") === "Ajouter") ? "'ajout" : "a suppression") + ". Merci de reporter cette erreur.", retour_js);
        })
        .fail(function () {
            notificationFormulaire("danger", "<strong>ERREUR CRITIQUE !</strong> Une erreur est survenue l" + (($(item).attr("value") === "Ajouter") ? "'ajout" : "a suppression") + ". Merci de reporter cette erreur.", retour_js);
        });
});

function notificationFormulaire(type, msg, notif) {
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

$("#id_emploi_ccn").change(function () {
    $.ajax({
        method: "POST",
        url: "index.php?page=14",
        data: {id_emploi_mission: $(this).val()}
    })
        .done(function (response) {
            const retour = $(response).find("#response")[0].innerText;
            if (retour !== "-1")
                $("#contenu_paragraphe").val(retour);
            else
                notificationFormulaire("danger", "<strong>ERREUR !</strong> Une erreur est survenue lors de l''accès à la base. Merci de reporter cette erreur.", $("#retour_js"));
        })
        .fail(function () {
            notificationFormulaire("danger", "<strong>ERREUR CRITIQUE !</strong> Une erreur est survenue lors de l''accès à la base. Merci de reporter cette erreur.", $("#retour_js"));
        });
});

$("#modifier_paragraphe").click(function () {
    $.ajax({
        method: "POST",
        url: "index.php?page=14",
        data: {
            paragraphe_mission: $("#contenu_paragraphe").val(),
            id_emploi_mission: $("#id_emploi_ccn").val()
        }
    })
        .done(function (response) {
            const retour = $(response).find("#response")[0].innerText;
            if (retour === "0")
                notificationFormulaire("success", "Les missions ont bien été modifiées.", $("#retour_js"));
            else
                notificationFormulaire("danger", "<strong>ERREUR !</strong> Une erreur est survenue lors de l''accès à la base. Merci de reporter cette erreur.", $("#retour_js"));
        })
        .fail(function () {
            notificationFormulaire("danger", "<strong>ERREUR CRITIQUE !</strong> Une erreur est survenue lors de l''accès à la base. Merci de reporter cette erreur.", $("#retour_js"));
        });
});

$("h2").click(function () {
    const h2clique = $("h2.clique");
    const differentElement = h2clique[0].id !== this.id;
    if (differentElement) {
        $("fieldset:visible").toggle("fast", "linear");
        h2clique.removeClass("clique");
        $(this).addClass('clique');

        $("#fieldset_" + this.id.substring(6, this.id.length)).toggle("fast", "linear");
    }
});

$(document).ready(function () {
    $("fieldset").toggle();
    $("#fieldset_indice").toggle();
    $("#titre_indice").toggleClass('clique');
});