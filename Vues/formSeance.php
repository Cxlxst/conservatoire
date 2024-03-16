<?php
    include "Vues/headerSeances.php";
        // var_dump($resultatProf);
    ?>

    <div class="container">
        <img class="MPT" src="Vues/img/MPT.svg" alt="">
    </div>

    <div class="container">
        <div class="title">
            Étape 1
        </div>
    </div>

    <div class="containerCard">
        <div class="card3">
            <form action="index.php?uc=formInscription&choix=formAddSeance2" method="POST">
                <div class="cardComplement">
                    <label><b>Jour de la séance</b></label></br>
                    <select name="jour">
                            <option class="option2" value="Lundi"> Lundi </option>
                            <option value="Mardi"> Mardi </option>
                            <option value="Mercredi"> Mercredi </option>
                            <option value="Jeudi"> Jeudi </option>
                            <option value="Vendredi"> Vendredi </option>
                            <option value="Samedi"> Samedi </option>
                            <option value="Dimanche"> Dimanche </option>
                    </select></br></br></br>

                    <label><b>Professeur · Matière</b></label></br>
                    <select name="prof">
                        <?php foreach($resultatProf as $unProf){ ?>
                        <option value= <?php echo $unProf->getIDPROF() ?> > <?php echo $unProf->getNOM() . " " . $unProf->getPRENOM() . " · " . $unProf->getINSTRUMENT() ?></option>
                        <?php } ?>
                    </select></br></br></br>
                    
                    <button class="buttonCard" type="submit">Suivant</button>
                </div>
            </form>
        </div>
    </div>