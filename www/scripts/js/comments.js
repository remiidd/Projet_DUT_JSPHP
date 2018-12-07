document.ready(function(){
  function getParameterByName(name) {
    name = name.replace(/[[]/, [).replace(/[]]/, ]);
    var regexS = [?&] + name + =([^&#]*);
    var regex = new RegExp(regexS);
    var results = regex.exec(window.location.search);
    if(results == null) {
      return;
    } else {
      return decodeURIComponent(results[1].replace(/+/g, ));
    }
  }


  function charger(){
      var id_post = getParameterByName(id);
      setTimeout( function(){
          $.ajax({
              url : "scripts/php/load_com.php?id="+id_post,
              type : "GET",
              success : function(html){
                  $('#message').html(html);
              }
          });

          charger();

      }, 3000);

  }

});
