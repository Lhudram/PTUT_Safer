<?php
session_start();
if (isset($_GET["logout"])) {
    session_destroy();
    header("Location: index.php");
}
date_default_timezone_set('Europe/Paris');
require_once("protected/include/numero_pages.inc.php");
require_once("protected/include/config.inc.php");
require_once("protected/include/autoLoad.inc.php");
require_once("protected/include/fonctions.inc.php");
require_once("protected/include/header.inc.php");

if (isset($_GET["page"]) && $_GET["page"] != $pages["ajouter_collaborateur"]) {
    ?>
    <script>
        if (sessionStorage.getItem("id"))
            sessionStorage.removeItem("id");
    </script>
    <?php
}
?>
    </head>
    <body>
    <div id="corps">
        <?php
        require_once("protected/include/text.inc.php");
        ?>
    </div>
<?php
require_once("protected/include/footer.inc.php");

///////////////////////////////
/// ZONE DE TEST
///////////////////////////////