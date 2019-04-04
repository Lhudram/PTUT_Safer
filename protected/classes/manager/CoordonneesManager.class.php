<?php

class CoordonneesManager
{
    private $db;

    public function __construct(Mypdo $db)
    {
        $this->db = $db;
    }

    public function add(Coordonnees $coordonnees, Int $id): bool
    {
        $reqSQL = 'INSERT INTO COORDONNEES VALUES (:idCollaborateur, :adresse, :complementAdresse, :codePostal, :commune, :codePays, :iban, :bic)';
        $reqPreparee = $this->db->prepare($reqSQL);
        $reqPreparee->bindValue(':idCollaborateur', $id);
        $reqPreparee->bindValue(':adresse', $coordonnees->getAdresse(), PDO::PARAM_STR);
        $reqPreparee->bindValue(':complementAdresse', $coordonnees->getComplementAdresse(), PDO::PARAM_STR);
        $reqPreparee->bindValue(':codePostal', $coordonnees->getCodePostal());
        $reqPreparee->bindValue(':commune', $coordonnees->getCommune(), PDO::PARAM_STR);
        $reqPreparee->bindValue(':codePays', $coordonnees->getCodePays(), PDO::PARAM_STR);
        $reqPreparee->bindValue(':iban', $coordonnees->getIban(), PDO::PARAM_STR);
        $reqPreparee->bindValue(':bic', $coordonnees->getBic(), PDO::PARAM_STR);
        return $reqPreparee->execute();
    }

    public function get(Int $num): ?Coordonnees
    {
        $sql = 'SELECT adresse, complement_adresse, code_postal, commune, code_pays, iban, bic FROM coordonnees WHERE id_collaborateur = :num';
        $requete = $this->db->prepare($sql);
        $requete->bindValue(':num', $num);
        $requete->execute();
        if (!$res = $requete->fetch(PDO::FETCH_OBJ))
            return null;
        $requete->closeCursor();
        return new Coordonnees($res->adresse, $res->complement_adresse, $res->code_postal, $res->commune, $res->code_pays, $res->iban, $res->bic);
    }

    public function modifier(Coordonnees $coordonnees, Int $id): bool
    {
        $sql = 'UPDATE coordonnees SET adresse = :adresse, complement_adresse = :complementAdresse, code_postal = :cp, commune = :commune, code_pays = :codePays, iban = :iban, bic = :bic WHERE id_collaborateur = :id';
        $requete = $this->db->prepare($sql);
        $requete->bindValue(':adresse', $coordonnees->getAdresse(), PDO::PARAM_STR);
        $requete->bindValue(':complementAdresse', $coordonnees->getComplementAdresse(), PDO::PARAM_STR);
        $requete->bindValue(':cp', $coordonnees->getCodePostal());
        $requete->bindValue(':commune', $coordonnees->getCommune(), PDO::PARAM_STR);
        $requete->bindValue(':codePays', $coordonnees->getCodePays(), PDO::PARAM_STR);
        $requete->bindValue(':iban', $coordonnees->getIban(), PDO::PARAM_STR);
        $requete->bindValue(':bic', $coordonnees->getBic(), PDO::PARAM_STR);
        $requete->bindValue(':id', $id);
        return $requete->execute();
    }

    public function supprimer(Int $id): bool
    {
        $requete = $this->db->prepare('DELETE FROM coordonnees WHERE id_collaborateur = :id');
        $requete->bindValue(':id', $id);
        return $requete->execute();
    }

    public function estComplet(Coordonnees $coordonnees): bool
    {
        return !(empty($coordonnees->getAdresse()) || empty($coordonnees->getCodePostal()) || empty($coordonnees->getCommune()) || empty($coordonnees->getCodePays()) || empty($coordonnees->getIban()) && empty($coordonnees->getBic()));
    }

}