    <?php
    include "Vues/headerProf.php";
        // var_dump($resultatP);
    ?>

    <div class="container">
        <img class="MPT" src="Vues/img/MPT.svg" alt="">
    </div>

    <div class="container2">
        <a href="index.php?uc=pageProf&choix=professeur">
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
                    <?php echo $laPersonne->getADRESSE() ?></br>
                </div>
            </div>

            <div class="cardComplement">
                <?php
                    $instrumentAdd = "instrumentAdd" . $laPersonne->getID();
                    $salaireAdd = "salaireAdd" . $laPersonne->getID();
                    $buttonConfirm = "buttonConfirm" . $laPersonne->getID();
                    $buttonAnnule = "buttonAnnule" . $laPersonne->getID();
                    $buttonJS = "buttonJS" . $laPersonne->getID();
                    $instrumentText = "instrumentText" . $laPersonne->getID();
                    $salaireText = "salaireText" . $laPersonne->getID();
                ?>
                <button onclick="addProf('<?php echo $instrumentAdd?>','<?php echo $salaireAdd?>','<?php echo $buttonConfirm?>', '<?php echo $buttonAnnule?>', '<?php echo $buttonJS?>', '<?php echo $instrumentText?>', '<?php echo $salaireText?>')" class="buttonCard" id="<?php echo "buttonJS" . $laPersonne->getID() ?>" type="submit">Ajouter</button>

                <form action="index.php?uc=formInscription&choix=formAddProf" method="POST">
                    <label class="inputJS" id="<?php echo "instrumentText" . $laPersonne->getID() ?>"><b> Instrument </b></label>
                    <select class="inputJS" name="instrumentAdd" id="<?php echo "instrumentAdd" . $laPersonne->getID() ?>">
                        <?php foreach($resultatI as $unInstrument){ ?>
                            <option> <?php echo $unInstrument->getINSTRUMENT() ?></option>
                        <?php } ?>
                    </select></br>

                    <label class="inputJS" id="<?php echo "salaireText" . $laPersonne->getID() ?>"><b> Salaire (en euros) </b></label>                    
                    <input type="text" class="inputJSCustom" name="salaireAdd" id="<?php echo "salaireAdd" . $laPersonne->getID() ?>"> </input>
                    
                    <div class="buttonFlex">
                        <input type="text" name="idPersonne" value="<?php echo $laPersonne->getID()?>" hidden> </input>
                        <button class="buttonCardJS" id="<?php echo "buttonConfirm" . $laPersonne->getID() ?>" value="<?php echo $laPersonne->getID() ?>" type="submit">Confirmer</button>
                        <button onclick="closeProf('<?php echo $instrumentAdd?>','<?php echo $salaireAdd?>','<?php echo $buttonConfirm?>', '<?php echo $buttonAnnule?>', '<?php echo $buttonJS?>', '<?php echo $instrumentText?>', '<?php echo $salaireText?>')" class="buttonCardJS" id="<?php echo "buttonAnnule" . $laPersonne->getID() ?>" type="button">Annuler</button>
                    </div>
                </form>
            </div>
        </div>
        <?php } ?>
    </div>

    <?php
    include "Vues/footer.php";
    ?>