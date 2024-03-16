<?php
class Connexion{

    public static function verifier($login, $mdp){
        $req= MonPdo::getInstance()->prepare("SELECT * FROM administrateur WHERE MAIL = :login AND MDP= :mdp");
        $req->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'Connexion');
        $req->bindParam('login', $login);
        $req->bindParam('mdp', $mdp);
        $req->execute();
        $result = $req->fetchAll();
        $nbLignes= count($result);

        if($nbLignes==0){
            $rep=false;
        }
        else{
            $rep=true;
        }
        return $rep;
    }
}