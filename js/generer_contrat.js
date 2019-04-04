$(".paragrapheNonObligatoire").click(function () {
    $("#apercu" + $(this).attr("id")).toggle();
    let indice = 1;
    $(".apercu[estarticle='true']:not(:hidden)").each(function () {
        const txt = $(this).children().text().split(" ");
        txt[1] = indice++;
        $(this).children().text(txt.join(" "));
    });
});

$("#generer").click(function(){
    $("#liste_paragraphe").append("<input type='hidden' value='1' name='generer_contrat'>");
    $("#liste_paragraphe").submit();
});

