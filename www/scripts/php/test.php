<?php
function generateRandomString() {
  $caract = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $caract_long = strlen($caract);
  $randomString = '';
  for ($i = 0; $i < 20; $i++) {
      $randomString .= $caract[rand(0, $caract_long - 1)];
  }
  return md5($randomString);
}

echo "str" . generateRandomString();
?>
