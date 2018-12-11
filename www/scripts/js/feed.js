function verif_bar() {
  console.log("salut");
  var bottom = $(document).height() - $(window).height() - $(window).scrollTop();
    console.log(bottom);
    if(bottom == 0) {
        console.log("en bas");
    }
}

document.addEventListener('scroll', function() {
  verif_bar();
});
