<?php

class gestionSeance{
    private $IDPROF;
    private $NUMSEANCE;
    private $TRANCHE;
    private $JOUR;
    private $NIVEAU;
    private $CAPACITE;
    private $ID;
    private $NOM;
    private $PRENOM;
    private $TEL;
    private $MAIL;
    private $ADRESSE;
    private $INSTRUMENT;
    private $NB_PARTICIPANTS;


    public function getIDPROF(){
        return $this->IDPROF;
    }

    public function getNUMSEANCE(){
        return $this->NUMSEANCE;
    }

    public function getTRANCHE(){
        return $this->TRANCHE;
    }

    public function getJOUR(){
        return $this->JOUR;
    }

    public function getNIVEAU(){
        return $this->NIVEAU;
    }

    public function getCAPACITE(){
        return $this->CAPACITE;
    }

    public function getID(){
        return $this->ID;
    }

    public function getNOM(){
        return $this->NOM;
    }

    public function getPRENOM(){
        return $this->PRENOM;
    }

    public function getTEL(){
        return $this->TEL;
    }

    public function getMAIL(){
        return $this->MAIL;
    }

    public function getADRESSE(){
        return $this->ADRESSE;
    }

    public function getINSTRUMENT(){
        return $this->INSTRUMENT;
    }

    public function getNB_PARTICIPANTS(){
        return $this->NB_PARTICIPANTS;
    }

    
    // Permet de remplir les variables vides qui sont plus haut
    public static function listeSeance(){
        $req = monPdo::getInstance()->prepare("SELECT S.IDPROF, S.NUMSEANCE, S.TRANCHE, S.JOUR, S.NIVEAU, S.CAPACITE, P.NOM, P.PRENOM, PR.INSTRUMENT, COUNT(I.NUMSEANCE) AS NB_PARTICIPANTS
                                                FROM seance S
                                                INNER JOIN personne P
                                                ON S.IDPROF=P.ID
                                                INNER JOIN prof PR
                                                ON S.IDPROF=PR.IDPROF
                                                LEFT JOIN inscription I
                                                ON S.NUMSEANCE=I.NUMSEANCE
                                                GROUP BY S.NUMSEANCE");
        // bindValue
        $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'gestionSeance');
        $req->execute();
        $resultat=$req->fetchAll();
        return $resultat;
    }

    public static function listeSeanceParJour($jour){
        $req = monPdo::getInstance()->prepare("SELECT S.IDPROF, S.NUMSEANCE, S.TRANCHE, S.JOUR, S.NIVEAU, S.CAPACITE, P.NOM, P.PRENOM, PR.INSTRUMENT, COUNT(I.NUMSEANCE) AS NB_PARTICIPANTS
                                                FROM seance S
                                                INNER JOIN personne P
                                                ON S.IDPROF=P.ID
                                                INNER JOIN prof PR
                                                ON S.IDPROF=PR.IDPROF
                                                LEFT JOIN inscription I
                                                ON S.NUMSEANCE=I.NUMSEANCE
                                                WHERE S.JOUR = :jour
                                                GROUP BY S.NUMSEANCE");
        $req->bindParam('jour', $jour);
        $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'gestionSeance');
        $req->execute();
        $resultat=$req->fetchAll();
        return $resultat;
    }

    public static function consulterSeance($idSeance){
        $req = monPdo::getInstance()->prepare("SELECT S.IDPROF, S.NUMSEANCE, S.TRANCHE, S.JOUR, S.NIVEAU, S.CAPACITE, P.NOM, P.PRENOM, PR.INSTRUMENT, COUNT(I.NUMSEANCE) AS NB_PARTICIPANTS
                                                FROM seance S
                                                INNER JOIN personne P
                                                ON S.IDPROF=P.ID
                                                INNER JOIN prof PR
                                                ON S.IDPROF=PR.IDPROF
                                                LEFT JOIN inscription I
                                                ON S.NUMSEANCE=I.NUMSEANCE
                                                WHERE S.NUMSEANCE = :idSeance
                                                GROUP BY S.NUMSEANCE");
        $req->bindParam('idSeance', $idSeance);
        $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'gestionSeance');
        $req->execute();
        $resultat=$req->fetchAll();
        return $resultat;
    }

    public static function addSeance($idProf, $horaire, $jour, $niveau, $capacite){
        $req = monPdo::getInstance()->prepare("INSERT INTO seance (IDPROF, TRANCHE, JOUR, NIVEAU, CAPACITE)
                                                VALUES (:idProf, :horaire, :jour, :niveau, :capacite)");
        $req->bindParam('idProf', $idProf);
        $req->bindParam('horaire', $horaire);
        $req->bindParam('jour', $jour);
        $req->bindParam('niveau', $niveau);
        $req->bindParam('capacite', $capacite);
        $req->execute();
    }

    public static function listeEleveSeance($idSeance){
        $req = monPdo::getInstance()->prepare("SELECT P.ID, P.NOM, P.PRENOM, P.TEL, P.MAIL, P.ADRESSE FROM inscription
                                                INNER JOIN eleve E
                                                ON E.IDELEVE = inscription.IDELEVE
                                                INNER JOIN personne P
                                                ON E.IDELEVE = P.ID                                                
                                                WHERE inscription.NUMSEANCE = :idSeance
                                                ORDER BY NOM");
        $req->bindParam('idSeance', $idSeance);
        $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'gestionSeance');
        $req->execute();
        $resultatE=$req->fetchAll();
        return $resultatE;
    }

    public static function listeEleveExcluSeance($heureDebut, $heureFin, $jour){
        $req = monPdo::getInstance()->prepare("SELECT *
                                                FROM inscription I
                                                INNER JOIN seance S
                                                ON I.NUMSEANCE = S.NUMSEANCE
                                                INNER JOIN personne P
                                                ON I.IDELEVE = P.ID
                                                WHERE S.JOUR = :jourselect
                                                    AND(
                                                        ((SELECT SUBSTRING_INDEX(S.TRANCHE, 'h', 1)) <= (SELECT CAST(:heureDebut AS INT))
                                                              AND (SELECT SUBSTRING_INDEX(SUBSTRING_INDEX(S.TRANCHE, 'h', 2), '-', -1)) <= (SELECT CAST(:heureFin AS INT))
                                                              AND (SELECT SUBSTRING_INDEX(SUBSTRING_INDEX(S.TRANCHE, 'h', 2), '-', -1)) > (SELECT CAST(:heureDebut AS INT)))
                                                                    
                                                        OR ((SELECT SUBSTRING_INDEX(S.TRANCHE, 'h', 1)) >= (SELECT CAST(:heureDebut AS INT))
                                                              AND (SELECT SUBSTRING_INDEX(SUBSTRING_INDEX(S.TRANCHE, 'h', 2), '-', -1)) >= (SELECT CAST(:heureFin AS INT)) 
                                                              AND (SELECT SUBSTRING_INDEX(S.TRANCHE, 'h', 1)) < (SELECT CAST(:heureFin AS INT)))
                                                                    
                                                        OR ((SELECT SUBSTRING_INDEX(S.TRANCHE, 'h', 1)) <=(SELECT CAST(:heureDebut AS INT))
                                                              AND (SELECT SUBSTRING_INDEX(SUBSTRING_INDEX(S.TRANCHE, 'h', 2), '-', -1)) >= (SELECT CAST(:heureFin AS INT)))
                                                        
                                                        OR ((SELECT SUBSTRING_INDEX(S.TRANCHE, 'h', 1)) >=(SELECT CAST(:heureDebut AS INT))
                                                          AND (SELECT SUBSTRING_INDEX(SUBSTRING_INDEX(S.TRANCHE, 'h', 2), '-', -1)) <= (SELECT CAST(:heureFin AS INT)))
                                                    )");
        $req->bindParam('heureDebut', $heureDebut);
        $req->bindParam('heureFin', $heureFin);
        $req->bindParam('jourselect', $jour);
        
        $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'gestionSeance');
        $req->execute();
        $resultatEX=$req->fetchAll();
        return $resultatEX;
    }

    public static function listeEleveDispo($listIdEleve){
        $req = monPdo::getInstance()->prepare("SELECT *
                                                FROM personne P
                                                INNER JOIN eleve E
                                                ON P.ID = E.IDELEVE
                                                WHERE E.IDELEVE
                                                NOT IN (" . implode(",", $listIdEleve ) . ")");
        
        $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'gestionSeance');
        $req->execute();
        $resultatED=$req->fetchAll();
        return $resultatED;
    }

    public static function suppEleveSeance($idEleve, $numSeance){
        $req = monPdo::getInstance()->prepare("DELETE FROM `inscription`
                                                WHERE NUMSEANCE = :numSeance
                                                AND IDELEVE = :idEleve");
        $req->bindParam('numSeance', $numSeance);
        $req->bindParam('idEleve', $idEleve);
        $req->execute();
    }

    // Insert d'un élève dans la table inscription
    public static function addEleveSeance($idProf, $idEleve, $numSeance){
      
        $req = monPdo::getInstance()->prepare("INSERT INTO `inscription` (IDPROF, IDELEVE, NUMSEANCE, DATEINSCRIPTION)
                                                VALUES (:idProf, :idEleve, :numSeance, now())");
        $req->bindParam('idProf', $idProf);
        $req->bindParam('idEleve', $idEleve);
        $req->bindParam('numSeance', $numSeance);
        $req->execute();
    }

    public static function seancesActuelles($jour){

        // echo "test : ". $jour;

        $req = monPdo::getInstance()->prepare("SELECT S.IDPROF, S.NUMSEANCE, S.TRANCHE, S.JOUR, S.CAPACITE, P.NOM, P.PRENOM, PR.INSTRUMENT, COUNT(I.NUMSEANCE) AS NB_PARTICIPANTS
                                                FROM seance S
                                                INNER JOIN personne P
                                                ON S.IDPROF=P.ID
                                                INNER JOIN prof PR
                                                ON S.IDPROF=PR.IDPROF
                                                LEFT JOIN inscription I
                                                ON S.NUMSEANCE=I.NUMSEANCE
                                                WHERE S.JOUR= :jour
                                                AND (
                                                    SELECT SUBSTRING_INDEX(S.TRANCHE, 'h', 1)<=9 
                                                    AND 9<(SELECT SUBSTRING_INDEX(SUBSTRING_INDEX(S.TRANCHE, 'h', 2), '-', -1)))
                                                GROUP BY S.NUMSEANCE");
    $req->bindParam('jour', $jour);     
    $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'gestionSeance');
    $req->execute();
    $resultatActu=$req->fetchAll();
    return $resultatActu;
    }

    public static function seancesProchaines($jour){
        $req = monPdo::getInstance()->prepare("SELECT S.IDPROF, S.NUMSEANCE, S.TRANCHE, S.JOUR, S.CAPACITE, P.NOM, P.PRENOM, PR.INSTRUMENT, COUNT(I.NUMSEANCE) AS NB_PARTICIPANTS
                                                FROM seance S
                                                INNER JOIN personne P
                                                ON S.IDPROF=P.ID
                                                INNER JOIN prof PR
                                                ON S.IDPROF=PR.IDPROF
                                                LEFT JOIN inscription I
                                                ON S.NUMSEANCE=I.NUMSEANCE
                                                WHERE S.JOUR= :jour
                                                AND (
                                                    SELECT SUBSTRING_INDEX(S.TRANCHE, 'h', 1)>9 
                                                    AND 9<=(SELECT SUBSTRING_INDEX(SUBSTRING_INDEX(S.TRANCHE, 'h', 2), '-', -1)))
                                                GROUP BY S.NUMSEANCE");
        $req->bindParam('jour', $jour);     
        $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'gestionSeance');
        $req->execute();
        $resultatPro=$req->fetchAll();
        return $resultatPro;
    }

    public static function getHeureDispo($jour, $prof, $heureDebut, $heureFin){
        $req = monPdo::getInstance()->prepare("SELECT *
                                                FROM seance S
                                                WHERE S.JOUR = :jour
                                                        AND S.IDPROF = :prof
                                                        AND(
                                                                ((SELECT SUBSTRING_INDEX(S.TRANCHE, 'h', 1)) <= (SELECT CAST(:heureDebut AS INT))
                                                                    AND (SELECT SUBSTRING_INDEX(SUBSTRING_INDEX(S.TRANCHE, 'h', 2), '-', -1)) <= (SELECT CAST(:heureFin AS INT))
                                                                    AND (SELECT SUBSTRING_INDEX(SUBSTRING_INDEX(S.TRANCHE, 'h', 2), '-', -1)) > (SELECT CAST(:heureDebut AS INT)))
                                                                                                                    
                                                                OR ((SELECT SUBSTRING_INDEX(S.TRANCHE, 'h', 1)) >= (SELECT CAST(:heureDebut AS INT))
                                                                    AND (SELECT SUBSTRING_INDEX(SUBSTRING_INDEX(S.TRANCHE, 'h', 2), '-', -1)) >= (SELECT CAST(:heureFin AS INT)) 
                                                                    AND (SELECT SUBSTRING_INDEX(S.TRANCHE, 'h', 1)) < (SELECT CAST(:heureFin AS INT)))
                                                                                                                    
                                                                OR ((SELECT SUBSTRING_INDEX(S.TRANCHE, 'h', 1)) <=(SELECT CAST(:heureDebut AS INT))
                                                                    AND (SELECT SUBSTRING_INDEX(SUBSTRING_INDEX(S.TRANCHE, 'h', 2), '-', -1)) >= (SELECT CAST(:heureFin AS INT)))
                                                                                                        
                                                                OR ((SELECT SUBSTRING_INDEX(S.TRANCHE, 'h', 1)) >=(SELECT CAST(:heureDebut AS INT))
                                                                    AND (SELECT SUBSTRING_INDEX(SUBSTRING_INDEX(S.TRANCHE, 'h', 2), '-', -1)) <= (SELECT CAST(:heureFin AS INT)))
                                                        )
                                                ");
        $req->bindParam('jour', $jour); 
        $req->bindParam('prof', $prof);
        $req->bindParam('heureDebut', $heureDebut);
        $req->bindParam('heureFin', $heureFin);

        $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'gestionSeance');
        $req->execute();
        $resultatTDispo=$req->fetchAll();

        if(count($resultatTDispo)==0){
            return true;
        }
        else{
            return false;
        }
    }

    public static function modifSeance($idSeance, $jour, $horaire, $niveau, $capacite){
        $req = monPdo::getInstance()->prepare("UPDATE seance SET TRANCHE= :horaire, JOUR= :jour, NIVEAU= :niveau, CAPACITE= :capacite
                                                WHERE NUMSEANCE = :idSeance");
        $req->bindParam('idSeance', $idSeance);
        $req->bindParam('horaire', $horaire);
        $req->bindParam('jour', $jour);
        $req->bindParam('niveau', $niveau);
        $req->bindParam('capacite', $capacite);
        $req->execute();
    }

    public static function verifSupp($idSeance){
        echo "id". $idSeance;
        $req = monPdo::getInstance()->prepare("SELECT * FROM inscription
                                                WHERE NUMSEANCE = :idSeance");
        $req->bindParam('idSeance', $idSeance);
        $req->execute();
        $nbInscriptions=$req->fetchAll();

        echo count($nbInscriptions);

        if(count($nbInscriptions)==0){
            return true;
        }
        else{
            return false;
        }
    }

    public static function suppSeance($idSeance){
        $req = monPdo::getInstance()->prepare("DELETE FROM seance
                                                WHERE NUMSEANCE = :idSeance");
        $req->bindParam('idSeance', $idSeance);
        $req->execute();
    }

    
}