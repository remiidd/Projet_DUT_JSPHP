<?php
  if(isset($_GET['code'])){
    echo $_GET['code'];



  }
  else {
    header("Location: ../../index.php");
    exit();
  }

?>
