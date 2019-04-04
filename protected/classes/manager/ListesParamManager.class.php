<?php

class ListesParamManager
{
    const BULLETIN_MODELE_SALAIRE = 0;
    const CAT_POSTE = 1;
    const CONVENTION = 2;
    const DEPARTEMENT = 3;
    const DEPARTEMENT_POSTE = 4;
    const EMPLOI_CCN = 5;
    const ETABLISSEMENT = 6;
    const ETAT_CIVIL = 7;
    const MODALITE_EXERCICE_TRAVAIL = 8;
    const NATURE_CONTRAT = 9;
    const PAYS = 10;
    const SITUATION_FAMILIALE = 11;
    const TYPE_ENTREE_CONTRAT = 12;
    const CAT_SP = 13;
    const NIVEAU = 14;
    const INDICE = 15;
    private $db;
    private $managers;

    public function __construct(Mypdo $mypdo)
    {
        $this->db = $mypdo;
        $this->managers = array(
            new BulletinModeleSalaireManager($this->db),
            new CategoriePosteManager($this->db),
            new ConventionManager($this->db),
            new DepartementManager($this->db),
            new DepartementPosteManager($this->db),
            new EmploiCCNManager($this->db),
            new EtablissementManager($this->db),
            new EtatCivilManager($this->db),
            new ModaliteExerciceTravailManager($this->db),
            new NatureContratManager($this->db),
            new PaysManager($this->db),
            new SituationFamilialeManager($this->db),
            new TypeEntreeContratManager($this->db),
            new CategorieSPManager($this->db),
            new NiveauManager($this->db),
            new IndiceManager($this->db)
        );
    }

    public function getAll(Int $constante): ?array
    {
        if ($constante < 0 || $constante > count($this->managers) - 1)
            return null;
        return $this->managers[$constante]->getAll();
    }

    public function add(Int $constante, ...$args): ?bool
    {
        if ($constante < 0 || $constante > count($this->managers) - 1)
            return null;
        return $this->managers[$constante]->add(...$args);
    }

    public function delete(Int $constante, $id): ?bool
    {
        if ($constante < 0 || $constante > count($this->managers) - 1)
            return null;
        return $this->managers[$constante]->delete($id);
    }

    public function update(Int $constante, $valeur, Int $id): ?bool
    {
        if ($constante < 0 || $constante > count($this->managers) - 1)
            return null;
        return $this->managers[$constante]->update($valeur, $id);
    }

    public function getLast(Int $constante): ?int
    {
        if ($constante < 0 || $constante > count($this->managers) - 1 || $constante == ListesParamManager::PAYS || $constante == ListesParamManager::DEPARTEMENT)
            return null;
        return $this->managers[$constante]->getLast();
    }

    public function fonction(Int $constante, String $fonction, ...$args)
    {
        if ($constante < 0 || $constante > count($this->managers) - 1 || $constante == ListesParamManager::PAYS || $constante == ListesParamManager::DEPARTEMENT)
            return null;
        return $this->managers[$constante]->$fonction(...$args);
    }
}

?>