var mdp = document.getElementById('mdp');
var mdp1 = document.getElementById('mdprepeat');

mdp.addEventListener("input", function (e){
  pass_match();
});
mdp1.addEventListener("input", function (e){
  pass_match();
});

function pass_match(){
  if(mdp.value != mdp1.value){
    document.getElementById('passerror').style.display = "inline";
    document.getElementById('login').setAttribute("disabled", "");
  }
  else{
    document.getElementById('passerror').style.display = "none";
    document.getElementById('login').removeAttribute("disabled");
  }
}

function exist(){
  document.getElementById('id_exist').style.display = "inline";
}
