    <?php
    include "Vues/headerSeances.php";
        // var_dump($resultatED);
    ?>

    <div class="container">
        
        
        <img class="MPT" src="Vues/img/MPT.svg" alt="">

       
    </div>

    <div class="container2">
       
        <div class="title2">
            Liste des élèves enregistrés
        </div>
    </div>

    <div class="containerCard">
        <?php foreach($resultatED as $unEleve){ ?>
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
                <form action="index.php?uc=formInscription&choix=formAddEleveSeance" method="POST">
                    
                    <div class="buttonFlex">
                        <input type="text" name="idPersonneEleve" value="<?php echo $unEleve->getID()?>" hidden> </input>
                        <input type="text" name="numSeance" value="<?php echo $numSeance?>" hidden> </input>
                        <input type="text" name="idProf" value="<?php echo $idProf ?>" hidden> </input>
                        <button class="buttonCard" type="submit">Ajouter</button>
                    </div>
                </form>
            </div>
        </div>
        <?php } ?>
    </div>

    <div class="title2">
        Liste des élèves non disponibles
    </div>

    <div class="containerCard">
        <?php foreach($resultatEX as $unEleve){ ?>
        <div class="card3NonDispo">
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
        </div>
        <?php } ?>
    </div>

    <?php
    include "Vues/footer.php";
    ?>