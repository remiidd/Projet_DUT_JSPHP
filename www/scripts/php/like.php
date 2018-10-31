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

if(($id_post!=null)&&($id_profil!=null)) {
  $bdd = new PDO('mysql:host=lulipa.server.r-heberg.fr;dbname=derayalois;charset=utf8', 'derayalois', 'testdebrayalois');

  $ok = false;
  $reponse = $bdd->query('SELECT * FROM like_table WHERE profil_like=\''.$id_profil.'\' AND id_post=\''.$id_post.'\'');
  while($rep = $reponse->fetch()){}




  $req = $bdd->prepare('INSERT INTO like_table(id, id_post, profil_like) VALUES(NULL, :id_post, :profil_like)');
  $req->execute(array(
    'id_post' => $id_post,
    'profil_like' => $id_profil
  ));
}





?>
