<?php


class SalaireManager
{
    private $db;

    public function __construct(Mypdo $db)
    {
        $this->db = $db;
    }

    public function add(Int $idBulletinModele, Int $id): bool
    {
        $reqSQL = 'INSERT INTO SALAIRE VALUES (:idCollaborateur, :idBulletinModele)';
        $reqPreparee = $this->db->prepare($reqSQL);
        $reqPreparee->bindValue(':idCollaborateur', $id);
        $reqPreparee->bindValue(':idBulletinModele', $idBulletinModele);
        return $reqPreparee->execute();
    }

    public function get(Int $num): ?Int
    {
        $sql = 'SELECT id_bulletin_modele_salaire FROM salaire WHERE id_collaborateur = :num';
        $requete = $this->db->prepare($sql);
        $requete->bindValue(':num', $num);
        $requete->execute();
        if (!$res = $requete->fetch(PDO::FETCH_OBJ))
            return null;
        $requete->closeCursor();
        return $res->id_bulletin_modele_salaire;
    }

    public function modifier(Int $idBulletinModeleSalaire, Int $id): bool
    {
        $sql = 'UPDATE salaire SET id_bulletin_modele_salaire = :idBulletin WHERE id_collaborateur = :id';
        $requete = $this->db->prepare($sql);
        $requete->bindValue(':idBulletin', $idBulletinModeleSalaire);
        $requete->bindValue(':id', $id);
        return $requete->execute();
    }

    public function supprimer(Int $id): bool
    {
        $requete = $this->db->prepare('DELETE FROM salaire WHERE id_collaborateur = :id');
        $requete->bindValue(':id', $id);
        return $requete->execute();
    }
}