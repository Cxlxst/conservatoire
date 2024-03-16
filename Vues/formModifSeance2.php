<?php
    include "Vues/headerSeances.php";
    ?>

    <div class="container">
        <img class="MPT" src="Vues/img/MPT.svg" alt="">
    </div>

    <div class="container2Seance">
        <a href="index.php?uc=formInscription&choix=formAddSeance" >
            <img class="arrow" src="Vues/img/arrow.svg" alt="">
        </a>
        <div class="title">
            Étape 2
        </div>
    </div>

    <div class="containerCard">
        <div class="card3Seance">
            <form action="index.php?uc=formInscription&choix=formModifSeanceConfirm" method="POST">
                <div class="cardComplement">
                    <label><b>Jour de la séance</b></label></br>
                    <input class="inputSeance" name="jour" value="<?php echo $jour ?>" readonly> </input></br></br>

                    <label><b>Professeur · Matière</b></label></br>
                    <?php foreach($resultatProf as $unProf){ ?>
                        <input name="idProf" value=<?php echo $unProf->getIDPROF() ?> hidden> </input>
                        <input class="inputSeance" name="prof" value="<?php echo $unProf->getNOM() . " " . $unProf->getPRENOM() . " · " . $unProf->getINSTRUMENT() ?>" readonly> </input>
                    <?php } ?></br></br>

                    <label><b>Horaire</b></label></br>
                    <select name="horaire" id="affichageListeHoraire">
                        <?php foreach($listeHoraire as $horaire){ ?>
                            <option value=<?php echo $horaire ?>> <?php echo $horaire ?> </option>
                        <?php } ?>
                    </select></br></br>

                    <label><b>Niveau</b></label></br>
                    <select name="niveau" id="affichageListeNiveau">
                        <option value="1"> 1 </option>
                        <option value="2"> 2 </option>
                        <option value="3"> 3 </option>
                        <option value="4"> 4 </option>
                    </select></br></br>

                    <label><b>Capacité d'élèves</b></label></br>
                    <input class="inputSeance" name="capacite" value="<?php echo $capacite ?>"> </input></br></br>
                    
                    <input class="inputSeance" name="idSeance" value="<?php echo $id ?>" hidden> </input></br></br>
                    <button class="buttonCard" type="submit">Valider</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function affichageListe(tranche, niveau){
            let newOption=new Option(tranche, tranche)
            let Element=document.getElementById('affichageListeHoraire')
            Element.add(newOption, undefined);
            Element.value=tranche;
            
            let ElementNiveau=document.getElementById('affichageListeNiveau')
            ElementNiveau.value=niveau;
        }
    </script>


    <?php
        echo "<script type='text/javascript'>",
            "affichageListe('$tranche' , '$niveau');",
            "</script>"
    ?>