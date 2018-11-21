function resize_img(){
  var img = document.getElementsByClassName("rech_div_img");
  var taille = document.body.clientWidth / 10;
  for (i = 0; i < img.length; i++) {
    img[i].style.width = taille + "px";
    img[i].style.height = taille + "px";
  }
}
