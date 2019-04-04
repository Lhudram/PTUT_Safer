<?php

class Mypdo extends PDO
{
    protected $dbo;

    public function __construct()
    {
        // le parametrage de cette classe se fait dans le fichier config.inc.php
        $bool = ENV == 'dev';
        try {
            $this->dbo = parent::__construct("pgsql:host=" . DBHOST . "; port=" . DBPORT . "; dbname=" . DBNAME, DBUSER, DBPASSWD,
                array(PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => $bool, PDO::ERRMODE_EXCEPTION => $bool));
            $this->query("set names 'utf8';");
        } catch (PDOException $e) {
            echo 'Echec lors de la connexion à la base de données : ' . $e->getMessage();
        }
    }

}

?>
