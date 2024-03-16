<?php
    include "Vues/headerEleve.php";
        // var_dump($resultatE);
    ?>

    <div class="container">
        <img class="MPT" src="Vues/img/MPT.svg" alt="">
    </div>

    <div class="container2">
        <a href="index.php?uc=pageEleve&choix=eleve" >
            <img src="Vues/img/arrow.svg" alt="">
        </a>
        <div class="title2">
            Liste des personnes enregistrées
        </div>
    </div>

    <div class="containerCard">
        <?php foreach($resultatP as $laPersonne){ ?>
        <div class="card3">
            <div class="cardComplement">
                <!-- <img src="" alt=""> -->
                <div class="titleCard"><b> <?php echo $laPersonne->getNOM() . " " . $laPersonne->getPRENOM()?> </b></div>
            </div>

            <div>
                <div class="boxInfos">
                    <b>E-mail</b></br>
                    <?php echo $laPersonne->getMAIL() ?></br></br>

                    <b>Numéro</b></br>
                    <?php echo $laPersonne->getTEL()?></br></br>
                    
                    <b>Adresse</b></br>
                    <?php echo $laPersonne->getADRESSE() ?>
                </div>
            </div>

            <div class="cardComplement">
                <?php
                    $bourseAdd = "bourseAdd" . $laPersonne->getID();
                    $buttonConfirm = "buttonConfirm" . $laPersonne->getID();
                    $buttonAnnule = "buttonAnnule" . $laPersonne->getID();
                    $buttonJS = "buttonJS" . $laPersonne->getID();
                ?>
                <button onclick="addEleve('<?php echo $bourseAdd?>','<?php echo $buttonConfirm?>', '<?php echo $buttonAnnule?>', '<?php echo $buttonJS?>')" class="buttonCard" id="<?php echo "buttonJS" . $laPersonne->getID() ?>" type="submit">Ajouter</button>

                <form action="index.php?uc=formInscription&choix=formAddEleve" method="POST">
                    <input type="text" class="inputJS" name="bourseAdd" id="<?php echo "bourseAdd" . $laPersonne->getID() ?>" placeholder="Bourse (en euros)"> </input>
                    
                    <div class="buttonFlex">
                        <input type="text" name="idPersonne" value="<?php echo $laPersonne->getID()?>" hidden> </input>
                        <button class="buttonCardJS" id="<?php echo "buttonConfirm" . $laPersonne->getID() ?>" value="<?php echo $laPersonne->getID() ?>" type="submit">Confirmer</button>
                        <button onclick="closeEleve('<?php echo $bourseAdd?>','<?php echo $buttonConfirm?>', '<?php echo $buttonAnnule?>', '<?php echo $buttonJS?>')" class="buttonCardJS" id="<?php echo "buttonAnnule" . $laPersonne->getID() ?>" type="button">Annuler</button>
                    </div>
                </form>
            </div>
        </div>
        <?php } ?>
    </div>

    <?php
    include "Vues/footer.php";
    ?>