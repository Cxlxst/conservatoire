    <?php 
    include "Vues/headerSeances.php";
    if($resultat == true){
        echo "Eleve supp";
    }
    else{
        echo "Supp impossible";
    }
    // var_dump($resultat);
    ?>

    <div class="container">
        <img class="MPT" src="Vues/img/MPT.svg" alt="cc">
        <div class="title">
            Les séances programmées
        </div>

        <form action="index.php?uc=formInscription&choix=formAddSeance" method="POST">
            <button class="buttonTitle" type="submit">Ajouter une séance</button>
        </form>

        <form action="index.php?uc=pageConsulter&choix=affichageParJour" method="POST">
            <div class="containerJours">
                <button class="buttonTitle2" id="Tout" value="Tout" name="buttonJourSelected" type="submit">Tout</button>
                <button class="buttonTitle2" id="Lundi" value="Lundi" name="buttonJourSelected" type="submit">Lundi</button>
                <button class="buttonTitle2" id="Mardi" value="Mardi" name="buttonJourSelected" type="submit">Mardi</button>
                <button class="buttonTitle2" id="Mercredi" value="Mercredi" name="buttonJourSelected" type="submit">Mercredi</button>
                <button class="buttonTitle2" id="Jeudi" value="Jeudi" name="buttonJourSelected" type="submit">Jeudi</button>
                <button class="buttonTitle2" id="Vendredi" value="Vendredi" name="buttonJourSelected" type="submit">Vendredi</button>
                <button class="buttonTitle2" id="Samedi" value="Samedi" name="buttonJourSelected" type="submit">Samedi</button>
                <button class="buttonTitle2" id="Dimanche" value="Dimanche" name="buttonJourSelected" type="submit">Dimanche</button>
            </div>
        </form>
    </div>

    <div class="containerCard">
        <?php foreach($resultat as $laSeance){ ?>
        <div class="card">
            <div class="cardComplement">
                <div class="titleCard"><b><?php echo $laSeance->getINSTRUMENT() . ", " ?> </b> <?php echo $laSeance->getTRANCHE() ?></div>
                <div><?php echo $laSeance->getNOM() . " " . $laSeance->getPRENOM()?> </div>
            </div>

            <div class="containerBox">
                <div class="box">
                    <div>Niveau</div>
                    <div><b> <?php echo $laSeance->getNIVEAU() ?>/4 </b></div>  
                </div>

                <div class="box">
                    <div>Capacité</div>
                    <div><b> <?php echo $laSeance->getNB_PARTICIPANTS() . "/" . $laSeance->getCAPACITE() ?> </b></div>
                </div>
            </div>

            <div class="cardComplementModif">
                <form action="index.php?uc=pageConsulter&choix=afficher" method="POST">
                    <input type="text" name="idSeance" value="<?php echo $laSeance->getNUMSEANCE()?>" hidden> </input>
                    <button class="buttonCard" type="submit">Consulter le cours</button>
                </form>

                <form action="index.php?uc=formInscription&choix=formModifSeance" method="POST">
                    <input type="text" name="idSeance" value="<?php echo $laSeance->getNUMSEANCE()?>" hidden> </input>
                    <input type="text" name="idProf" value="<?php echo $laSeance->getIDPROF()?>" hidden> </input>
                    <input type="text" name="jour" value="<?php echo $laSeance->getJOUR()?>" hidden> </input>
                    <input type="text" name="tranche" value="<?php echo $laSeance->getTRANCHE()?>" hidden> </input>
                    <input type="text" name="niveau" value="<?php echo $laSeance->getNIVEAU()?>" hidden> </input>
                    <input type="text" name="capacite" value="<?php echo $laSeance->getCAPACITE()?>" hidden> </input>
                    <button type="submit" class="buttonModif"><img class="modif" src="Vues/img/modif.svg" alt=""></button>                
                </form>

                <form action="index.php?uc=formInscription&choix=suppSeance" method="POST">
                    <input type="text" name="idSeance" value="<?php echo $laSeance->getNUMSEANCE()?>" hidden> </input>
                    <button class="buttonCard" type="submit"><img class="modif" src="Vues/img/modifHover.svg" alt=""></button>
                </form>
            </div>
        </div>
        <?php } ?>
    </div>

    <?php
    include "Vues/footer.php";
    ?>
    </body>