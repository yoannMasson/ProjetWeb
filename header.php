<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <?php
    include_once('functionsDB/functionsDBUsers.php');
    $info = UsersInfo();
    echo '<a href="profil.php" class="elementHeader">Profil'.' '.$info['nom'].' '.$info['prenom'].'</a>';?>
    <ul class="navbar-right">
      <a href="CreationCompte.php" class="elementHeader">Créer un compte /</a>
      <?php
       if(isset($_COOKIE['mail']) and isset($_COOKIE['mdp']) and canConnect($_COOKIE['mail'],$_COOKIE['mdp'])){
        echo '<a href="Deconnection.php"class="elementHeader text-right">Se deconnecter</a>';
      }else{
        echo '<a href="Connection.php"class="elementHeader  text-right">Connection</a>';
      } ?>
  </ul>
  </div>
</nav>
