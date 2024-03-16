<?php

class gestionAdmin{
    private $PRENOM;

    public function getPRENOM(){
        return $this->PRENOM;
    }

    public static function afficherAdmin($login, $mdp){
        $req= MonPdo::getInstance()->prepare("SELECT PRENOM FROM administrateur WHERE MAIL = :login AND MDP= :mdp");
        $req->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'gestionAdmin');
        $req->bindParam('login', $login);
        $req->bindParam('mdp', $mdp);
        $req->execute();
        $resultAdmin = $req->fetchAll();

        return $resultAdmin;
    }
}

?>