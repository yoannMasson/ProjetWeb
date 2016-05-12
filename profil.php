<?php
include_once('functionsDB/functionsDBUsers.php');
include_once('functionsDB/functionsDBQuizz.php');
include_once('redirection/profilRedirection.php');
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
    include_once('functionsError/profilError.php');
      $donnees = UsersInfo();
      echo '<p>';
      echo 'mail: '.$donnees['mail'].'</br>';
      echo 'Nom: '.$donnees['nom'].'</br>';
      echo 'Prenom: '.$donnees['prenom'].'</br>';
      echo 'Nombre de quizz supprimés: '.$donnees['nbQuizzDelete'].'</br>';
      $nbQuizz = nbQuizz();
      echo 'Nombre de quizz: '.$nbQuizz['nbQuizz'].'</br>';
      echo '</p>';

      include_once('functionsDB/functionsDBQuizz.php');
      $quizz = QuizzInfo();
      foreach ($quizz as $quizzInfo){
        $reponse = nbQuestion($quizzInfo['idQuizz']);
        echo '<p>';
        echo 'Nom: '.$quizzInfo['nom'].'</br>';
        echo 'Description: '.$quizzInfo['description'].'</br>';
        echo 'Date du quizz: '.date('d-m-Y', $quizzInfo['date']).'</br>';
        echo 'Nombre de questions: '.$reponse['nb'].'</br>';
        echo 'Lien à donner pour répondre au quizz: <a href="repondreQuizz.php?idQuizz='.$quizzInfo['idQuizz'].'">repondreQuizz.php?idQuizz='.$quizzInfo['idQuizz'].'</a></br>';
        echo '<a class="btn btn-info" href="quizz.php?idQuizz='.$quizzInfo['idQuizz'].'" role="button">Voir le quizz</a>';
        echo '</p>';
      }
      ?><a class="btn btn-success" href="creationQuizz.php" role="button">Créer un nouveau quizz</a>

    <?php  include('footer.php');?>
</body>
</html>
