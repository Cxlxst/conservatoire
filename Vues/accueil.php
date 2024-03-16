<?php 
        include "Vues/headerAccueil.php";
        $dateJour = getdate();
        $semaine = array(" Dimanche "," Lundi "," Mardi "," Mercredi "," Jeudi "," vendredi "," samedi ");
        $mois =array(1=>" janvier "," février "," mars "," avril "," mai "," juin "," juillet "," août "," septembre "," octobre "," novembre "," décembre ");
    ?>

    <div class="container">
        <img class="MPT" src="Vues/img/MPT.svg" alt="">
    </div>

    <?php $adminPrenom = $_SESSION["nomAdmin"];
    
    foreach ($adminPrenom as $unAdmin){ ?>
        <div class="Title">
            Bonjour <?php echo $unAdmin->getPRENOM() ?> ! </br>
            Passez une belle journée en ce
            <?php echo $semaine[date('w')] ," ",date('j'),"", $mois[date('n')], date('Y'),"." ?>
        </div>
    <?php } ?></br></br>

    <div class="containerCours">
        <div>
            <div class="title">
                Cours actuels
            </div>

            <div class="containerList">
                <?php if(empty($resultatActu)){?>
                    <div class="row">
                        <div> Aucun cours pour le moment </div>
                    </div>
                <?php }
                else{
                    foreach ($resultatActu as $seance){ ?>
                        <div class="row">
                            <?php echo $seance->getINSTRUMENT()?>,
                            <?php echo $seance->getTRANCHE()?> · 
                            <?php echo $seance->getNOM()?>
                            <?php echo $seance->getPRENOM()?>
                            <form action="index.php?uc=pageConsulter&choix=afficher" method="POST">
                                <input type="text" name="idSeance" value="<?php echo $seance->getNUMSEANCE()?>" hidden> </input>
                                <button type="sumbit" name="jacques" class="jacques"><img class="test" src="Vues/img/arrow_right.svg" alt=""></button>
                            </form>
                        </div>
                        <?php } 
                    }?>
            </div></br></br>
             
        </div>

        <div>
            <div class="title">
                Cours à venir
            </div>
            
            <div class="containerList">
                <?php if(empty($resultatPro)){ ?>
                    <div class="row">
                        <div> Aucun cours à venir </div>
                    </div>
                <?php } 
                else{
                    foreach ($resultatPro as $seance){ ?>
                        <div class="row">
                            <?php echo $seance->getINSTRUMENT()?>,
                            <?php echo $seance->getTRANCHE()?> · 
                            <?php echo $seance->getNOM()?>
                            <?php echo $seance->getPRENOM()?>
                            <form action="index.php?uc=pageConsulter&choix=afficher" method="POST">
                                <input type="text" name="idSeance" value="<?php echo $seance->getNUMSEANCE()?>" hidden> </input>
                                <button type="sumbit" name="jacques" class="jacques"><img class="test" src="Vues/img/arrow_right.svg" alt=""></button>
                            </form>
                        </div>
                        <?php }
                    }?> 
            </div>
        </div>
    </div>
</body>