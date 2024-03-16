<?php

class gestionInstrument{
    private $LIBELLE;

    public function getINSTRUMENT(){
        return $this->LIBELLE;
    }

    public static function listeInstrument(){
        $req = monPdo::getInstance()->prepare("SELECT * FROM instrument
                                                ORDER BY LIBELLE");
        $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'gestionInstrument');
        $req->execute();
        $resultatI=$req->fetchAll();
        return $resultatI;
    }
}