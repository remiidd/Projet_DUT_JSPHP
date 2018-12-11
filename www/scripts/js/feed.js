console.log("test");


function verif_bar() {
  setTimeout( function(){
      console.log("salut");
      console.log((this.scrollTop + this.clientHeight - this.scrollHeight));
      if ((this.scrollTop + this.clientHeight - this.scrollHeight) == 0) {
         console.log("en bas");
      }
  }, 3000);
}

verif_bar();
