function resize_his(){
  var his = document.getElementsByClassName("historique");
  var div = document.getElementsByClassName("discution");
  var taille = document.body.clientHeight - 53;
  console.log(taille);
  for (i = 0; i < div.length; i++) {
    div[i].style.height = taille + "px";
  }

  for (i = 0; i < his.length; i++) {
    his[i].style.height = taille + "px";
  }
}
