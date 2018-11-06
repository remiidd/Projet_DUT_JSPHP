$(".txt_modif_email").hide();
$(document).ready(function(){
  $(".titre_param").animate({
    top:'120px',
    opacity:'1'
  },"slow");
});

function modif() {
  $(".txt_modif_email").toggle();
}
