$(document).ready(function(){
  $(".titre_param").animate({
    top:'120px',
    opacity:'1'
  },"slow");

  $(".modif_info_bouton_email").click(function(){
    $(".txt_modif_email").toggle();
  });
  $(".modif_info_bouton_tel").click(function(){
    $(".txt_modif_tel").toggle();
  });
  $(".modif_info_bouton_ville").click(function(){
    $(".txt_modif_ville").toggle();
  });
  $(".modif_info_bouton_naissance").click(function(){
    $(".txt_modif_naissance").toggle();
  });
  $(".modif_info_bouton_emploi").click(function(){
    $(".txt_modif_emploi").toggle();
  });


});
