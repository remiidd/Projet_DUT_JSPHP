console.log("test");


function verif_bar() {
  setTimeout( function(){
      console.log("salut");
      console.log($(document).height() - $(window).height() - $(window).scrollTop());
      if (($(document).height() - $(window).height() - $(window).scrollTop()) == 0) {
         console.log("en bas");
      }
  }, 3000);

  verif_bar();
  
}

verif_bar();
