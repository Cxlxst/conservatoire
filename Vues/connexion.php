    <?php
        include "headerConnexion.php";
    ?>

    <div class="containerConnexion">
        <img class="MPT" src="Vues/img/MPT.svg" alt="">
        <div class="title">
            Connexion
        </div>
        
        <?php
        if(empty($_SESSION["newsession"])){

        }
         else if($_SESSION["newsession"] == "deconnecter"){?>
            <div class="validation">Déconnexion réussie</div>
            <?php unset($_SESSION["newsession"]);
        }
        else if($_SESSION["newsession"] == "erreur"){?>
            <div class="erreur">E-mail ou mot de passe erroné</div>
            <?php unset($_SESSION["newsession"]);
        }?></br></br>
        
        <form action="index.php?uc=connexion&choix=accès" method="POST">
            <div class="containerFormConnexion">
                <input class="inputSeance" type="email" placeholder="E-mail" name="mail"> </input></br>
                <input class="inputSeance" type="password" placeholder="Mot de passe" name="password"> </input></br>
                <button class="buttonTitle2" type="submit">Valider</button>
            </div>
        </form>
        
    </div>