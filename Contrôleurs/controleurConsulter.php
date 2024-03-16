<?php
session_start();

$choix = $_GET["choix"];

switch($choix){
    case "afficher":
        $idSeance = $_POST['idSeance'];
        $resultat=gestionSeance::consulterSeance($idSeance);
        $resultatE=gestionSeance::listeEleveSeance($idSeance);
        include "Vues/consulterCours.php";
        break;

    case "affichageParJour":
        $jour = $_POST['buttonJourSelected'];
        if($jour == "Tout"){
            $resultat=gestionSeance::listeSeance();
        }
        else{
            $resultat=gestionSeance::listeSeanceParJour($jour);
        }
        include "Vues/seances.php";
        

        echo"<script type='text/javascript'>affichageJour($jour);</script>";
        break;
}