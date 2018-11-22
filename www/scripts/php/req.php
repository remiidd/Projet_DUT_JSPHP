<?php
echo "salut";
try {
  $bdd = new PDO('mysql:host=lulipa.server.r-heberg.fr;dbname=derayalois;charset=utf8', 'derayalois', 'testdebrayalois');
} catch (\Exception $e) {
  die('Erreur :'.$e->getMessage());
}

if($_GET["id_req"]==0) {
  $req = $bdd->query('UPDATE profil SET email=\''.$_GET["email"].'\' WHERE id=\''.$_GET["id_profil"].'\'');
  $req->closeCursor();
}
?>
