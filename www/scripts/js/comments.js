
  function recup_id_post() {
    var t = location.search.substring(1).split('&');
	  var f = [];
	  for (var i=0; i<t.length; i++){
		    var x = t[ i ].split('=');
		      f[x[0]]=x[1];
    }
    var res = f[0];
	  return f;
  }

  function charger_com(){
      var id_post = recup_id_post();
      var url_com = "scripts/php/load_com.php?id="+id_post["id"];
      console.log(url_com);
      console.log(id_post["id"]);
      setTimeout( function(){
          $.ajax({
              url : url_com,
              type : "GET",
              success : function(html){
                  $('#message').html(html);
              }
          });

          charger_com();

      }, 3000);

  }

  charger_com();
