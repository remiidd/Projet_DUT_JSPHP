function verif_bar() {
  var bottom = $(document).height() - $(window).height() - $(window).scrollTop();
    if(bottom == 0) {
        //en bas
    }
}

document.addEventListener('scroll', function() {
  verif_bar();
});
