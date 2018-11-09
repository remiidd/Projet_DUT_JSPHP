<?php
  $caract = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $caract_long = strlen($caract);
  $randomString = '';
  for ($i = 0; $i < 10; $i++) {
      $randomString .= $caract[rand(0, $caract_long - 1)];
  }
  echo $randomString;
?>
