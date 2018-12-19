<?php
session_start();
header("Content-Type: text/plain");

if(isset($_GET["id_post"])) {
  $id_post = $_GET["id_post"];
} else {
  $id_post=null;
}
if(isset($_SESSION["idcon"])) {
  $id_profil = $_SESSION["idcon"];
} else {
  $id_profil=null;
}

if(($id_post!=null)&&($id_profil!=null)&&($id_post!=0)&&($id_profil!=0)) {
  $bdd = new PDO('mysql:host=lulipa.server.r-heberg.fr;dbname=derayalois;charset=utf8', 'derayalois', 'testdebrayalois');
  $req = $bdd->query('SELECT nb_like FROM posts WHERE id=\''.$id_post.'\'');
  $nb = $req->fetch();
  $nblike = $nb["nb_like"];

  $ok = false;
  $reponse = $bdd->query('SELECT * FROM like_table WHERE profil_like=\''.$id_profil.'\' AND id_post=\''.$id_post.'\'');
  while($rep = $reponse->fetch()){$ok=true;}

  if($ok==false){
    $req = $bdd->query('INSERT INTO like_table(id, id_post, profil_like) VALUES(NULL, \''.$id_post.'\', \''.$id_profil.'\')');
    //UPDATE `derayalois`.`posts` SET `nb_like` = '1' WHERE `posts`.`id` = 3;
    $req = $bdd->query('UPDATE posts SET nb_like=nb_like+1 WHERE id=\''.$id_post.'\'');
    $nblike = $nblike+1;
    echo $nblike.' Likes <i class="fas fa-thumbs-up"></i>';
  }
  if($ok){
    //DELETE FROM `derayalois`.`like_table` WHERE `like_table`.`id` = 8;
    $req = $bdd->query('DELETE FROM like_table WHERE profil_like=\''.$id_profil.'\' AND id_post=\''.$id_post.'\'');
    $req = $bdd->query('UPDATE posts SET nb_like=nb_like-1 WHERE id=\''.$id_post.'\'');
    $nblike = $nblike-1;
    echo $nblike.' Likes <i class="far fa-thumbs-up"></i>';
  }
}





?>
