    <?php
        include "Vues/headerProf.php";
        //var_dump($resultatProf);
    ?>

    <div class="container">
        <img class="MPT" src="Vues/img/MPT.svg" alt="">
        <div class="title">
            Liste des professeurs
        </div>

        <div class="containerJours">
            <form action="index.php?uc=formInscription&choix=formProf" method="POST">
                <button class="buttonTitle" type="submit">Ajouter un professeur</button>
            </form>
        </div>
    </div>

    <div class="containerCard">
        <?php foreach($resultatProf as $leProf){ ?>
        <div class="card2">
            <div class="cardComplement">
                <!-- <img src="" alt=""> -->
                <div class="titleCard"><b> <?php echo $leProf->getNOM() . " " . $leProf->getPRENOM()?> </b></div>
                <div> <?php echo $leProf->getINSTRUMENT() ?> </div>
            </div>

            <div>
                <div class="boxInfos">
                    <b>E-mail</b></br>
                    <?php echo $leProf->getMAIL() ?></br></br>

                    <b>Numéro</b></br>
                    <?php echo $leProf->getTEL()?></br></br>
                    
                    <b>Adresse</b></br>
                    <?php echo $leProf->getADRESSE() ?></br></br>

                    <b>Salaire</b></br>
                    <?php echo $leProf->getSALAIRE() . " €" ?>
                </div>
            </div>

            <div class="cardComplementModif">
                <form action="index.php?uc=formInscription&choix=formSupressionProf" method="POST">
                    <!-- add une confirmation -->
                    <input type="text" name="idProf" value="<?php echo $leProf->getIDPROF()?>" hidden> </input>
                    <button class="buttonCard" type="submit">Supprimer ce professeur</button>
                </form>

                <form action="index.php?uc=formInscription&choix=formModifProf" method="POST">
                    <input type="text" name="idProf" value="<?php echo $leProf->getIDPROF()?>" hidden> </input>
                    <button type="submit" class="buttonModif"><img class="modif" src="Vues/img/modif.svg" alt=""></button>                
                </form>
            </div>
        </div>
        <?php } ?>
    </div>

    <?php
    include "Vues/footer.php";
    ?>