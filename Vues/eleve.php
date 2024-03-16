    <?php
        include "Vues/headerEleve.php";
        //var_dump($resultatE);
    ?>

    <div class="container">
        <img class="MPT" src="Vues/img/MPT.svg" alt="">
        <div class="title">
            Liste des élèves
        </div>

        <div class="containerJours">
            <form action="index.php?uc=formInscription&choix=formEleve" method="POST">
                <button class="buttonTitle" type="submit">Ajouter un élève</button>
            </form>
        </div>
    </div>

    <div class="containerCard">
    <?php foreach($resultatE as $unEleve){ ?>
    <div class="card2Eleve">
        <div class="cardComplement">
            <div class="titleCard"><b> <?php echo $unEleve->getNOM() . " " . $unEleve->getPRENOM()?> </b></div>
            
            <?php if($unEleve->getBOURSE() == NULL){ ?>
                <div> Non boursier.e</div>  
            <?php }
            else{ ?>
                <div> Boursier.e à hauteur de <?php echo $unEleve->getBOURSE() . " €" ?> </div>
            <?php } ?>
        </div>

        <div>
            <div class="boxInfos">
                <b>E-mail</b></br>
                <?php echo $unEleve->getMAIL() ?></br></br>

                <b>Numéro</b></br>
                <?php echo $unEleve->getTEL()?></br></br>
                
                <b>Adresse</b></br>
                <?php echo $unEleve->getADRESSE() ?></br></br>
            </div>
        </div>

        <div class="cardComplementModif">
            <form action="index.php?uc=formInscription&choix=formSupressionEleve" method="POST">
                <!-- add une confirmation -->
                <input type="text" name="idEleve" value="<?php echo $unEleve->getIDELEVE()?>" hidden> </input>
                <button class="buttonCard" type="submit">Supprimer cet élève</button>
            </form>
       
            <form action="index.php?uc=formInscription&choix=formModifEleve" method="POST">
                <input type="text" name="idEleve" value="<?php echo $unEleve->getIDELEVE()?>" hidden> </input>
                <button type="submit" class="buttonModif"><img class="modif" src="Vues/img/modif.svg" alt=""></button>                
            </form>
        </div>


    </div>
    <?php } ?>
</div>

<?php
include "Vues/footer.php";
?>