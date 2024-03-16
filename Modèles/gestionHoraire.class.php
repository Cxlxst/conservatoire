<?php

class gestionHoraire{
    private $TRANCHE;

    public function getTRANCHE(){
        return $this->TRANCHE;
    }

    public static function listeHoraire(){
        $req = monPdo::getInstance()->prepare("SELECT * FROM heure
                                                ORDER BY TRANCHE");
        $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'gestionHoraire');
        $req->execute();
        $resultatH=$req->fetchAll();
        return $resultatH;
    }
}