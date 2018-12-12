var mdp = document.getElementById('mdp');
var mdp1 = document.getElementById('mdp1');
var email = document.getElementById('email');
var prenom = document.getElementById("prenom_input");
var nom = document.getElementById("nom_input");

mdp.addEventListener("input", function (e){
  pass_match();
});
mdp1.addEventListener("input", function (e){
  pass_match();
});
email.addEventListener("input", function(e){
  regemail();
});

prenom.addEventListener("input", function(e){
  var re = /^[a-zA-Z]+$/;
  if (re.test(prenom.value)) {
    console.log("ok");
    prenom.style.borderColor = "none";
    prenom.style.borderStyle = "inset";
    prenom.style.borderWidth = "2px";
  }
  else {
    console.log("pas ok");
    prenom.style.borderColor = "red";
    prenom.style.borderStyle = "solid";
    prenom.style.borderWidth = "4px";
  }
});

nom.addEventListener("input", function(e){
  var re = /^[a-zA-Z]+$/;
  if (re.test(nom.value)) {
    console.log("ok");
  }
  else {
    console.log("pas ok");
  }
});


function emailexiste(){
  document.getElementById('mailerror').style.display = "inline";
}

function regemail(){
  var re = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
  if (re.test(email.value)) {
    document.getElementById('mailinvalide').style.display = "none";
    document.getElementById('inscriBout').removeAttribute("disabled");
  }
  else {
    document.getElementById('mailinvalide').style.display = "inline";
    document.getElementById('inscriBout').setAttribute("disabled", "");
  }
}

function pass_match(){
  if(mdp.value != mdp1.value){
    document.getElementById('passerror').style.display = "inline";
    document.getElementById('inscriBout').setAttribute("disabled", "");
  }
  else{
    document.getElementById('passerror').style.display = "none";
    document.getElementById('inscriBout').removeAttribute("disabled");
  }
}

function exist(){
  document.getElementById('id_exist').style.display = "inline";
}
