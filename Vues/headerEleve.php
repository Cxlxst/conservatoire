<?php 
if (session_status()!= 2){
    session_start(); 
}?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Conservatoire · Musique pour tous</title>
        <link href="Vues/accueil.css" rel="stylesheet" type="text/css" media="all"> 
    </head>

    <body>
        <div class="navBar">
            <div class="linkNavBar">
                <a href="index.php?uc=accueil&choix=index" class="link">Accueil</a>
                <a href="index.php?uc=pageSeance&choix=seance" class="link">Séances</a>
                <a href="index.php?uc=pageProf&choix=professeur" class="link">Professeurs</a>
                <a href="index.php?uc=pageEleve&choix=eleve" class="linkSelected">Élèves</a>
            </div>
            
            <form action="index.php?uc=connexion&choix=deconnexion" method="POST">
                <button class="buttonDeconnexion" type="submit"> Déconnexion </button>
            </form>
        </div>