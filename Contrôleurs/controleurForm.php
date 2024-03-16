<?php
session_start();

$choix = $_GET["choix"];

switch($choix){
    case "formProf":
        $resultatP=gestionPersonne::listePersonneForm();
        $resultatI=gestionInstrument::listeInstrument();
        include "Vues/formProf.php";
        break;

    case "formSupressionProf":
        $idProf = $_POST['idProf'];
        gestionProf::suppProf($idProf);
        $resultatProf=gestionProf::listeProfesseur();
        include "Vues/prof.php";
        break;

    case "formAddProf":
        $idPersonne = $_POST['idPersonne'];
        $instrument = $_POST['instrumentAdd'];
        $salaire = $_POST['salaireAdd'];

        gestionProf::addProf($idPersonne, $instrument, $salaire);
        $resultatProf=gestionProf::listeProfesseur();
        include "Vues/prof.php";
        break;

    case "formEleve":
        $resultatP=gestionPersonne::listePersonneForm();
        include "Vues/formEleve.php";
        break;

    case "formSupressionEleve":
        $idEleve = $_POST['idEleve'];
        gestionEleve::suppEleve($idEleve);
        $resultatE=gestionEleve::listeEleve();
        include "Vues/eleve.php";
        break;

    case "formAddEleve":
        $idPersonne = $_POST['idPersonne'];
        $bourse = $_POST['bourseAdd'];

        gestionEleve::addEleve($idPersonne, $bourse);
        $resultatE=gestionEleve::listeEleve();
        include "Vues/eleve.php";
        break;


    case "formEleveSeance":
        $numSeance = $_POST['numSeance'];
        $idProf = $_POST['idProf'];
        
        $resultat=gestionSeance::consulterSeance($numSeance);
        foreach($resultat as $infoSeance){
            $jour = $infoSeance->getJOUR();
            
            $heureTraitement = explode("h", $infoSeance->getTRANCHE());
            $heureDebut = $heureTraitement[0];

            $heureTraitement2 = explode("-", $heureTraitement[1]);
            $heureFin = $heureTraitement2[1];

            $infoSeance->getTRANCHE();
        }
        $resultatEX=gestionSeance::listeEleveExcluSeance($heureDebut, $heureFin, $jour);
        $listIdEleve = array();
        foreach($resultatEX as $eleveExclu){
            array_push($listIdEleve, $eleveExclu->getID());
        }

        $resultatED=gestionSeance::listeEleveDispo($listIdEleve);

        $resultatE=gestionEleve::listeEleve();  
        include "Vues/formEleveSeance.php";
        break;

    case "formSupressionEleveSeance":
        $idEleve = $_POST['idEleve'];
        $numSeance = $_POST['numSeance'];
        gestionSeance::suppEleveSeance($idEleve, $numSeance);
        $resultat=gestionSeance::consulterSeance($numSeance);
        $resultatE=gestionEleve::listeEleve();
        include "Vues/consulterCours.php";
        break;

    case "formAddEleveSeance":
        $idEleve = $_POST['idPersonneEleve'];
        $idProf = $_POST['idProf'];
        $numSeance = $_POST['numSeance'];

        gestionSeance::addEleveSeance($idProf, $idEleve, $numSeance);
        include "Vues/consulterCours.php";
        break;

    case "formAddSeance":
        $resultatProf=gestionProf::listeProfesseur();
        include "Vues/formSeance.php";
        break;

    case "formAddSeance2":
        $jour = $_POST['jour'];
        $prof = $_POST['prof'];

        $horaireDispo="";

        $resultatProf=gestionProf::infoProf($prof);
        $resultatH=gestionHoraire::listeHoraire();

        foreach($resultatH as $laTranche){
            $heureTraitement = explode("h", $laTranche->getTRANCHE());
            $heureDebut = $heureTraitement[0];
            $heureTraitement2 = explode("-", $heureTraitement[1]);
            $heureFin = $heureTraitement2[1];
        
            $horaireTrueFalse=gestionSeance::getHeureDispo($jour, $prof, $heureDebut, $heureFin);
        
            if($horaireTrueFalse == true){
                $horaireDispo = $horaireDispo . "-/-" . $laTranche->getTRANCHE();
            }

        }
        $listeHoraire = explode("-/-", $horaireDispo);
        include "Vues/formSeance2.php";     
        break;

    case "formAddSeanceFinal":
        $jour = $_POST['jour'];
        $idProf = $_POST['idProf'];
        $horaire = $_POST ['horaire'];
        $niveau = $_POST ['niveau'];
        $capacite = $_POST['capacite'];
        gestionSeance::addSeance($idProf, $horaire, $jour, $niveau, $capacite);
        $resultatProf=gestionProf::listeProfesseur();
        include "Vues/seances.php";
        break;

    case "formModifEleve":
        $id = $_POST['idEleve'];
        $resultatE=gestionEleve::affichageEleve($id);
        include "Vues/formModifEleve.php";
        break;

    case "formModifEleveConfirm":
        $id = $_POST['idEleve'];
        $nom = $_POST['nomEleve'];
        $prenom = $_POST['prenomEleve'];
        $tel = $_POST['telEleve'];
        $mail = $_POST['mailEleve'];
        $adresse = $_POST['adresseEleve'];
        $bourse = $_POST['bourseEleve'];
        gestionEleve::modifEleve($id, $bourse);
        gestionPersonne::modifPersonne($id, $nom, $prenom, $tel, $mail, $adresse);
        $resultatE=gestionEleve::listeEleve();
        include "Vues/eleve.php";
        break;

        case "formModifProf":
            $id = $_POST['idProf'];
            $resultatProf=gestionProf::affichageProf($id);
            include "Vues/formModifProf.php";
            break;
    
        case "formModifProfConfirm":
            $id = $_POST['idProf'];
            $nom = $_POST['nomProf'];
            $prenom = $_POST['prenomProf'];
            $tel = $_POST['telProf'];
            $mail = $_POST['mailProf'];
            $adresse = $_POST['adresseProf'];
            $salaire = $_POST['salaireProf'];
            gestionProf::modifProf($id, $salaire);
            gestionPersonne::modifPersonne($id, $nom, $prenom, $tel, $mail, $adresse);
            $resultatProf=gestionProf::listeProfesseur();
            include "Vues/prof.php";
            break;

        case "formModifSeance":
            $id = $_POST['idSeance'];
            $idProf = $_POST['idProf'];
            $jour = $_POST['jour'];
            $tranche = $_POST['tranche'];
            $niveau = $_POST['niveau'];
            $capacite = $_POST['capacite'];
            include "Vues/formModifSeance.php";
            break;

        case "formModifSeance2":
            $id = $_POST['idSeance'];
            $jour = $_POST['jour'];
            $idProf = $_POST['idProf'];
            $tranche = $_POST['tranche'];
            $niveau = $_POST['niveau'];
            $capacite = $_POST['capacite'];
            
            $horaireDispo="";

            $resultatProf=gestionProf::infoProf($idProf);
            $resultatH=gestionHoraire::listeHoraire();

            foreach($resultatH as $laTranche){
                $heureTraitement = explode("h", $laTranche->getTRANCHE());
                $heureDebut = $heureTraitement[0];
                $heureTraitement2 = explode("-", $heureTraitement[1]);
                $heureFin = $heureTraitement2[1];
            
                $horaireTrueFalse=gestionSeance::getHeureDispo($jour, $idProf, $heureDebut, $heureFin);
            
                if($horaireTrueFalse == true){
                    $horaireDispo = $horaireDispo . "-/-" . $laTranche->getTRANCHE();
                }

            }
            $listeHoraire = explode("-/-", $horaireDispo);

            include "Vues/formModifSeance2.php";
            break;
    
        case "formModifSeanceConfirm":
            $id = $_POST['idSeance'];
            $jour = $_POST['jour'];
            $idProf = $_POST['idProf'];
            $tranche = $_POST['horaire'];
            $niveau = $_POST['niveau'];
            $capacite = $_POST['capacite'];

            gestionSeance::modifSeance($id, $jour, $tranche, $niveau, $capacite);
            $resultat=gestionSeance::listeSeance();
            include "Vues/seances.php";
            break;

        case "suppSeance":
            $idSeance = $_POST['idSeance'];


            $resultat=gestionSeance::verifSupp($idSeance);

            echo "result ".$resultat;
            if($resultat == true){
                gestionSeance::suppSeance($idSeance);
            }

            include "Vues/seances.php";
}