$("#sauvegarder").click(function () {
    if ($("#nom").val() === "" || $("#prenom").val() === "") {
        notification("warning", "<strong>ERREUR !</strong> Vous devez spécifier un nom et un prénom.");
    } else {
        ajout_id_form();
        if (sessionStorage.getItem("id"))
            sessionStorage.removeItem("id");
        $("#formulaire_ajout").submit();
    }
});

$(".rubrique").click(function () {
    if ($("#nom").val() === "" || $("#prenom").val() === "") {
        notification("warning", "<strong>ERREUR !</strong> Vous devez spécifier un nom et un prénom.");
    } else {
        ajout_id_form();
        $.ajax({
            method: "POST",
            url: "index.php?page=12",
            data: $($("#formulaire_ajout")).serialize()
        })
            .done(function (response) {
                const id = $(response).find("#response")[0].innerText;
                if (!sessionStorage.getItem("id"))
                    sessionStorage.setItem("id", id);
                notification("success", "Le collaborateur a bien été sauvegardé.");
            })
            .fail(function () {
                if (sessionStorage.getItem("id"))
                    sessionStorage.removeItem("id");
                notification("danger", "<strong>ERREUR CRITIQUE !</strong> Une erreur est survenue lors de la sauvegarde. Merci de reporter cette erreur.");
            });
    }
});

function ajout_id_form() {
    if (sessionStorage.getItem("id")) {
        $("#formulaire_ajout").append('<input name="id" type="hidden" value="' + sessionStorage.getItem("id") + '">');
    }
}