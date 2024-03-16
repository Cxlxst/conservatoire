<?php
session_start();

$choix = $_GET["choix"];

switch($choix){
    case"index":
        ?>
        <script type="text/javascript">
                const jourSemaine = ["Dimanche","Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi"];
                const j = new Date();
                var jour = jourSemaine[j.getDay()];
        </script>
        <?php
        $jour = "Lundi";
        $resultatActu=gestionSeance::seancesActuelles($jour);
        $resultatPro=gestionSeance::seancesProchaines($jour);
        include "Vues/accueil.php";
        break;

    case "eleve":
        $resultatE=gestionEleve::listeEleve();
        include "Vues/eleve.php";
        break;

    case "seance":
        $resultat=gestionSeance::listeSeance();
        include "Vues/seances.php";
        echo"<script type='text/javascript'>affichageJourDefault();</script>";

        break;

    case"professeur":
        $resultatProf=gestionProf::listeProfesseur();
        include "Vues/prof.php";
        break;
}