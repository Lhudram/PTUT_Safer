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

$(document).ready(function () {
    $("#etat_civil").toggle();
    $("#intitule_etat_civil").toggleClass('clique');
});

$("input").change(function () {
    let inputs = [];
    let last = false;
    let double = false;
    $('input[type="number"]').each(function () {
        if ($(this).val() !== "0")
            inputs.push($(this));
    })
        .css("background-color", "");
    if (inputs.length > 1) {
        for (let i = 0; i < inputs.length - 1; i++)
            for (let j = i + 1; j < inputs.length; j++)
                if (inputs[i].val() === inputs[j].val()) {
                    inputs[i].css("background-color", "#F2DEDE");
                    inputs[j].css("background-color", "#F2DEDE");
                    last = last | j === inputs.length - 1;
                    double = true;
                    break;
                }
        if (last)
            inputs[inputs.length - 1].css("background-color", "#F2DEDE");
        if (double) {
            $("#exporter").prop("disabled", true);
            $("#retour_js")
                .attr("class", "alert alert-danger text-center")
                .html("<strong>ATTENTION !</strong> Vous ne pouvez pas utiliser plusieurs fois le même nombre.");
        } else
            disable();
    } else
        disable();

    function disable() {
        $("#exporter").prop("disabled", false);
        const retour = $("#retour_js");
        retour.removeAttr("class");
        retour.html("");
    }

});

$("#texporter").click(function () {
    let i = 1;
    $('input[type="number"]').each(function () {
        $(this).val(i++);
    });
    $("form").first().submit();
});