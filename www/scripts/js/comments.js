document.ready(function(){
  /* function getParameterByName(name) {
    name = name.replace(/[[]/, [).replace(/[]]/, ]);
    var regexS = [?&] + name + =([^&#]*);
    var regex = new RegExp(regexS);
    var results = regex.exec(window.location.search);
    if(results == null) {
      return;
    } else {
      return decodeURIComponent(results[1].replace(/+/g, ));
    }
  } */

  function recup_id_post() {
    var t = location.search.substring(1).split('&');
	  var f = [];
	  for (var i=0; i<t.length; i++){
		    var x = t[ i ].split('=');
		      f[x[0]]=x[1];
    }
	  return f;
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
