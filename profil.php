<?php
include_once('functionsDB/functionsDBUsers.php');
include_once('functionsDB/functionsDBQuizz.php');
if (isset($_GET['where']) AND $_GET['where'] =="Creation"){ //On vient de la création de profil
  if( !isset($_POST['mail']) or $_POST['mail'] == "" or !isset($_POST['mdp1']) or $_POST['mdp1']== "" or !isset($_POST['mdp2']) or $_POST['mdp2']== ""){
      header('Location: CreationCompte.php?message_error=notFull');
      exit;
    }
    if( $_POST['mdp2'] != $_POST['mdp1']){
      header('Location: CreationCompte.php?message_error=pbPass');
      exit;
    }
    if(isInUsers($_POST['mail'])){
      header('Location: CreationCompte.php?message_error=wrongUsers');
      exit;
    }
    try{
      insertInUsers($_POST['mail'],$_POST['mdp1'],$_POST['nom'],$_POST['prenom']);
    }
    catch(Exception $e)
    {
      die('Erreur : '.$e->getMessage());
    }
    setcookie('mail', $_POST['mail'], time() + 365*24*3600, null, null, false, true);
    setcookie('mdp', crypte($_POST['mdp']), time() + 365*24*3600, null, null, false, true);
    header('Location: profil.php');
    exit;

  }elseif (isset($_GET['where']) AND $_GET['where']=="Connection"){//On vient de la page connection
    if(!isset($_POST['mail']) or !isset($_POST['mdp'])){
      header('Location: Connection.php?message_error=infoRequise');
      exit;
    }else{
    setcookie('mail', $_POST['mail'], time() + 365*24*3600);
    setcookie('mdp', crypte($_POST['mdp']), time() + 365*24*3600);
    }
    header('Location: profil.php');
    exit;
  }elseif (isset($_POST['nomQuizz']) and isset($_POST['description'])) {//On vient de la création de Quizz
    if(!isInQuizz($_POST['nomQuizz'])){
      insertInQuizz($_POST['nomQuizz'],$_POST['description']);
    }else{
      $quizzDejaCree = true;
    }
  }

if(!isset($_COOKIE['mail']) or !isset($_COOKIE['mdp'])){ //Dans tous les cas, il faut être connecté pour accéder à son profil
  header('Location: Connection.php?message_error=connectionRequise');
}elseif (!canConnect()) {
  header('Location: Connection.php?message_error=infosErronees');
  exit;
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
  <?php include('header.php'); ?>
  <h1>Bienvenue sur ce site</h1>
  <h2>Vous pouvez consulter votre profil sur cette page</h2>
  <?php
    if (isset($_GET['where']) AND $_GET['where']=="creation"){
      echo "<div class='alert alert-success' role='alert'>
      merci d''avoir crée votre profil
      </div> ";
    }
    if (isset($_GET['message_error']) AND $_GET['message_error']=="suppressionImpossible"){
      echo "<div class='alert alert-danger' role='alert'>
      Vous ne pouvez supprimer ce quizz
      </div> ";
    }
      $donnees = UsersInfo();
      echo '<p>';
      echo 'Mail: '.$donnees['mail'].'</br>';
      echo 'Nom: '.$donnees['nom'].'</br>';
      echo 'Prenom: '.$donnees['prenom'].'</br>';
      echo 'Nombre de quizz supprimés: '.$donnees['nbQuizzDelete'].'</br>';
      $nbQuizz = nbQuizz();
      echo 'Nombre de quizz: '.$nbQuizz['nbQuizz'].'</br>';
      echo '</p>';

      include_once('functionsDB/functionsDBQuizz.php');
      $quizz = QuizzInfo();
      foreach ($quizz as $quizzInfo){
        $reponse = nbAnswer($quizzInfo['idQuizz']);
        echo '<p>';
        echo 'Nom: '.$quizzInfo['nom'].'</br>';
        echo 'Description: '.$quizzInfo['description'].'</br>';
        echo 'Nombre de reponses: '.$reponse['nb'].'</br>';
        echo '<a href="quizz.php?idQuizz='.$quizzInfo['idQuizz'].'" class="elementHeader">Voir le quizz</a>'.'</br>';
        echo '<a class="btn btn-danger" href="destructionQuizz.php?idQuizz='.$quizzInfo['idQuizz'].'" role="button">Supprimer ce quizz</a>';
        echo '</p>';
      }
      ?><a class="btn btn-success" href="creationQuizz.php" role="button">Créer un nouveau quizz</a>

    <?php  include('footer.php');?>
</body>
</html>
