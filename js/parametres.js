$("h2").click(function () {
    const h2clique = $("h2.clique");
    const differentElement = h2clique[0].id !== this.id;

    if (differentElement) {
        $("#editer_situation_familiale:visible").toggle("fast", "linear");
        h2clique.removeClass("clique");
        $(this).addClass('clique');

        $("#" + this.id.substring(6, this.id.length)).toggle("fast", "linear");
        $("." + this.id.substring(6, this.id.length)).toggle("fast", "linear");
    }
});