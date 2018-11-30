<?php
  if(isset($_POST['recherche'])){
    $rech = strtolower(str_to_noaccent(str_replace(' ','',$_POST['recherche'])));
    header("Location: /recherche-$rech");
    exit();
  }
?>
