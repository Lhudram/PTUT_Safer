<?php

function my_autoload($className)
{
    $paths = array(
        "protected/classes/global/",
        "protected/classes/ajout/",
        "protected/classes/manager/",
        "protected/modules/",
        "protected/classes/listes/"
    );

    $extention = ".class.php";

    foreach ($paths as $path) {
        if (file_exists($path . $className . $extention)) {
            include($path . $className . $extention);
            break;
        }
    }
}

spl_autoload_register("my_autoload");

?>