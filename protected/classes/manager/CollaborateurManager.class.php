<?php

class CollaborateurManager
{
    private $db;

    public function __construct(Mypdo $db)
    {
        $this->db = $db;
    }

    public function getCollaborateurSaisi(): ?Collaborateur
    {
        $etatCivil = new EtatCivil($_POST["civilite"], $_POST["nom"], $_POST["prenom"], $_POST["nom_jeune_fille"], $_POST["situation_familiale"], $_POST["nombre_enfants"], false);

        $immatriculation = new Immatriculation($_POST["date_naissance"], $_POST["departement"], $_POST["code_pays"], $_POST["commune_naissance"], $_POST["code_commune"], $_POST["nationalite"],
            implode(' ', [$_POST["numeros_immatriculation_sexe"], $_POST["numeros_immatriculation_annee_naissance"], $_POST["numeros_immatriculation_mois_naissance"],
                $_POST["numeros_immatriculation_departement_naissance"], $_POST["numeros_immatriculation_commune_naissance"], $_POST["numeros_immatriculation_acte_naissance"],
                $_POST["numeros_immatriculation_controle"]]),
            $_POST["email"]);

        $coordonnees = new Coordonnees($_POST["adresse"], $_POST["complement_adresse"], $_POST["code_postal"], $_POST["commune"], $_POST["code_pays"], $_POST["iban"], $_POST["bic"]);

        $contrat = new Contrat($_POST["nature_contrat"], $_POST["date_debut"], $_POST["fin_periode_essai"], $_POST["type_entree_contrat"], $_POST["etablissement"]);

        $poste = new Poste($_POST["departement_poste"], $_POST["categorie_poste"]);

        $emploi = new Emploi($_POST["emploi_CCN"], $_POST["coefficient"]);

        $statut = new Statut($_POST["convention"], !empty($_POST["agirc"]));

        $bulletin_modele = $_POST["bulletin_modele"];

        $horaire = new Horaire($_POST["nb_heures_travaillees"], $_POST["modalite_exercice_travail"]);

        $personnesAPrevenir = new PersonnesAPrevenir($_POST["nom_personne_a_prevenir_1"], $_POST["telephone_personne_a_prevenir_1"], $_POST["nom_personne_a_prevenir_2"],
            $_POST["telephone_personne_a_prevenir_2"]);

        $collaborateur = new Collaborateur($etatCivil, $immatriculation, $coordonnees, $contrat, $poste, $emploi, $statut, $bulletin_modele, $horaire, $personnesAPrevenir);
        $collaborateur->getEtatCivil()->setEstComplet($this->estComplet($collaborateur));
        return $collaborateur;
    }

    public function estComplet(Collaborateur $collaborateur): bool
    {
        $res = (new EtatCivilManager($this->db))->estComplet($collaborateur->getEtatCivil());
        $res = $res && (new ImmatriculationManager($this->db))->estComplet($collaborateur->getImmatriculation());
        $res = $res && (new CoordonneesManager($this->db))->estComplet($collaborateur->getCoordonnees());
        $res = $res && (new ContratManager($this->db))->estComplet($collaborateur->getContrat());
        $res = $res && (new PosteManager($this->db))->estComplet($collaborateur->getPoste());
        $res = $res && (new EmploiManager($this->db))->estComplet($collaborateur->getEmploi());
        $res = $res && (new StatutManager($this->db))->estComplet($collaborateur->getStatut());
        $res = $res && $collaborateur->getIdBulletinModele() !== null;
        $res = $res && (new HoraireManager($this->db))->estComplet($collaborateur->getHoraire());

        return $res;
    }

    public function add(Collaborateur $collaborateur): bool
    {
        $res = (new EtatCivilManager($this->db))->add($collaborateur->getEtatCivil());
        $idcollaborateur = $this->getCurrentCollaborateur();
        $res = $res && (new ImmatriculationManager($this->db))->add($collaborateur->getImmatriculation(), $idcollaborateur);
        $res = $res && (new CoordonneesManager($this->db))->add($collaborateur->getCoordonnees(), $idcollaborateur);
        $res = $res && (new ContratManager($this->db))->add($collaborateur->getContrat(), $idcollaborateur);
        $res = $res && (new PosteManager($this->db))->add($collaborateur->getPoste(), $idcollaborateur);
        $res = $res && (new EmploiManager($this->db))->add($collaborateur->getEmploi(), $idcollaborateur);
        $res = $res && (new StatutManager($this->db))->add($collaborateur->getStatut(), $idcollaborateur);
        $res = $res && (new SalaireManager($this->db))->add($collaborateur->getIdBulletinModele(), $idcollaborateur);
        $res = $res && (new HoraireManager($this->db))->add($collaborateur->getHoraire(), $idcollaborateur);
        $res = $res && (new AdministratifManager($this->db))->add($collaborateur->getPersonnesAPrevenir(), $idcollaborateur);

        return $res;
    }

    public function getCurrentCollaborateur(): ?Int
    {
        $requete = $this->db->prepare('SELECT MAX(id_collaborateur) AS id FROM etat_civil');
        $requete->execute();
        $res = $requete->fetch(PDO::FETCH_OBJ);
        $requete->closeCursor();
        return ($res) ? $res->id : null;
    }

    public function getFullCollaborateur(Int $numero): ?Collaborateur
    {
        $etatCivil = (new EtatCivilManager($this->db))->get($numero);
        $immatriculation = (new ImmatriculationManager($this->db))->get($numero);
        $coordonnees = (new CoordonneesManager($this->db))->get($numero);
        $contrat = (new ContratManager($this->db))->get($numero);
        $poste = (new PosteManager($this->db))->get($numero);
        $emploi = (new EmploiManager($this->db))->get($numero);
        $statut = (new StatutManager($this->db))->get($numero);
        $bulletin_modele = (new SalaireManager($this->db))->get($numero);
        $horaire = (new HoraireManager($this->db))->get($numero);
        $personnesAPrevenir = (new AdministratifManager($this->db))->get($numero);

        if ($etatCivil)
            return new Collaborateur($etatCivil, $immatriculation, $coordonnees, $contrat, $poste, $emploi, $statut, $bulletin_modele, $horaire, $personnesAPrevenir);
        return null;
    }

    public function getAllCollaborateur(): ?array
    {
        $requete = $this->db->prepare('SELECT et.id_collaborateur, nom, prenom, est_complet, intitule_etablissement, intitule_emploi_ccn FROM etat_civil et, emploi em, contrat co, etablissement etab'
            . ', emploi_ccn ec WHERE et.id_collaborateur = em.id_collaborateur AND et.id_collaborateur = co.id_collaborateur AND ec.id_emploi_ccn = em.id_emploi_ccn AND etab.id_etablissement = co.id_etablissement');
        $requete->execute();
        $collaborateurs = array();

        while ($collaborateur = $requete->fetch(PDO::FETCH_OBJ)) {
            $collaborateurs[] = ['id' => $collaborateur->id_collaborateur, 'nom' => $collaborateur->nom, 'prenom' => $collaborateur->prenom,
                'estcomplet' => $collaborateur->est_complet, 'etablissement' => $collaborateur->intitule_etablissement, 'fonction' => $collaborateur->intitule_emploi_ccn];
        }
        $requete->closeCursor();
        return $collaborateurs;
    }

    public function modifierCollaborateur(Collaborateur $collaborateur, Int $id): bool
    {
        $res = (new EtatCivilManager($this->db))->modifier($collaborateur->getEtatCivil(), $id);
        $res = $res && (new ImmatriculationManager($this->db))->modifier($collaborateur->getImmatriculation(), $id);
        $res = $res && (new CoordonneesManager($this->db))->modifier($collaborateur->getCoordonnees(), $id);
        $res = $res && (new ContratManager($this->db))->modifier($collaborateur->getContrat(), $id);
        $res = $res && (new PosteManager($this->db))->modifier($collaborateur->getPoste(), $id);
        $res = $res && (new EmploiManager($this->db))->modifier($collaborateur->getEmploi(), $id);
        $res = $res && (new StatutManager($this->db))->modifier($collaborateur->getStatut(), $id);
        $res = $res && (new SalaireManager($this->db))->modifier($collaborateur->getIdBulletinModele(), $id);
        $res = $res && (new HoraireManager($this->db))->modifier($collaborateur->getHoraire(), $id);
        $res = $res && (new AdministratifManager($this->db))->modifier($collaborateur->getPersonnesAPrevenir(), $id);

        return $res;
    }

    public function supprimerCollaborateur(Int $id): bool
    {
        $res = (new ImmatriculationManager($this->db))->supprimer($id);
        $res = $res && (new CoordonneesManager($this->db))->supprimer($id);
        $res = $res && (new ContratManager($this->db))->supprimer($id);
        $res = $res && (new PosteManager($this->db))->supprimer($id);
        $res = $res && (new EmploiManager($this->db))->supprimer($id);
        $res = $res && (new StatutManager($this->db))->supprimer($id);
        $res = $res && (new SalaireManager($this->db))->supprimer($id);
        $res = $res && (new HoraireManager($this->db))->supprimer($id);
        $res = $res && (new AdministratifManager($this->db))->supprimer($id);
        $res = $res && (new EtatCivilManager($this->db))->supprimer($id);

        return $res;
    }

    public function rechercher(Bool $complet, Bool $incomplet, String $nom, String $prenom, Int $idFonction, Int $idEtablissement): ?array
    {
        $sqlDebut = 'SELECT et.id_collaborateur, nom, prenom, est_complet, intitule_etablissement, intitule_emploi_ccn FROM etat_civil et, emploi em, contrat co, etablissement etab, emploi_ccn ec WHERE et.id_collaborateur = em.id_collaborateur AND' .
            ' et.id_collaborateur = co.id_collaborateur AND ec.id_emploi_ccn = em.id_emploi_ccn AND etab.id_etablissement = co.id_etablissement';
        $sqlFin = ' ORDER BY nom, prenom';

        $sqlConditions = '';

        if ($complet && !$incomplet)
            $sqlConditions = ' AND est_complet = TRUE';
        elseif (!$complet && $incomplet)
            $sqlConditions = ' AND est_complet = FALSE';

        if ($idFonction != 'aucun')
            $sqlConditions = $sqlConditions . ' AND em.id_emploi_ccn = ' . $idFonction;

        if ($idEtablissement != 'aucun')
            $sqlConditions = $sqlConditions . ' AND co.id_etablissement = ' . $idEtablissement;

        $requete = $this->db->prepare($sqlDebut . $sqlConditions . $sqlFin);
        $requete->execute();
        $recherches = array();
        while ($res = $requete->fetch(PDO::FETCH_OBJ)) {
            $recherches[] = ['id' => $res->id_collaborateur, 'nom' => $res->nom, 'prenom' => $res->prenom, 'estcomplet' => $res->est_complet,
                'etablissement' => $res->intitule_etablissement, 'fonction' => $res->intitule_emploi_ccn];
        }
        $requete->closeCursor();

        if (!empty($nom) || !empty($prenom)) {
            $end = true;
            if (!empty($nom)) {
                $chaineCherchee = controleEspaces($nom);
                $param = "nom";
            } else {
                $chaineCherchee = controleEspaces($prenom);
                $param = "prenom";
            }
            while ($end) {
                $chaineCherchee = str_replace(array("-", "_", "/", " "), "|", $chaineCherchee);
                $chaineCherchee = retirerAccents($chaineCherchee);
                $chaineCherchee = '/' . $chaineCherchee . '/i';
                $resultat = array();

                foreach ($recherches as $recherche) {
                    $nomCollaborateur = str_replace(array("-", "_", "/", " "), "", $recherche[$param]);
                    $nomCollaborateur = retirerAccents($nomCollaborateur);
                    if (preg_match($chaineCherchee, $nomCollaborateur))
                        $resultat[] = $recherche;
                }

                $recherches = $resultat;

                if (!empty($nom) && !empty($prenom) && $param != "prenom") {
                    $chaineCherchee = controleEspaces($prenom);
                    $param = "prenom";
                } else
                    $end = false;
            }
        }

        return $recherches;
    }

    public function exporter(): String
    {
        $listeDonnees = $_POST;
        array_shift($listeDonnees);
        $listeDonnees = array_flip($listeDonnees);
        unset($listeDonnees[0]);
        ksort($listeDonnees);

        //////////////////////////////
        /// DONNES COLLABORATEURS
        //////////////////////////////
        $sql2 = " FROM etat_civil ec JOIN situation_familiale sf ON ec.id_situation_familiale = sf.id_situation_familiale JOIN salaire s2 ON ec.id_collaborateur = s2.id_collaborateur JOIN "
            . "bulletin_modele_salaire salaire2 ON s2.id_bulletin_modele_salaire = salaire2.id_bulletin_modele_salaire JOIN poste p ON ec.id_collaborateur = p.id_collaborateur JOIN categorie_poste c2 "
            . "ON p.id_categorie_poste = c2.id_categorie_poste JOIN departement_poste dp ON p.id_departement_poste = dp.id_departement_poste JOIN immatriculation i ON ec.id_collaborateur = i.id_collaborateur "
            . "JOIN departement d2 ON i.numero_departement_naissance = d2.numero_departement JOIN pays p2 ON i.code_pays_naissance = p2.code_pays JOIN coordonnees c3 ON ec.id_collaborateur = c3.id_collaborateur "
            . "JOIN pays p3 ON c3.code_pays = p3.code_pays JOIN administratif a ON ec.id_collaborateur = a.id_collaborateur JOIN horaire h2 ON ec.id_collaborateur = h2.id_collaborateur JOIN "
            . "modalite_exercice_travail m2 ON h2.id_modalite_exercice_travail = m2.id_modalite_exercice_travail JOIN statut s3 ON ec.id_collaborateur = s3.id_collaborateur JOIN convention c4 "
            . "ON s3.id_convention = c4.id_convention JOIN emploi e ON ec.id_collaborateur = e.id_collaborateur JOIN emploi_ccn ccn ON e.id_emploi_ccn = ccn.id_emploi_ccn JOIN niveau n "
            . "ON ccn.id_niveau = n.id_niveau JOIN categorie_sp cs ON ccn.id_categoriesp = cs.id_categorie_sp JOIN indice i2 ON e.id_indice = i2.id_indice JOIN contrat c5 ON ec.id_collaborateur = c5.id_collaborateur "
            . "JOIN etablissement e2 ON c5.id_etablissement = e2.id_etablissement JOIN nature_contrat contrat2 ON c5.id_naturecontrat = contrat2.id_nature_contrat JOIN type_entree_contrat contrat3 "
            . "ON c5.id_type_entree_contrat = contrat3.id_type_entree_contrat";

        $replaceArray = [
            "id_situation_familiale" => "ec.",
            "code_pays" => "p3.",
            "id_type_entree_contrat" => "contrat3.",
            "id_etablissement" => "e2.",
            "id_departement_poste" => "dp.",
            "id_categorie_poste" => "c2.",
            "id_emploi_ccn" => "ccn.",
            "id_indice" => "i2.",
            "id_convention" => "c4.",
            "id_bulletin_modele_salaire" => "salaire2.",
            "id_modalite_exercice_travail" => "m2."
        ];

        $replaceCol = array_keys($replaceArray);
        foreach ($replaceCol as $replace) {
            $pos = array_search($replace, $listeDonnees);
            if ($pos !== false)
                $listeDonnees[$pos] = $replaceArray[$replace] . $listeDonnees[$pos];
        }

        $sql1 = "SELECT " . array_shift($listeDonnees);
        foreach ($listeDonnees as $donnee) {
            $sql1 = $sql1 . ', ' . $donnee;
        }
        $sql = $sql1 . $sql2;

        $requete = $this->db->prepare($sql);
        $requete->execute();

        $date = date("d_m_Y");

        $effacement = scandir("protected/documents_generes/export/");
        array_shift($effacement);
        array_shift($effacement);
        foreach ($effacement as $eff) {
            unlink("protected/documents_generes/export/" . $eff);
        }

        $chemin = "protected/documents_generes/export/";
        $nomFichier = $date . "_export_donnees.csv";
        $fichier = fopen($chemin . $nomFichier, "w");
        fputs($fichier, $bom = (chr(0xEF) . chr(0xBB) . chr(0xBF)));

        if ($res = $requete->fetch(PDO::FETCH_OBJ)) {
            fputcsv($fichier, array_keys(get_object_vars($res)), ";");
            fputcsv($fichier, get_object_vars($res), ";");
        }

        while ($res = $requete->fetch(PDO::FETCH_OBJ)) {
            fputcsv($fichier, get_object_vars($res), ";");
        }
        $requete->closeCursor();
        fclose($fichier);

        return $nomFichier;
    }
}