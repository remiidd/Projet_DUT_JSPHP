function resize_msg(){
  var his = document.getElementById("historique");
  var div = document.getElementsByClassName("discution");
  var taille = window.innerHeight - 56;
  for (i = 0; i < div.length; i++) {
    div[i].style.height = taille + "px";
  }

  his.style.height = taille + "px";

}

function charger(){

    setTimeout( function(){
        $.ajax({
            url : "scripts/php/charger.php",
            type : "GET",
            success : function(html){
                $('#message').html(html);
            }
        });

        charger();

    }, 3000);

}

function charger_historique(){

    setTimeout( function(){
        $.ajax({
            url : "scripts/php/charger_historique.php",
            type : "GET",
            success : function(html){
                $('#historique').html(html);
            }
        });
        charger_historique();
    }, 10000);

}

charger_historique();
charger();
