function notif_messenger(){

    setTimeout( function(){
        $.ajax({
            url : "scripts/php/notif_messenger.php",
            type : "GET",
            success : function(html){
                $('#notification_count_menu').html(html);
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
                $('#notification_count_menu_invit').html(html);
            }
        });

        notif_invitation();

    }, 3000);

}

notif_messenger();
notif_invitation();
