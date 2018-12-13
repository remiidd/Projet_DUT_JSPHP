<?php
  session_start();
  if (isset($_SESSION['idcon'])){
    ?>
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="navbar-brand">
          <a href="/accueil" >BananaBook 🍌</a>
        </div>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>


        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <div class="navbar-nav mr-auto">
            <a class="no_deco_link" href="/profil-<?php  echo $_SESSION['idcon']?>">
              <i class="fas fa-user"></i>
            </a>
          </div>
          <div class="navbar-nav my-2 my-lg-0">
            <li class="nav-item active">
              <form class="nav-link"  method="post" action="scripts/php/pre-recherche.php">
                <div class="search-box">
                  <input id="rechin_id" class="rechin" type="text" name="recherche" placeholder="Rechercher"/>
                  <i class="fas fa-search" ></i>
                  <input id="rechbut" type="submit" value=""/>
                </div>
              </form>
            </li>
            <a id="invitation_i" class="no_deco_link" href="/invitation">
              <i class="fas fa-user-friends"></i>
              <?php
              try{
                $bdd = new PDO('mysql:host=lulipa.server.r-heberg.fr;dbname=derayalois;port=3306;charset=utf8', 'derayalois', 'testdebrayalois');
              }
              catch (Exception $e){
                    die('Erreur : ' . $e->getMessage());
              }
              $moi = $_SESSION['idcon'];
              $reponse = $bdd->query("SELECT COUNT(*) as nb_demande FROM amis WHERE `id`=$moi AND statut=\"demande\"");
              $donnees = $reponse->fetch();
              if($donnees['nb_demande']!= 0){
              ?>
                <span id="notification_count_menu_invit"><?php echo $donnees['nb_demande']; ?></span>
              <?php } ?>
            </a>
            <a id="messenger_i" class="no_deco_link" href="/messenger">
              <i class="fas fa-comments"></i>
              <?php
              try{
                $bdd = new PDO('mysql:host=lulipa.server.r-heberg.fr;dbname=derayalois;port=3306;charset=utf8', 'derayalois', 'testdebrayalois');
              }
              catch (Exception $e){
                    die('Erreur : ' . $e->getMessage());
              }
              $moi = $_SESSION['idcon'];
              $reponse = $bdd->query("SELECT COUNT(*) as notif
                                      FROM message
                                      WHERE id_dest=$moi AND vu=0");
              $donnees = $reponse->fetch();
              if($donnees['notif']!= 0){
              ?>
                <span id="notification_count_menu"><?php echo $donnees['notif']; ?></span>
              <?php } ?>
            </a>
            <form class="formbar" method="post" action="../scripts/php/deconnexion.php">
              <input id="cobout" type="submit" value="Déconnexion"/>
            </form>
          </div>
        </div>
        <div id="notificationContainer">
  			<div id="notificationTitle">Notifications</div>
  			<div id="notificationsBody" class="notifications"></div>
  			<div id="notificationFooter"><a href="#">See All</a></div>
        <script src="scripts/js/notif.js"></script>
        <script src="/scripts/js/recherche.js"></script>
      </nav>
    <?php
  }
  else{
    ?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="navbar-brand">
        <a href="index.php" >BananaBook 🍌</a>
      </div>

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>


      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <div class="navbar-nav mr-auto"></div>
        <div class="navbar-nav my-2 my-lg-0">
          <form class="formbar" method="post" action="connexion.php">
            <input id="cobout" type="submit" value="Connexion"/>
          </form>
        </div>
      </div>
    </nav>
    <?php
  }
?>
