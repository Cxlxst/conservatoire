
function addProf(instrumentAdd, salaireAdd, buttonConfirm, buttonAnnule, buttonJS, instrumentText, salaireText){
    // console.log(instrumentAdd)
    document.getElementById(buttonJS).style.display = "none"
    document.getElementById(instrumentAdd).style.display = "block"
    document.getElementById(salaireAdd).style.display = "block"
    document.getElementById(buttonConfirm).style.display = "block"
    document.getElementById(buttonAnnule).style.display = "block"
    document.getElementById(instrumentText).style.display = "block"
    document.getElementById(salaireText).style.display = "block"
}

function closeProf(instrumentAdd, salaireAdd, buttonConfirm, buttonAnnule, buttonJS){
    document.getElementById(buttonJS).style.display = "block"
    document.getElementById(instrumentAdd).style.display = "none"
    document.getElementById(salaireAdd).style.display = "none"
    document.getElementById(buttonConfirm).style.display = "none"
    document.getElementById(buttonAnnule).style.display = "none"
    document.getElementById(instrumentText).style.display = "none"
    document.getElementById(salaireText).style.display = "none"
}

function addEleve(bourseAdd, buttonConfirm, buttonAnnule, buttonJS){
    document.getElementById(buttonJS).style.display = "none"
    document.getElementById(bourseAdd).style.display = "block"
    document.getElementById(buttonConfirm).style.display = "block"
    document.getElementById(buttonAnnule).style.display = "block"
}

function closeEleve(bourseAdd, buttonConfirm, buttonAnnule, buttonJS){
    document.getElementById(buttonJS).style.display = "block"
    document.getElementById(bourseAdd).style.display = "none"
    document.getElementById(buttonConfirm).style.display = "none"
    document.getElementById(buttonAnnule).style.display = "none"
}

function affichageJour(jour){
    // console.log(jour)
    document.getElementById(jour.id).classList.add('buttonTitleSelected');
}

function affichageJourDefault(){
    document.getElementById("Tout").classList.add('buttonTitleSelected');
}

function jourSeance(){
    const jourSemaine = ["Dimanche","Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi"];
    const j = new Date();
    let jour = jourSemaine[j.getDay()];
    console.log(jour)
    return jour;
}