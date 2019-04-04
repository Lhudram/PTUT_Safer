<?php

class EtatCivilManager
{
    private $db;

    public function __construct(Mypdo $db)
    {
        $this->db = $db;
    }

    public function add(EtatCivil $etatCivil): bool
    {
        $reqSQL = 'INSERT INTO ETAT_CIVIL (civilite, nom, prenom, nom_jeune_fille, id_situation_familiale, nb_enfants, est_complet) VALUES (:civilite, :nom, :prenom, :nomJeuneFille, :situationFamiliale, :nbEnfants, :estComplet)';
        $reqPreparee = $this->db->prepare($reqSQL);
        $reqPreparee->bindValue(':civilite', $etatCivil->getCivilite());
        $reqPreparee->bindValue(':nom', $etatCivil->getNom(), PDO::PARAM_STR);
        $reqPreparee->bindValue(':prenom', $etatCivil->getPrenom(), PDO::PARAM_STR);
        $reqPreparee->bindValue(':nomJeuneFille', $etatCivil->getNomJeuneFille(), PDO::PARAM_STR);
        $reqPreparee->bindValue(':situationFamiliale', $etatCivil->getIdSituationFamiliale());
        $reqPreparee->bindValue(':nbEnfants', $etatCivil->getNbEnfants());
        $reqPreparee->bindValue(':estComplet', $etatCivil->getEstComplet(), PDO::PARAM_BOOL);
        return $reqPreparee->execute();
    }

    public function get(Int $num): ?EtatCivil
    {
        $sql = 'SELECT civilite, nom, prenom, nom_jeune_fille,id_situation_familiale, nb_enfants,est_complet FROM etat_civil WHERE id_collaborateur = :num';
        $requete = $this->db->prepare($sql);
        $requete->bindValue(':num', $num);
        $requete->execute();
        if (!$res = $requete->fetch(PDO::FETCH_OBJ))
            return null;
        $requete->closeCursor();
        return new EtatCivil($res->civilite, $res->nom, $res->prenom, $res->nom_jeune_fille, $res->id_situation_familiale, $res->nb_enfants, $res->est_complet);
    }

    public function modifier(EtatCivil $etatCivil, Int $id): bool
    {
        $sql = 'UPDATE etat_civil SET civilite = :civilite, nom = :nom, prenom = :prenom, nom_jeune_fille = :nomJeuneFille, id_situation_familiale = :idSituation, nb_enfants = :nbEnfants, est_complet = :estComplet WHERE id_collaborateur = :id';
        $requete = $this->db->prepare($sql);
        $requete->bindValue(':civilite', $etatCivil->getCivilite());
        $requete->bindValue(':nom', $etatCivil->getNom(), PDO::PARAM_STR);
        $requete->bindValue(':prenom', $etatCivil->getPrenom(), PDO::PARAM_STR);
        $requete->bindValue(':nomJeuneFille', $etatCivil->getNomJeuneFille(), PDO::PARAM_STR);
        $requete->bindValue(':idSituation', $etatCivil->getIdSituationFamiliale());
        $requete->bindValue(':nbEnfants', $etatCivil->getNbEnfants());
        $requete->bindValue(':estComplet', $etatCivil->getEstComplet(), PDO::PARAM_BOOL);
        $requete->bindValue(':id', $id);
        return $requete->execute();
    }

    public function supprimer(Int $id): bool
    {
        $requete = $this->db->prepare('DELETE FROM etat_civil WHERE id_collaborateur = :id');
        $requete->bindValue(':id', $id);
        return $requete->execute();
    }

    public function estComplet(EtatCivil $etatCivil): bool
    {
        return !(empty($etatCivil->getCivilite()) || empty($etatCivil->getNom()) || empty($etatCivil->getPrenom()) || empty($etatCivil->getIdSituationFamiliale()));
    }
}

?>
