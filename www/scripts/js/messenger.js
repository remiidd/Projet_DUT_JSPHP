function resize_msg(){
  var his = document.getElementsByClassName("historique");
  var div = document.getElementsByClassName("discution");
  var taille = window.innerHeight - 56;
  for (i = 0; i < div.length; i++) {
    div[i].style.height = taille + "px";
  }

  for (i = 0; i < his.length; i++) {
    his[i].style.height = taille + "px";
  }
}
