var mdp = document.getElementById('mdp');
var mdp1 = document.getElementById('mdp1');
var email = document.getElementById('email');
var prenom = document.getElementById("prenom_input");

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
