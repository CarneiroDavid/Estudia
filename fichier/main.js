function addResume(id)
{
    console.log(document.getElementById(id));
    if(document.getElementById("resumeCours").style.display != "none")
    {
        document.getElementById("resumeCours").style.display = "none";

    }
    else if(document.getElementById("resumeCours").style.display == "none")
    {
        document.getElementById("resumeCours").style.display = "block";

    }
}
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
function modifAppel(){
  var x = document.getElementById("appel-state");
  x.style.backgroundColor = "darkred";
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
    document.getElementById("commentaire").value = document.getElementById("commentaire"+$idNote).innerHTML;
    document.getElementById("noteMax").value = document.getElementById("noteMax"+$idNote).innerHTML;
    document.getElementById("Coef").value = document.getElementById("Coef"+$idNote).innerHTML;

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

function CoursDetail(id)
{
    var xhr = new XMLHttpRequest();
     xhr.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("etd-cour-detail-block").innerHTML = xhr.responseText;
        }
    }
    xhr.open("GET", "listeAppel.php?cour="+id, true);
    xhr.send();
}
function SaveListing(idCours){

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function(){
       if (this.readyState == 4 && this.status == 200) {
           document.getElementById("etd-cour-appel-block").innerHTML = xhr.responseText;
       }
    }
   xhr.open("POST", "../traitements/valideAppel.php?cour="+idCours, true);
   xhr.send("");
}
function SaveResumeCours(idCours){

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function(){
       if (this.readyState == 4 && this.status == 200) {
           document.getElementById("etd-cour-appel-block").innerHTML = xhr.responseText;
       }
    }
   xhr.open("POST", "../traitements/validResume.php?cour="+idCours, true);
   xhr.send("");
  }

function submitResumeCours()
{
    document.getElementById('resumeCour').submit();
}
var AJAXSubmit = (function () {

    function ajaxSuccess () {
      console.log(this.responseText);
      var x = document.getElementById("appel-state");
      x.style.backgroundColor = "chartreuse"
      /* you can get the serialized data through the "submittedData" custom property: */
      /* console.log(JSON.stringify(this.submittedData)); */
    }
  
    function submitData (oData) {
      /* the AJAX request... */
      var oAjaxReq = new XMLHttpRequest();
      oAjaxReq.submittedData = oData;
      oAjaxReq.onload = ajaxSuccess;
      if (oData.technique === 0) {
        /* method is GET */
        oAjaxReq.open("get", oData.receiver.replace(/(?:\?.*)?$/,
            oData.segments.length > 0 ? "?" + oData.segments.join("&") : ""), true);
        oAjaxReq.send(null);
      } else {
        /* method is POST */
        oAjaxReq.open("post", oData.receiver, true);
        if (oData.technique === 3) {
          /* enctype is multipart/form-data */
          var sBoundary = "---------------------------" + Date.now().toString(16);
          oAjaxReq.setRequestHeader("Content-Type", "multipart\/form-data; boundary=" + sBoundary);
          oAjaxReq.sendAsBinary("--" + sBoundary + "\r\n" +
              oData.segments.join("--" + sBoundary + "\r\n") + "--" + sBoundary + "--\r\n");
        } else {
          /* enctype is application/x-www-form-urlencoded or text/plain */
          oAjaxReq.setRequestHeader("Content-Type", oData.contentType);
          oAjaxReq.send(oData.segments.join(oData.technique === 2 ? "\r\n" : "&"));
        }
      }
    }
  
    function processStatus (oData) {
      if (oData.status > 0) { return; }
      /* the form is now totally serialized! do something before sending it to the server... */
      /* doSomething(oData); */
      /* console.log("AJAXSubmit - The form is now serialized. Submitting..."); */
      submitData (oData);
    }
  
    function pushSegment (oFREvt) {
      this.owner.segments[this.segmentIdx] += oFREvt.target.result + "\r\n";
      this.owner.status--;
      processStatus(this.owner);
    }
  
    function plainEscape (sText) {
      /* How should I treat a text/plain form encoding?
         What characters are not allowed? this is what I suppose...: */
      /* "4\3\7 - Einstein said E=mc2" ----> "4\\3\\7\ -\ Einstein\ said\ E\=mc2" */
      return sText.replace(/[\s\=\\]/g, "\\$&");
    }
  
    function SubmitRequest (oTarget) {
      var nFile, sFieldType, oField, oSegmReq, oFile, bIsPost = oTarget.method.toLowerCase() === "post";
      /* console.log("AJAXSubmit - Serializing form..."); */
      this.contentType = bIsPost && oTarget.enctype ? oTarget.enctype : "application\/x-www-form-urlencoded";
      this.technique = bIsPost ?
          this.contentType === "multipart\/form-data" ? 3 : this.contentType === "text\/plain" ? 2 : 1 : 0;
      this.receiver = oTarget.action;
      this.status = 0;
      this.segments = [];
      var fFilter = this.technique === 2 ? plainEscape : escape;
      for (var nItem = 0; nItem < oTarget.elements.length; nItem++) {
        oField = oTarget.elements[nItem];
        if (!oField.hasAttribute("name")) { continue; }
        sFieldType = oField.nodeName.toUpperCase() === "INPUT" ? oField.getAttribute("type").toUpperCase() : "TEXT";
        if (sFieldType === "FILE" && oField.files.length > 0) {
          if (this.technique === 3) {
            /* enctype is multipart/form-data */
            for (nFile = 0; nFile < oField.files.length; nFile++) {
              oFile = oField.files[nFile];
              oSegmReq = new FileReader();
              /* (custom properties:) */
              oSegmReq.segmentIdx = this.segments.length;
              oSegmReq.owner = this;
              /* (end of custom properties) */
              oSegmReq.onload = pushSegment;
              this.segments.push("Content-Disposition: form-data; name=\"" +
                  oField.name + "\"; filename=\"" + oFile.name +
                  "\"\r\nContent-Type: " + oFile.type + "\r\n\r\n");
              this.status++;
              oSegmReq.readAsBinaryString(oFile);
            }
          } else {
            /* enctype is application/x-www-form-urlencoded or text/plain or
               method is GET: files will not be sent! */
            for (nFile = 0; nFile < oField.files.length;
                this.segments.push(fFilter(oField.name) + "=" + fFilter(oField.files[nFile++].name)));
          }
        } else if ((sFieldType !== "RADIO" && sFieldType !== "CHECKBOX") || oField.checked) {
          /* NOTE: this will submit _all_ submit buttons. Detecting the correct one is non-trivial. */
          /* field type is not FILE or is FILE but is empty */
          this.segments.push(
            this.technique === 3 ? /* enctype is multipart/form-data */
              "Content-Disposition: form-data; name=\"" + oField.name + "\"\r\n\r\n" + oField.value + "\r\n"
            : /* enctype is application/x-www-form-urlencoded or text/plain or method is GET */
              fFilter(oField.name) + "=" + fFilter(oField.value)
          );
        }
      }
      processStatus(this);
    }
  
    return function (oFormElement) {
      if (!oFormElement.action) { return; }
      new SubmitRequest(oFormElement);
    };
  
  })();

function submitTrimestre()
{
    var form = document.getElementById("formTrimestre");
    form.submit();
}