<?php
include('header.php');
if (isset($_GET['where']) AND $_GET['where']=="creation"){ //On vient de la création de profil
  if( !isset($_POST['mail']) or $_POST['mail'] == "" or !isset($_POST['mdp1']) or $_POST['mdp1']== "" or !isset($_POST['mdp2']) or $_POST['mdp2']== ""){
        header('Location: CreationCompte.php?message_error=notFull');
    }
    if( $_POST['mdp2']!=$_POST['mdp1']){
      header('Location: CreationCompte.php?message_error=pbPass');
    }
    if(isInUsers($_POST['mail'])){
      header('Location: CreationCompte.php?message_error=wrongUsers');
    }
    try{
      insertInUsers($_POST['mail'],$_POST['mdp1'],$_POST['nom'],$_POST['prenom']);
    }
    catch(Exception $e)
    {
      die('Erreur : '.$e->getMessage());
    }
  }elseif (isset($_GET['where']) AND $_GET['where']=="connection"){//On vient de la page connection
    if(!isset($_POST['mail']) or !isset($_POST['mdp'])){
      header('Location: Connection.php?message_error=infoRequise');
    }
  }
setcookie('mail', $_POST['mail'], time() + 365*24*3600, null, null, false, true);
setcookie('mdp', crypte($_POST['mdp']), time() + 365*24*3600, null, null, false, true);

if(!isset($_COOKIE['mail']) or !isset($_COOKIE['mail'])){ //Dans tous les cas, il faut être connecté pour accéder à son profil
  header('Location: Connection.php?message_error=connectionRequise');
}elseif (!canConnect($_COOKIE['mail'],$_COOKIE['mdp'])) {
  header('Location: Connection.php?message_error=infosErronees');
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Profil</title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <link rel="stylesheet" href="bootstrap/css/bootstrap.css"/>
</head>
<body>
  <h1>Bienvenue sur ce site</h1>
  <h2>Vous pouvez consulter votre profil sur cette page</h2>
  <?php
  if (isset($_GET['where']) AND $_GET['where']=="creation"){
    echo "<div class='alert alert-success' role='alert'>
    <a href=''# class='alert-link'>merci d''avoir crée votre profil</a>
    </div> ";
  }

  $donnees = UsersInfo();
  echo 'Mail: '.$donnees['mail'].'</br>';
  echo 'Nom: '.$donnees['nom'].'</br>';
  echo 'Prenom: '.$donnees['prenom'].'</br>';
  echo 'Nombre de quizz supprimés: '.$donnees['nbQuizzDelete'].'</br>';
  $nbQuizz = nbQuizz();
  echo 'Nombre de quizz: '.$nbQuizz['nbQuizz'].'</br>';
  echo '</p>';

  include('footer.php'); ?>
</body>
</html>
