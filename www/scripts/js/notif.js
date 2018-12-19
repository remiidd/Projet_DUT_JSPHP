function notif_feed(){
    setTimeout(function(){
      $.ajax({
        utl : "scripts/php/notif_feed.php",
        type : "GET",
        success : function(html){
          $('').html(html);
        }
      });

      notif_feed();
    }, 3000);
}

function notif_messenger(){

    setTimeout( function(){
        $.ajax({
            url : "scripts/php/notif_messenger.php",
            type : "GET",
            success : function(html){
                $('#messenger_i').html(html);
            }
        });

        notif_messenger();

    }, 3000);

}

function notif_invitation(){

    setTimeout( function(){
        $.ajax({
            url : "scripts/php/notif_invitation.php",
            type : "GET",
            success : function(html){
                $('#invitation_i').html(html);
            }
        });

        notif_invitation();

    }, 3000);

}

//notif_messenger();
//notif_invitation();
