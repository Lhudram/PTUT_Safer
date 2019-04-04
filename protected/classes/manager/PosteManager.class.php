<?php

class PosteManager
{
    private $db;

    public function __construct(Mypdo $db)
    {
        $this->db = $db;
    }

    public function add(Poste $poste, Int $id): bool
    {
        $reqSQL = 'INSERT INTO POSTE VALUES (:idCollaborateur, :idDepartementPoste, :idCategorie)';
        $reqPreparee = $this->db->prepare($reqSQL);
        $reqPreparee->bindValue(':idCollaborateur', $id);
        $reqPreparee->bindValue(':idDepartementPoste', $poste->getIdDepartementPoste());
        $reqPreparee->bindValue(':idCategorie', $poste->getIdCategorie());
        return $reqPreparee->execute();
    }

    public function get(Int $num): ?Poste
    {
        $sql = 'SELECT id_departement_poste, id_categorie_poste FROM poste WHERE id_collaborateur = :num';
        $requete = $this->db->prepare($sql);
        $requete->bindValue(':num', $num);
        $requete->execute();
        if (!$res = $requete->fetch(PDO::FETCH_OBJ))
            return null;
        $requete->closeCursor();
        return new Poste($res->id_departement_poste, $res->id_categorie_poste);
    }

    public function modifier(Poste $poste, Int $id): bool
    {
        $sql = 'UPDATE poste SET id_departement_poste = :idDepPoste, id_categorie_poste = :idCatPoste WHERE id_collaborateur = :id';
        $requete = $this->db->prepare($sql);
        $requete->bindValue(':idDepPoste', $poste->getIdDepartementPoste());
        $requete->bindValue(':idCatPoste', $poste->getIdCategorie());
        $requete->bindValue(':id', $id);
        return $requete->execute();
    }

    public function supprimer(Int $id): bool
    {
        $requete = $this->db->prepare('DELETE FROM poste WHERE id_collaborateur = :id');
        $requete->bindValue(':id', $id);
        return $requete->execute();
    }

    public function estComplet(Poste $poste): bool
    {
        return !(empty($poste->getIdDepartementPoste()) || empty($poste->getIdCategorie()));
    }
}