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

notif_messenger();
