<?php
header("Content-Type: text/plain");

if(isset($_GET["id"])) {
  $id = $_GET["id"];
} else {
  $id = null;
}

if(($id!=null)&&($id!=0)) {
  $bdd = new PDO('mysql:host=lulipa.server.r-heberg.fr;dbname=derayalois;charset=utf8', 'derayalois', 'testdebrayalois');

    //DELETE FROM `derayalois`.`like_table` WHERE `like_table`.`id` = 8;
  $req = $bdd->query('DELETE FROM emploi WHERE id=\''.$id.'\'');
}





?>
