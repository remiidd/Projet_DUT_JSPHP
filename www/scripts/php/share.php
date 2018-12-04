<?php
header("Content-Type: text/plain");

if(isset($_GET["id_post"])) {
  $id_post = $_GET["id_post"];
} else {
  $id_post=null;
}
if(isset($_GET["id_post"])) {
  $id_profil = $_GET["id_profil"];
} else {
  $id_profil=null;
}

if(($id_post!=null)&&($id_profil!=null)&&($id_post!=0)&&($id_profil!=0)) {
  $bdd = new PDO('mysql:host=lulipa.server.r-heberg.fr;dbname=derayalois;charset=utf8', 'derayalois', 'testdebrayalois');
  $req = $bdd->query('SELECT * FROM profil WHERE id=\''.$id_profil.'\'');
  $data = $req->fetch();

  echo "id post = ".$id_post." id profil = ".$id_profil;
  $req = $bdd->query('INSERT INTO like_table(id, id_post, profil_like) VALUES(NULL, \''.$id_post.'\', \''.$id_profil.'\')');
  //UPDATE `derayalois`.`posts` SET `nb_like` = '1' WHERE `posts`.`id` = 3;
  $req = $bdd->query('UPDATE posts SET nb_share=nb_share+1 WHERE id=\''.$id_post.'\'');
}





?>
