<?php

class gestionEleve{
    private $IDELEVE;
    private $BOURSE;

    private $ID;
    private $NOM;
    private $PRENOM;
    private $TEL;
    private $MAIL;
    private $ADRESSE;

    public function getIDELEVE(){
        return $this->IDELEVE;
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

    public function getBOURSE(){
        return $this->BOURSE;
    }

    public static function listeEleve(){
        $req = monPdo::getInstance()->prepare("SELECT * FROM eleve
                                                INNER JOIN personne
                                                ON eleve.IDELEVE = personne.ID
                                                ORDER BY NOM");
        $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'gestionEleve');
        $req->execute();
        $resultatE=$req->fetchAll();
        return $resultatE;
    }

    public static function suppEleve($idEleve){
        $req = monPdo::getInstance()->prepare("DELETE FROM `eleve`
                                                WHERE IDELEVE = :idEleve");
        $req->bindParam('idEleve', $idEleve);
        $req->execute();
    }

    public static function addEleve($idEleve, $bourse){
        $req = monPdo::getInstance()->prepare("INSERT INTO eleve (IDELEVE, BOURSE)
                                                VALUES (:idEleve, :bourse)");
        $req->bindParam('idEleve', $idEleve);
        $req->bindParam('bourse', $bourse);
        $req->execute();
    }

    public static function affichageEleve($idEleve){
        $req = monPdo::getInstance()->prepare("SELECT * FROM eleve
                                                INNER JOIN personne
                                                ON eleve.IDELEVE = personne.ID
                                                WHERE IDELEVE = :idEleve");
        $req->bindParam('idEleve', $idEleve);
        $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'gestionEleve');
        $req->execute();
        $resultatE=$req->fetchAll();
        return $resultatE;
    }

    public static function modifEleve($idEleve, $bourse){
        $req = monPdo::getInstance()->prepare("UPDATE eleve SET BOURSE = :bourse
                                                WHERE IDELEVE = :idEleve");
        $req->bindParam('bourse', $bourse);
        $req->bindParam('idEleve', $idEleve);
        $req->execute();
    }
}

?>