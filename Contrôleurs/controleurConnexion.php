<?php
$choix = $_GET["choix"];
session_start();

switch($choix){
    case "accès":
        $login = $_POST["mail"];
        $mdp = $_POST["password"];
        $rep=Connexion::verifier($login, $mdp);

        if($rep == true){
            $resultat=gestionSeance::listeSeance();
            $resultAdmin=gestionAdmin::afficherAdmin($login, $mdp);
            ?>

            <script type="text/javascript">
                const jourSemaine = ["Dimanche","Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi"];
                const j = new Date();
                var jour = jourSemaine[j.getDay()];
            </script>

            <?php
            $jour = "<script>document.writeln(jour)</script>";

            $_SESSION["nomAdmin"] = $resultAdmin;
            $resultatActu=gestionSeance::seancesActuelles($jour);
            $resultatPro=gestionSeance::seancesProchaines($jour);
            include "Vues/accueil.php";
            $_SESSION["newsession"] = "connectee";
            
        }

        else{
            $_SESSION["newsession"] = "erreur";
            include "Vues/connexion.php";
        }
        break;

    case "deconnexion":
        $_SESSION["newsession"] = "deconnecter";
        include "Vues/connexion.php";
        break;
}