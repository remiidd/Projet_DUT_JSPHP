document.getElementsByClassName('rechin').addEventListener("input", function(e){
  console.log(document.getElementsByClassName('rechin').value);
});

function resize_img(){
  var img = document.getElementsByClassName("rech_div_img");
  var div = document.getElementsByClassName("rech_user");
  var taille = document.body.clientWidth / 10;
  var taille2 = document.body.clientWidth / 10 + 0.004 * document.body.clientWidth;
  for (i = 0; i < img.length; i++) {
    img[i].style.width = taille + "px";
    img[i].style.height = taille + "px";
  }
  for (i = 0; i < div.length; i++) {
    div[i].style.height = taille2 + "px";
  }
}
