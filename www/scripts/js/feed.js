function verif_bar() {
  var bottom = $(document).height() - $(window).height() - $(window).scrollTop();
  setTimeout(function(){
      console.log(bottom);
      if(bottom == 0) {
         console.log("en bas");
      }
      verif_bar();
  }, 3000);
}

verif_bar();
