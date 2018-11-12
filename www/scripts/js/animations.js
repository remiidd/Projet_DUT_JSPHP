$(".txt_modif_email").hide();

$(document).ready(function(){
  $(".titre_param").animate({
    top:'120px',
    opacity:'1'
  },"slow");


  $(".modif_info_bouton_email").click(function(){
    $(".txt_modif_email").toggle();
  });
  $(".modif_info_bouton_num").click(function(){
    $(".txt_modif_num").toggle();
  });


});
