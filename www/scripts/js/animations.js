$(document).ready(function(){
  $(".titre_param").animate({
    top:'120px',
    opacity:'1'
  },"slow");

  $(".txt_modif_email").hide();
  $(".txt_modif_num").hide();


  $(".modif_info_bouton").click(function(){
    $(".txt_modif_email").toggle();
  });
});
