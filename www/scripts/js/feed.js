function verif_bar() {
  var bottom = $(document).height() - $(window).height() - $(window).scrollTop();
    if(bottom == 0) {
      $('.wrapp').append('<?php if($_GET["feed"]!=100){ include "scripts/php/feed_defilement.php"; } ?>');
    }
}

document.addEventListener('scroll', function() {
  verif_bar();
});
