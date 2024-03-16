    <?php
        include "Vues/headerSeances.php";
    ?>

    <div class="container">
        <img class="MPT" src="Vues/img/MPT.svg" alt="">
    </div>

    <div class="container2">
        <a href="index.php?uc=pageSeance&choix=seance">
            <img src="Vues/img/arrow.svg" alt="">
        </a>
        
        <div>
            <?php foreach($resultat as $laSeance){ ?>
            <div class="card4">
                <div class="cardComplement">
                    <div class="titleCard"><b><?php echo $laSeance->getINSTRUMENT() . ", " ?> </b> <?php echo $laSeance->getTRANCHE() ?></div>
                    <div><?php echo $laSeance->getNOM() . " " . $laSeance->getPRENOM()?> </div>
                </div>

                <div class="containerBox">
                    <div class="box2">
                        <div>Niveau</div>
                        <div><b> <?php echo $laSeance->getNIVEAU() ?>/4 </b></div>  
                    </div>

                    <div class="box2">
                        <div>Capacité</div>
                        <div><b> <?php echo $laSeance->getNB_PARTICIPANTS() . "/" . $laSeance->getCAPACITE() ?> </b></div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="container3">
        <div class="title2">
            Élèves inscrits à cette séance
        </div>

        <form action="index.php?uc=formInscription&choix=formEleveSeance" method="POST">
            <input type="text" name="numSeance" value="<?php echo $laSeance->getNUMSEANCE() ?>" hidden> </input>
            <input type="text" name="idProf" value="<?php echo $laSeance->getIDPROF() ?>" hidden> </input>
            <button class="buttonTitle2" type="submit">Ajouter un élève</button>
        </form>
    </div>
    <?php } ?>

    <div class="containerCard">
        <?php foreach($resultatE as $unEleve){ ?>
            <div class="card3">
                <div class="cardComplement">
                    <!-- <img src="" alt=""> -->
                    <div class="titleCard"><b> <?php echo $unEleve->getNOM() . " " . $unEleve->getPRENOM()?> </b></div>
                </div>

                <div>
                    <div class="boxInfos">
                        <b>E-mail</b></br>
                        <?php echo $unEleve->getMAIL() ?></br></br>

                        <b>Numéro</b></br>
                        <?php echo $unEleve->getTEL()?></br></br>
                        
                        <b>Adresse</b></br>
                        <?php echo $unEleve->getADRESSE() ?>
                    </div>
                </div>

                <div class="cardComplement">
                    
                    <form action="index.php?uc=formInscription&choix=formSupressionEleveSeance" method="POST">
                        <!-- add une confirmation -->
                        <input type="text" name="idEleve" value="<?php echo $unEleve->getID() ?>" hidden> </input>
                        <input type="text" name="numSeance" value="<?php echo $unEleve->getNUMSEANCE() ?>" hidden> </input>
                        <button class="buttonCard" type="submit">Supprimer cet élève</button>
                    </form>
                </div>
            </div>
        <?php } ?>
    </div>

    <!-- for each élèves indisponibles -->

    <?php
        include "Vues/footer.php";
    ?>