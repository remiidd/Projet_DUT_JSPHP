$(document).ready(function(){
  $(".txt_modif_email2").hide();

  $(".titre_param").animate({
    top:'120px',
    opacity:'1'
  },"slow");

  $(".modif_info_bouton").click(function(){
    $(".txt_modif_email").toggle();
  });
});
