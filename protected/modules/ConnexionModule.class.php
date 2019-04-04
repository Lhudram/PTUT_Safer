<?php

class ConnexionModule extends PDO
{
    protected $dbo;

    private $options = ['cost' => 13];
    private $bdd_name = "bdd_auth";

    public function __construct()
    {
        $bool = ENV == 'dev';
        try {
            $this->dbo = parent::__construct("pgsql:host=" . DBHOST . "; port=" . DBPORT . "; dbname=" . $this->bdd_name, DBUSER, DBPASSWD,
                array(PDO::ATTR_PERSISTENT => false, PDO::ATTR_ERRMODE => $bool, PDO::ERRMODE_EXCEPTION => $bool));
            $this->query("set names 'utf8';");
        } catch (PDOException $e) {
            echo 'Echec lors de la connexion : ' . $e->getMessage();
        }
    }

    public function connexion(String $user, String $password): ?array
    {
        $requete = $this->prepare('SELECT id, password, admin FROM authentification WHERE login = :login');
        $requete->bindValue(':login', $user, PDO::PARAM_STR);
        $requete->execute();
        if (!$res = $requete->fetch(PDO::FETCH_OBJ))
            return null;
        if (!password_verify($password, $res->password))
            return null;
        return ['id' => $res->id, 'admin' => $res->admin];
    }

    public function add(String $user, String $password, Bool $isAdmin): bool
    {
        $hash = password_hash($password, CRYPT_BLOWFISH, $this->options);
        $requete = $this->prepare('INSERT INTO authentification (login, password, admin) VALUES (:login, :password, :admin)');
        $requete->bindValue(':login', $user, PDO::PARAM_STR);
        $requete->bindValue(':password', $hash, PDO::PARAM_STR);
        $requete->bindValue(":admin", $isAdmin, PDO::PARAM_BOOL);
        return $requete->execute();
    }

    public function getAll(): ?array
    {
        $requete = $this->prepare('SELECT * FROM authentification ORDER BY id');
        $requete->execute();
        while ($user = $requete->fetch(PDO::FETCH_OBJ))
            $res[] = $user;
        $requete->closeCursor();
        return (isset($res)) ? $res : null;
    }

    public function modifyUser(String $id, String $login, String $password): bool
    {
        $hash = password_hash($password, CRYPT_BLOWFISH, $this->options);
        $requete = $this->prepare('UPDATE authentification SET password = :password, login = :login WHERE id = :id');
        $requete->bindValue(':password', $hash, PDO::PARAM_STR);
        $requete->bindValue(':login', $login, PDO::PARAM_STR);
        $requete->bindValue(':id', $id);
        return $requete->execute();
    }

    public function delete(String $id): Bool
    {
        $requete = $this->prepare('DELETE FROM authentification WHERE id = :id');
        $requete->bindValue(':id', $id);
        return $requete->execute();
    }
}

?>