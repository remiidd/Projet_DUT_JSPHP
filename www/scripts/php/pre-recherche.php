<?php
  $rech = strtolower(str_replace(' ','',$_POST['recherche']));
  header("Location: /recherche-$rech");
  exit();
?>
