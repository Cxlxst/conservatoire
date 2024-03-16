<?php

class gestionProf{
    private $IDPROF;
    private $INSTRUMENT;
    private $SALAIRE;

    private $ID;
    private $NOM;
    private $PRENOM;
    private $TEL;
    private $MAIL;
    private $ADRESSE;

    public function getIDPROF(){
        return $this->IDPROF;
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

    public function getSALAIRE(){
        return $this->SALAIRE;
    }

    public static function listeProfesseur(){
        $req = monPdo::getInstance()->prepare("SELECT * FROM prof
                                                INNER JOIN personne
                                                ON prof.IDPROF = personne.ID
                                                ORDER BY NOM");
        $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'gestionProf');
        $req->execute();
        $resultatProf=$req->fetchAll();
        return $resultatProf;
    }

    public static function suppProf($idProf){
        $req = monPdo::getInstance()->prepare("DELETE FROM `prof`
                                                WHERE IDPROF = :idProf");
        $req->bindParam('idProf', $idProf);
        $req->execute();
    }

    public static function addProf($idPersonne, $instrument, $salaire){
      
        $req = monPdo::getInstance()->prepare("INSERT INTO prof (IDPROF, INSTRUMENT, SALAIRE)
                                                VALUES (:idPersonne, :instrument, :salaire)");
        $req->bindParam('idPersonne', $idPersonne);
        $req->bindParam('instrument', $instrument);
        $req->bindParam('salaire', $salaire);
        $req->execute();
    }

    public static function infoProf($idProf){
        $req = monPdo::getInstance()->prepare("SELECT * FROM prof
                                                INNER JOIN personne
                                                ON prof.IDPROF = personne.ID
                                                WHERE prof.IDPROF = :idProf");
        $req->bindParam('idProf', $idProf);
        $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'gestionProf');
        $req->execute();
        $resultatProf=$req->fetchAll();
        return $resultatProf;
    }

    public static function affichageProf($idProf){
        $req = monPdo::getInstance()->prepare("SELECT * FROM prof
                                                INNER JOIN personne
                                                ON prof.IDPROF = personne.ID
                                                WHERE IDPROF = :idProf");
        $req->bindParam('idProf', $idProf);
        $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'gestionProf');
        $req->execute();
        $resultatE=$req->fetchAll();
        return $resultatE;
    }

    public static function modifProf($idProf, $salaire){
        $req = monPdo::getInstance()->prepare("UPDATE prof SET SALAIRE = :salaire
                                                WHERE IDPROF = :idProf");
        $req->bindParam('salaire', $salaire);
        $req->bindParam('idProf', $idProf);
        $req->execute();
    }
}