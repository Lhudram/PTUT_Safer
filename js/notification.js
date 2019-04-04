function notification(type, msg) {
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
        $("#retour_js")
            .removeAttr("class")
            .html("");
    }, 4000);
}