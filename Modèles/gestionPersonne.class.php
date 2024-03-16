<?php

class gestionPersonne{
    private $ID;
    private $NOM;
    private $PRENOM;
    private $TEL;
    private $MAIL;
    private $ADRESSE;

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

    // Permet de remplir les variables vides qui sont plus haut
    public static function listePersonne(){
        $req = monPdo::getInstance()->prepare("SELECT * FROM personne
                            ORDER BY ID");
        // bindValue
        $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'gestionPersonne');
        $req->execute();
        $resultatP=$req->fetchAll();
        return $resultatP;
    }

    public static function listePersonneForm(){
        $req = monPdo::getInstance()->prepare("SELECT * FROM personne
                                                WHERE ID NOT IN (SELECT IDPROF
                                                                FROM prof) AND
                                                                ID NOT IN (SELECT IDELEVE
                                                                            FROM eleve)
                                                                            ORDER BY NOM");
        $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'gestionPersonne');
        $req->execute();
        $resultatP=$req->fetchAll();
        return $resultatP;
    }

    public static function modifPersonne($id, $nom, $prenom, $tel, $mail, $adresse){
        $req = monPdo::getInstance()->prepare("UPDATE personne
                                                SET NOM = :nom, PRENOM = :prenom, TEL = :tel, MAIL = :mail, ADRESSE = :adresse
                                                WHERE ID = :id");
        $req->bindParam('nom', $nom);
        $req->bindParam('prenom', $prenom);
        $req->bindParam('tel', $tel);
        $req->bindParam('mail', $mail);
        $req->bindParam('adresse', $adresse);
        $req->bindParam('id', $id);
        $req->execute();
    }
}