<?php
    include "Vues/headerProf.php";
        // var_dump($resultatProf);
    ?>

    <div class="container">
        <img class="MPT" src="Vues/img/MPT.svg" alt="">
    </div>

    <div class="container">
        <div class="title">
            Modifier un professeur
        </div>
    </div>

    <div class="containerCard">
        <div class="card3">
            <form action="index.php?uc=formInscription&choix=formModifProfConfirm" method="POST">
                <?php foreach($resultatProf as $unProf) {?>
                <div class="cardComplement">
                    <label><b> Nom </b></label></br>
                    <input class="inputSeance" name="nomProf" value=<?php echo $unProf->getNOM() ?>> </input></br></br>

                    <label><b> Prénom </b></label></br>
                    <input class="inputSeance" name="prenomProf" value="<?php echo $unProf->getPRENOM() ?>"> </input></br></br>

                    <label><b> Téléphone </b></label></br>
                    <input class="inputSeance" name="telProf" value="<?php echo $unProf->getTEL() ?>"> </input></br></br>
                
                    <label><b> Mail </b></label></br>
                    <input class="inputSeance" name="mailProf" value="<?php echo $unProf->getMAIL() ?>"> </input></br></br>

                    <label><b> Adresse </b></label></br>
                    <input class="inputSeance" name="adresseProf" value="<?php echo $unProf->getADRESSE() ?>"> </input></br></br>

                    <label><b> Salaire </b></label></br>
                    <input class="inputSeance" name="salaireProf" value="<?php echo $unProf->getSALAIRE() ?>"> </input></br></br>
                    
                    
                    <input name="idProf" value="<?php echo $unProf->getIDPROF() ?>" hidden></input>
                    <button class="buttonCard" type="submit">Valider</button>
                </div>
                <?php } ?>
            </form>
        </div>
    </div>