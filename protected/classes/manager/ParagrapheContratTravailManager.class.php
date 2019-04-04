<?php

class ParagrapheContratTravailManager
{
    private $db;

    public function __construct(Mypdo $db)
    {
        $this->db = $db;
    }

    public function add(ParagrapheContratTravail $paragraphe): bool
    {
        if ($paragraphe->getIndice() != $this->getNbParagraphes() + 1) {
            if ($paragraphe->getIndice() <= $this->getNbParagraphes()) {

                $nbParagraphes = $this->getNbParagraphes();

                for ($i = $nbParagraphes ; $i >= $paragraphe->getIndice() ; $i--)
                {
                    $this->incrementerIndice($this->get($i));
                }
            } else {
                $paragraphe->setIndice($this->getNbParagraphes() + 1);
            }
        }

        $sql = 'INSERT INTO contrat_travail VALUES (:indice, :estObligatoire, :estArticle, :afficheTitre, :intitule, :contenu)';
        $requete = $this->db->prepare($sql);
        $requete->bindValue(':indice', $paragraphe->getIndice());
        $requete->bindValue(':estObligatoire', $paragraphe->getEstObligatoire(), PDO::PARAM_BOOL);
        $requete->bindValue(':estArticle', $paragraphe->getEstArticle(), PDO::PARAM_BOOL);
        $requete->bindValue(':afficheTitre', $paragraphe->getAfficheTitre(), PDO::PARAM_BOOL);
        $requete->bindValue(':intitule', $paragraphe->getIntitule());
        $requete->bindValue(':contenu', $paragraphe->getContenu());
        return $requete->execute();
    }

    public function get(Int $indice): ?ParagrapheContratTravail
    {
        $sql = 'SELECT indice, est_obligatoire, est_article, titre_affiche, intitule, contenu FROM contrat_travail WHERE indice = :indice';
        $requete = $this->db->prepare($sql);
        $requete->bindValue(':indice', $indice);
        $requete->execute();

        if (!$res = $requete->fetch(PDO::FETCH_OBJ))
            return null;

        $requete->closeCursor();

        return new ParagrapheContratTravail($res->indice, $res->est_obligatoire, $res->est_article, $res->titre_affiche, $res->intitule, $res->contenu);
    }

    public function getAll(): ?array
    {
        $sql = 'SELECT indice, est_obligatoire, est_article, titre_affiche, intitule, contenu FROM contrat_travail ORDER BY indice ASC';
        $requete = $this->db->prepare($sql);
        $requete->execute();

        $paragraphes = array();

        while ($paragraphe = $requete->fetch(PDO::FETCH_OBJ)) {
            $paragraphes[] = new ParagrapheContratTravail($paragraphe->indice, $paragraphe->est_obligatoire, $paragraphe->est_article, $paragraphe->titre_affiche, $paragraphe->intitule, $paragraphe->contenu);
        }
        $requete->closeCursor();

        return $paragraphes;
    }

    public function modifier(Int $ancienIndice, ParagrapheContratTravail $paragraphe): bool
    {
        $sql = 'UPDATE contrat_travail SET indice = :indice, est_obligatoire = :estObligatoire, est_article = :estArticle, titre_affiche = :afficheTitre ,intitule = :intitule, contenu = :contenu WHERE indice = :ancienIndice';
        $requete = $this->db->prepare($sql);
        $requete->bindValue(':indice', $paragraphe->getIndice());
        $requete->bindValue(':estObligatoire', $paragraphe->getEstObligatoire(), PDO::PARAM_BOOL);
        $requete->bindValue(':estArticle', $paragraphe->getEstArticle(), PDO::PARAM_BOOL);
        $requete->bindValue(':afficheTitre', $paragraphe->getAfficheTitre(), PDO::PARAM_BOOL);
        $requete->bindValue(':intitule', $paragraphe->getIntitule());
        $requete->bindValue(':contenu', $paragraphe->getContenu());
        $requete->bindValue(':ancienIndice', $ancienIndice);

        return $requete->execute();
    }

    public function echangerIndices(Int $indice1, Int $indice2): bool
    {
        if ($indice1 == $indice2)
            return false;

        $paragrapheIndice1 = $this->get($indice1);
        $paragrapheIndice2 = $this->get($indice2);

        $paragrapheIndice1->setIndice($indice2);
        $paragrapheIndice2->setIndice($indice1);

        if ($indice1 < $indice2) {
            $indiceSuppression2 = $indice2 - 1;
        } else {
            $indiceSuppression2 = $indice2 + 1;
        }

        if (!$this->supprimer($indice1))
            return false;

        if (!$this->add($paragrapheIndice1))
            return false;

        if (!$this->supprimer($indiceSuppression2))
            return false;

        if (!$this->add($paragrapheIndice2))
            return false;

        return true;
    }

    public function supprimer(Int $indice): bool
    {
        $nbParagraphes = $this->getNbParagraphes();

        if ($indice > $nbParagraphes)
            return false;

        $requete = $this->db->prepare('DELETE FROM contrat_travail WHERE indice = :indice');
        $requete->bindValue(':indice', $indice);

        if (!$requete->execute())
            return false;

        if ($indice != $this->getNbParagraphes() + 1) {

            for ($i = $indice + 1 ; $i < $nbParagraphes + 1 ; $i++)
            {
                $this->decrementerIndice($this->get($i));
            }
        }

        return true;
    }

    public function getNbParagraphes(): Int
    {
        $requete = $this->db->prepare('SELECT COUNT(indice) as nb_paragraphes FROM contrat_travail');
        $requete->execute();
        return $requete->fetch(PDO::FETCH_OBJ)->nb_paragraphes;
    }

    public function incrementerIndice(ParagrapheContratTravail $paragraphe): void
    {
        $indiceActuel = $paragraphe->getIndice();
        $paragraphe->setIndice($paragraphe->getIndice() + 1);

        $this->modifier($indiceActuel, $paragraphe);
    }

    public function decrementerIndice(ParagrapheContratTravail $paragraphe): void
    {
        $indiceActuel = $paragraphe->getIndice();
        $paragraphe->setIndice($paragraphe->getIndice() - 1);

        $this->modifier($indiceActuel, $paragraphe);
    }
}
