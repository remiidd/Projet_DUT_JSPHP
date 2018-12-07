document.ready(function(){
  function charger(){

      setTimeout( function(){
          $.ajax({
              url : "scripts/php/load_com.php",
              type : "GET",
              success : function(html){
                  $('#message').html(html);
              }
          });

          charger();

      }, 3000);

  }

});
