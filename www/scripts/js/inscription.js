var mdp = document.getElementById('mdp');
var mdp1 = document.getElementById('mdp1');
var email = document.getElementById('email');

mdp.addEventListener("input", function (e){
  pass_match();
});
mdp1.addEventListener("input", function (e){
  pass_match();
});
email.addEventListener("input", function(e){
  regemail();
}

function emailexiste(){
  document.getElementById('mailerror').style.display = "inline";
});

function regemail(){
  console.log(email.value);
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
