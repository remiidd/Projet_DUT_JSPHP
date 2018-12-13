
function verif_bar(bottom) {
    if(bottom == 0) {
      var urll = "scripts/php/feed_defilement.php";
      $.ajax({
          url : urll,
          type : "GET",
          success : function(html){
              $('.wrapp').append(html);
          }
      });
    }
}

if(!($(document).height() > $(window).height())) {
    verif_bar(0);
}

document.addEventListener('scroll', function() {
    var verif = $(document).height() - $(window).height() - $(window).scrollTop();
    verif_bar(verif);
});
