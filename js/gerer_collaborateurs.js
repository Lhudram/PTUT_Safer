$('#modifier').click(modifier);
$('#supprimer').click(supprimer);
$('#recherche_complet').click(rechercheComplet);
$('#recherche_incomplet').click(rechercheComplet);
if ($("#bouton_supprimer").length !== 0)
    $("#bouton_supprimer").click(bouton_supprimer);

function bouton_supprimer() {
    if ($("#liste_collaborateurs").find("option:selected").length < 1)
        notification("warning", "<strong>ATTENTION !</strong> Vous devez sélectionner un collaborateur.");
    else
        $('#popup_confirmation_suppression').modal();
}

function modifier() {
    if ($("#liste_collaborateurs").find("option:selected").length < 1)
        notification("warning", "<strong>ATTENTION !</strong> Vous devez sélectionner un collaborateur.");
    else
        $("#liste").submit();
}

function supprimer() {
    const liste = $("#liste_collaborateurs");
    if (liste.find("option:selected").length < 1) {
        notification("warning", "<strong>ATTENTION !</strong> Vous devez sélectionner un collaborateur.");
    } else {
        const id = liste.find("option:selected").val();
        $.ajax({
            method: "POST",
            url: "index.php?page=13",
            data: {id: id}
        })
            .done(function (response) {
                response = $(response).find("#response")[0].innerText;
                if (response !== "1")
                    notification("danger", "<strong>ERREUR CRITIQUE !</strong> Une erreur est survenue lors de la suppression. Merci de de reporter cette erreur : " + response);
                else
                    notification("success", "Le collaborateur a bien été supprimé.");
                liste.find('option[value="' + id + '"]').remove();
            })
            .fail(function () {
                notification("danger", "<strong>ERREUR CRITIQUE !</strong> Une erreur est survenue lors de la suppression. Merci de reporter cette erreur.");
            });
    }
}

function rechercheComplet() {
    const selectComplet = $("#recherche_complet:checked, #recherche_incomplet:checked");
    console.log(selectComplet);
    if (selectComplet.length < 1)
        $(this).prop("checked", true);
}
