<?php
function generateRandomString() {
  $caract = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $caract_long = strlen($caract);
  $randomString = '';
  for ($i = 0; $i < 10; $i++) {
      $randomString .= $characters[rand(0, $charactersLength - 1)];
  }
  return $randomString;
}

echo "str" . generateRandomString();
?>
