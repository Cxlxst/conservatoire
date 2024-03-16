<?php
    include "Vues/headerEleve.php";
        // var_dump($resultatProf);
    ?>

    <div class="container">
        <img class="MPT" src="Vues/img/MPT.svg" alt="">
    </div>

    <div class="container">
        <div class="title">
            Modifier un élève
        </div>
    </div>

    <div class="containerCard">
        <div class="card3">
            <form action="index.php?uc=formInscription&choix=formModifEleveConfirm" method="POST">
                <?php foreach($resultatE as $unEleve) {?>
                <div class="cardComplement">
                    <label><b> Nom </b></label></br>
                    <input class="inputSeance" name="nomEleve" value=<?php echo $unEleve->getNOM() ?>> </input></br></br>

                    <label><b> Prénom </b></label></br>
                    <input class="inputSeance" name="prenomEleve" value="<?php echo $unEleve->getPRENOM() ?>"> </input></br></br>

                    <label><b> Téléphone </b></label></br>
                    <input class="inputSeance" name="telEleve" value="<?php echo $unEleve->getTEL() ?>"> </input></br></br>
                
                    <label><b> Mail </b></label></br>
                    <input class="inputSeance" name="mailEleve" value="<?php echo $unEleve->getMAIL() ?>"> </input></br></br>

                    <label><b> Adresse </b></label></br>
                    <input class="inputSeance" name="adresseEleve" value="<?php echo $unEleve->getADRESSE() ?>"> </input></br></br>

                    <label><b> Bourse </b></label></br>
                    <?php if($unEleve->getBOURSE() != null){ ?>
                        <input class="inputSeance" name="bourseEleve" value="<?php echo $unEleve->getBOURSE() ?>"> </input></br></br>
                    <?php }
                    else{?>
                        <input class="inputSeance" name="bourseEleve" value="0"> </input></br></br>
                    <?php } ?>
                    
                    
                    <input name="idEleve" value="<?php echo $unEleve->getIDELEVE() ?>" hidden></input>
                    <button class="buttonCard" type="submit">Valider</button>
                </div>
                <?php } ?>
            </form>
        </div>
    </div>