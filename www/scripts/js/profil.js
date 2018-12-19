function resize_img(){
  var img = document.getElementsByClassName("pp");
  var taille = document.body.clientWidth / 10;
  for (i = 0; i < img.length; i++) {
    img[i].style.width = taille + "px";
    img[i].style.height = taille + "px";
  }
  console.log(taille);
}
