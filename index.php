<?php
include "Modèles/monPdo.php";
include "Modèles/connexionClass.php";
include "Modèles/gestionAdmin.class.php";
include "Modèles/gestionEleve.class.php";
include "Modèles/gestionHoraire.class.php";
include "Modèles/gestionInstrument.class.php";
include "Modèles/gestionPersonne.class.php";
include "Modèles/gestionProf.class.php";
include "Modèles/gestionSeance.class.php";


if(empty($_GET["uc"])){
    $uc="pageConnexion";
}
else{
    $uc=$_GET["uc"];
}

switch($uc){
    case "accueil":
        include "Contrôleurs/controleurGestion.php";
        break;

    case "connexion":
        include "Contrôleurs/controleurConnexion.php";
        break;
    
    case "pageConnexion":
        include "Vues/connexion.php";
        break;

    case "pageConsulter":
        include "Contrôleurs/controleurConsulter.php";
        break;

    case "pageEleve";
        include "Contrôleurs/controleurGestion.php";
        break;

    case "pageProf":
        include "Contrôleurs/controleurGestion.php";
        break;

    case "pageSeance":
        include "Contrôleurs/controleurGestion.php";
        break;

    case"formInscription";
        include "Contrôleurs/controleurForm.php";
        break;
}