<?php
  echo 'bug' . $_POST['recherche'];
  $rech = strtolower(str_to_noaccent(str_replace(' ','',$_POST['recherche'])));
  echo $recherche;
?>
