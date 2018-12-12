
function verif_bar() {
  var bottom = $(document).height() - $(window).height() - $(window).scrollTop();
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

document.addEventListener('scroll', function() {
  verif_bar();
});
