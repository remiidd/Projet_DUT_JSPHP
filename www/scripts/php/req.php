<?php
if($_GET["id_req"]==0) {
  $req = $bdd->query('UPDATE profil SET email=\''.$_GET["email"].'\' WHERE id=\''.$_GET["id_profil"].'\'');
  $req->closeCursor();
}
?>
