<?php
  session_start();
  if(isset($_GET['amis'])){
    set_amis($_GET['amis']);
  }

  function set_amis($amis){
    $_SESSION('amis_conv') = $amis;
    header("Location: /messenger");
    exit();
  }
?>
