var mdp = document.getElementById('mdpr');
var mdp1 = document.getElementById('mdpr1');

mdp.addEventListener("input", function (e){
  pass_match();
});
mdp1.addEventListener("input", function (e){
  pass_match();
});

function pass_match(){
  if(mdp.value != mdp1.value){
    document.getElementById('passerrorr').style.display = "inline";
    document.getElementById('inscriBout').setAttribute("disabled", "");
  }
  else{
    document.getElementById('passerrorr').style.display = "none";
    document.getElementById('inscriBout').removeAttribute("disabled");
  }
}
