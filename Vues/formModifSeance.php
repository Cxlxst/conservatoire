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
            <form action="index.php?uc=formInscription&choix=formModifSeance2" method="POST">
                <div class="cardComplement">
                    <label><b>Jour de la séance</b></label></br>
                    <select name="jour" id="selectedJour">
                            <option class="option2" value="Lundi"> Lundi </option>
                            <option value="Mardi"> Mardi </option>
                            <option value="Mercredi"> Mercredi </option>
                            <option value="Jeudi"> Jeudi </option>
                            <option value="Vendredi"> Vendredi </option>
                            <option value="Samedi"> Samedi </option>
                            <option value="Dimanche"> Dimanche </option>
                    </select></br></br></br>

                    <input type="text" name="idProf" value="<?php echo $idProf ?>" hidden> </input>
                    <input type="text" name="idSeance" value="<?php echo $id?>" hidden> </input>
                    <input type="text" name="jour" value="<?php echo $jour?>" hidden> </input>
                    <input type="text" name="tranche" value="<?php echo $tranche?>" hidden> </input>
                    <input type="text" name="niveau" value="<?php echo $niveau?>" hidden> </input>
                    <input type="text" name="capacite" value="<?php echo $capacite?>" hidden> </input>
                    <button class="buttonCard" type="submit">Suivant</button>
                </div>
            </form>
        </div>
    </div>


    <script>
        function functionJour(jour){
            let Element=document.getElementById('selectedJour')
            Element.value= jour;
            console.log("test")
        }
    </script>


    <?php
        echo "<script type='text/javascript'>",
            "functionJour('$jour');",
            "</script>"
    ?>