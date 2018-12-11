<?php
  session_start();

  function set_amis($amis){
    $_SESSION['amis_conv'] = $amis;
    header("Location: /messenger");
    exit();
  }

  if(isset($_GET['amis'])){
    set_amis($_GET['amis']);
  }


?>
