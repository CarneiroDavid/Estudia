function afficherModif()
{

    if(document.getElementById("ModifierClasse").style.display == "none")
    {
        document.getElementById("ModifierClasse").style.display = "block";

    }
    else if(document.getElementById("ModifierClasse").style.display == "block")
    {
        document.getElementById("ModifierClasse").style.display = "none";

    }
    
}
function formulairePunition()
{
    document.getElementById("motif").value = "";
    document.getElementById("punition").value = "";
    document.getElementById("date").value = "";

    document.getElementById("id").name = "envoi";
    if(document.getElementById("formPunition").style.display == "none")
    {
        document.getElementById("formPunition").style.display = "block";

    }
    else if(document.getElementById("formPunition").style.display == "block")
    {
        document.getElementById("formPunition").style.display = "none";

    }
    
}
function modifierPunition($idPunition)
{

    document.getElementById("motif").value = document.getElementById("motif"+$idPunition).innerHTML;
    document.getElementById("punition").value = document.getElementById("punition"+$idPunition).innerHTML;
    document.getElementById("date").value = document.getElementById("date"+$idPunition).value;

    document.getElementById("id").value = $idPunition;
    document.getElementById("id").name = "modif";

    if(document.getElementById("formPunition").style.display == "none")
    {
        document.getElementById("formPunition").style.display = "block";

    }
  

}
function modifierNote($idNote)
{

    document.getElementById("note").value = document.getElementById("note"+$idNote).innerHTML;
    document.getElementById("note").max = document.getElementById("noteMax"+$idNote).innerHTML;
    document.getElementById("designation").value = document.getElementById("designation"+$idNote).innerHTML;
    document.getElementById("matiere").value = document.getElementById("matiere"+$idNote).value;
    document.getElementById("commentaire").value = document.getElementById("commentaire"+$idNote).innerHTML;
    document.getElementById("noteMax").value = document.getElementById("noteMax"+$idNote).innerHTML;
    document.getElementById("modif").value = document.getElementById("id"+$idNote).value;

    if(document.getElementById("modifNote").style.display == "none")
    {
        document.getElementById("modifNote").style.display = "block";

    }
    else if(document.getElementById("modifNote").style.display == "block")
    {
        document.getElementById("modifNote").style.display = "none";

    }
   
  

}

function inputMat()
{
    if(document.getElementById("divMatiere").style.display == "Professeur")
    {
        document.getElementById("divMatiere").style.display = "block";

    }
}