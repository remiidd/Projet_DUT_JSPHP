<?php
  if (isset($_SESSION['idcon'])){
    ?>
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="navbar-brand">
          <a href="index.php" >BananaBook 🍌</a>
        </div>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>


        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <div class="navbar-nav mr-auto">
            <a href="/profil-<?php  echo $donnees['id']?>"></a>
            <i class="fas fa-user"></i>
          </div>
          <div class="navbar-nav my-2 my-lg-0">
            <li class="nav-item active">
              <form class="nav-link"  method="post" action="scripts/php/pre-recherche.php">
                <div class="search-box">
                  <input class="rechin" type="text" name="recherche" placeholder="Rechercher"/>
                  <i class="fas fa-search" ></i>
                  <input id="rechbut" type="submit" value=""/>
                </div>
              </form>
            </li>
            <a class="no_deco_link" href="/messenger"><i class="fas fa-comments"></i></a>
            <form class="formbar" method="post" action="../scripts/php/deconnexion.php">
              <input id="cobout" type="submit" value="Déconnexion"/>
            </form>
          </div>
        </div>
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
