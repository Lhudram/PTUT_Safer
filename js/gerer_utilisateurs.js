const id_utilisateur = $("#id_utilisateur");

id_utilisateur.change(function () {
    $("#password_user, #confirmation_password_user, #login_utilisateur").val("");
    $("#login_utilisateur").val(getLogin(id_utilisateur.find("option:selected").text()));
});

$(document).ready(function () {
    $("#login_utilisateur").val(getLogin(id_utilisateur.find("option").first().text()));
    id_utilisateur.find("option").first().attr("selected", true);
});

function getLogin(text) {
    text = text.split(" ");
    text.shift();
    return text.join(" ");
}

$("#supprimer_utilisateur").click(function () {
    if (id_utilisateur.find("option:selected").length > 0)
        $("#popup_confirmation_suppression").modal();
    else {
        notification("danger", "Vous devez sélectionner un utilisateur.");
    }
});

$("#supprimer").click(function () {
    if (id_utilisateur.find("option:selected").length > 0) {
        $.ajax({
            method: "POST",
            url: "index.php?page=16",
            data: {id_suppression: $("#id_utilisateur").find("option:selected").val()}
        })
            .done(function (response) {
                response = $(response).find("#response")[0].innerText;
                if (response === "1") {
                    notification("success", "L'utilisateur a bien été supprimé.");
                    $("#id_utilisateur").find("option:selected").remove();
                } else {
                    $("#retour_suppression")
                        .attr("class", "alert, alert-danger text-center")
                        .html("<strong>ERREUR !</strong> L'utilisateur n'a pas pu être supprimé. Merci de reporter cette erreur.");
                }
            })
            .fail(function () {
                $("#retour_suppression")
                    .attr("class", "alert, alert-danger text-center")
                    .html("<strong>ERREUR !</strong> Un problème est survenu lors de l'envoi de la requête au serveur. Merci de reporter cette erreur.");
            })
    } else {
        notification("danger", "Vous devez sélectionner un utilisateur.");
    }
});