<?php
////////////////////////////////////////////
//Récupération des données du collaborateur
///////////////////////////////////////////

$situationFamilialeManager = new SituationFamilialeManager($db);
$departementManager = new DepartementManager($db);
$typeEntreeContratManager = new TypeEntreeContratManager($db);
$categoriePosteManager = new CategoriePosteManager($db);
$emploiCcnManager = new EmploiCCNManager($db);
$departementPosteManager = new DepartementPosteManager($db);
$etablissementManager = new EtablissementManager($db);
$conventionManager = new ConventionManager($db);
$natureContratManager = new NatureContratManager($db);
$bulletinModeleSalaireManager = new BulletinModeleSalaireManager($db);
$modaliteExerciceTravailManager = new ModaliteExerciceTravailManager($db);
$indiceManager = new IndiceManager($db);

//Etat Civil
$civilite = $etatCivil->getCivilite();
$nomJeuneFille = $etatCivil->getNomJeuneFille();
$situationFamiliale = $situationFamilialeManager->get($etatCivil->getIdSituationFamiliale());
$intituleSituationFamiliale = $situationFamiliale->getIntitule();
$nombreEnfants = $etatCivil->getNbEnfants();

//Immatriculation
$immatriculation = $collaborateur->getImmatriculation();
$dateNaissance = $immatriculation->getDateNaissance();
$departementNaissance = $departementManager->get($immatriculation->getDepNaissance());
$intituleDepartementNaissance = $departementNaissance->getIntitule();
$paysNaissance = $immatriculation->getPaysNaissance();
$communeNaissance = $immatriculation->getCommuneNaissance();
$codeCommuneNaissance = $immatriculation->getCodeCommuneNaissance();
$nationalite = $immatriculation->getNationalite();
$numeroImmatriculation = $immatriculation->getNumImmatriculation();
$email = $immatriculation->getEmail();

//Coordonnées
$coordonnees = $collaborateur->getCoordonnees();
$adresse = $coordonnees->getAdresse();
$complementAdresse = $coordonnees->getComplementAdresse();
$codePostal = $coordonnees->getCodePostal();
$commune = $coordonnees->getCommune();
$codePays = $coordonnees->getCodePays();
$iban = $coordonnees->getIban();
$bic = $coordonnees->getBic();

//Contrat
$contrat = $collaborateur->getContrat();
$natureContrat = $natureContratManager->get($contrat->getIdNature());
$intituleNatureContrat = $natureContrat->getIntitule();
$dateDebutContrat = $contrat->getDateDebut();
$dateFinPeriodeEssai = $contrat->getFinPeriodeEssai();
$typeEntreeContrat = $typeEntreeContratManager->get($contrat->getIdTypeEntree());
$intituleTypeEntreeContrat = $typeEntreeContrat->getIntitule();
$etablissement = $etablissementManager->get($contrat->getIdEtablissement());
$intituleEtablissement = $etablissement->getIntitule();

//Poste
$poste = $collaborateur->getPoste();
$departementPoste = $departementPosteManager->get($poste->getIdDepartementPoste());
$intituleDepartementPoste = $departementPoste->getIntitule();
$categoriePoste = $categoriePosteManager->get($poste->getIdCategorie());
$intituleCategoriePoste = $categoriePoste->getIntitule();

//Emploi
$emploi = $collaborateur->getEmploi();
$emploiCCN = $emploiCcnManager->get($emploi->getIdEmploiCCN());
$intituleEmploiCCN = $emploiCCN->getIntitule();
$missions = $emploiCcnManager->getMission($emploi->getIdEmploiCCN());
$niveau = $emploiCCN->getNiveau();
$coefficient = $emploi->getCoefficient();

//Statut
$statut = $collaborateur->getStatut();
$convention = $conventionManager->get($statut->getIdConvention());
$intituleConvention = $convention->getIntitule();
$estAgirc = $statut->getEstAgirc();

//Salaire
$bulletinModeleSalaire = $bulletinModeleSalaireManager->get($collaborateur->getIdBulletinModele());
$intituleBulletinModeleSalaire = $bulletinModeleSalaire->getIntitule();

//Horaire
$horaire = $collaborateur->getHoraire();
$nbHeuresTravaillees = $horaire->getNbHeuresTravaillees();
$modaliteExerciceTravail = $modaliteExerciceTravailManager->get($horaire->getIdModaliteExerciceTravail());
$intituleModaliteExerciceTravail = $modaliteExerciceTravail->getIntitule();

//Indice salaire
$indice = $indiceManager->get(1);
$valeurIndiceSalaire = $indice->getValeur();

//Personnes à prévenir
$personnesAPrevenir = $collaborateur->getPersonnesAPrevenir();
$nomPremierePersonne = $personnesAPrevenir->getNom1();
$nomDeuxiemePersonne = $personnesAPrevenir->getNom2();
$telPremierePersonne = $personnesAPrevenir->getTel1();
$telDeuxiemePersonne = $personnesAPrevenir->getTel2();

/////////////////////////////////////////////////////////
//Traitement données pour convenir au contrat de travail
/////////////////////////////////////////////////////////

//Etat Civil
if ($civilite == 1) {
    $prefixe_genre = "M";
    $genre = "Monsieur";
    $IlElle = "Il";
    $ilelle = "il";
} else {
    $prefixe_genre = "Mme";
    $genre = "Madame";
    $IlElle = "Elle";
    $ilelle = "elle";
}


if ($natureContrat->getIntitule() == "CDI") {
    $intituleContrat = "contrat à durée indéterminée";
} else if ($natureContrat->getIntitule() == "CDD") {
    $intituleContrat = "contrat à durée déterminée";
}

//Statut et durée de la période d'essai selon grille emploi CCN£
if($estAgirc){
  $estAgirc= "1";
}else{
  $estAgirc = "0";
}

if($niveau <= 3){
    $statutGrille = "Agent d'application";
    $dureePeriodeEssai = "2 mois";
}else if($niveau <= 7){
    $statutGrille = "Cadre";
    $dureePeriodeEssai = "3 mois";
}else if($niveau <= 13){
    $statutGrille = "Personnel d'encadrement";
    $dureePeriodeEssai = "4 mois";
}else{
    $statutGrille = "";
    $dureePeriodeEssai = 0;
}

$remuneration = number_format($emploi->getCoefficient() * $indice->getValeur(), 2, ',', ' ');
$nbHeuresTravaillees = number_format($nbHeuresTravaillees, 2, ',', ' ');

//Formatage des différentes dates pour la lettre d'embauche (date courante, date prescrite, date début d'embauche)
$dateCouranteAnglaise = new DateTime();
$dateCouranteFr = $dateCouranteAnglaise->format('d/m/Y');

if (!empty($_POST['date_prescrite'])) {
    $datePrescrite = explode('-', $_POST['date_prescrite']);
    $datePrescriteFr = $datePrescrite[2] . "/" . $datePrescrite[1] . "/" . $datePrescrite[0];
} else {
    $datePrescriteAnglaise = $dateCouranteAnglaise->modify('+8 day');
    $datePrescriteFr = $datePrescriteAnglaise->format('d/m/Y');
}

$dateDebutContrat = transformerDateFormatFr($dateDebutContrat);
$dateNaissance = transformerDateFormatFr($dateNaissance);
$dateFinPeriodeEssai = transformerDateFormatFr($dateFinPeriodeEssai);


///////////////////////////////////////
//Tableau de toutes les variables clés
///////////////////////////////////////

$variables = array(
    //Etat Civil
    "@PREFIXE_GENRE@" => $prefixe_genre,
    "@GENRE@" => $genre,
    "@PRENOM@" => $prenom,
    "@NOM@" => $nom,
    "@NOM_JEUNE_FILLE@" => $nomJeuneFille,
    "@SITUATION_FAMILIALE@" => $intituleSituationFamiliale,
    "@NOMBRE_ENFANTS@" => $nombreEnfants,

    //Immatriculation
    "@DATE_NAISSANCE@" => $dateNaissance,
    "@DEPARTEMENT_NAISSANCE@" => $intituleDepartementNaissance,
    "@PAYS_NAISSANCE@" => $paysNaissance,
    "@COMMUNE_NAISSANCE@" => $communeNaissance,
    "@CODE_COMMUNE_NAISSANCE@" => $codeCommuneNaissance,
    "@NATIONALITE@" => $nationalite,
    "@NUMERO_IMMATRICULATION@" => $numeroImmatriculation,
    "@EMAIL@" => $email,

    //Coordonnées
    "@ADRESSE@" => $adresse,
    "@COMPLEMENT_ADRESSE@" => $complementAdresse,
    "@CODE_POSTAL@" => $codePostal,
    "@COMMUNE@" => $commune,
    "@CODE_PAYS@" => $codePays,
    "@IBAN@" => $iban,
    "@BIC@" => $bic,

    //Contrat
    "@NATURE_CONTRAT@" => $intituleContrat,
    "@DATE_DE_DEBUT@" => $dateDebutContrat,
    "@DATE_FIN_PERIODE_ESSAI@" => $dateFinPeriodeEssai,
    "@TYPE_ENTREE_CONTRAT@" => $intituleTypeEntreeContrat,
    "@ETABLISSEMENT@" => $intituleEtablissement,

    //Poste
    "@DEPARTEMENT_POSTE@" => $intituleDepartementPoste,
    "@CATEGORIE_POSTE@" => $intituleCategoriePoste,

    //Emploi
    "@EMPLOI_CCN@" => $intituleEmploiCCN,
    "@MISSIONS@" => $missions,
    "@STATUT@" => $statutGrille,
    "@COEFFICIENT@" => $coefficient,

    //Statut
    "@CONVENTION@" => $intituleConvention,
    "@AGIRC@" => $estAgirc,

    //Salaire
    "@BULLETIN_MODELE@" => $intituleBulletinModeleSalaire,

    //Horaire
    "@NOMBRE_HEURES_TRAVAILLEES@" => $nbHeuresTravaillees,
    "@MODALITE_EXERCICE_TRAVAIL@" => $intituleModaliteExerciceTravail,

    //Personnes à prévenir
    "@NOM_PERS_PREVENIR_1@" => $nomPremierePersonne,
    "@NOM_PERS_PREVENIR_2@" => $nomDeuxiemePersonne,
    "@TEL_PERS_PREVENIR_1@" => $telPremierePersonne,
    "@TEL_PERS_PREVENIR_2@" => $telDeuxiemePersonne,

    //Autres
    "@INDICE_SALAIRE@" => $valeurIndiceSalaire,
    "@DATE_COURANTE@" => $dateCouranteFr,
    "@REMUNERATION@" => $remuneration,
    "@DATE_PRESCRITE@" => $datePrescriteFr,
    "@DUREE_PERIODE_ESSAI@" => $dureePeriodeEssai,
    "@Il_Elle@" => $IlElle,
    "@il_elle@" => $ilelle

);
?>
