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
      echo '<strong>mail:</strong> '.$donnees['mail'].'</br>';
      echo '<strong>Nom:</strong> '.$donnees['nom'].'</br>';
      echo '<strong>Prenom: </strong>'.$donnees['prenom'].'</br>';
      echo '<strong>Nombre de quizz supprimés:</strong> '.$donnees['nbQuizzDelete'].'</br>';
      $nbQuizz = nbQuizz();
      echo '<strong>Nombre de quizz:</strong> '.$nbQuizz['nbQuizz'].'</br>';
      echo '</p>';

      include_once('functionsDB/functionsDBQuizz.php');
      $quizz = QuizzInfo();
      foreach ($quizz as $quizzInfo){
        $nbAnswer = nbAnswerId($quizzInfo['idQuizz']);
        $reponse = nbQuestion($quizzInfo['idQuizz']);
        echo '<p>';
        echo '<strong>Nom:</strong> '.$quizzInfo['nom'].'</br>';
        echo '<strong>Description:</strong> '.$quizzInfo['description'].'</br>';
        echo '<strong>Date du quizz:</strong> '.date('d-m-Y', $quizzInfo['date']).'</br>';
        echo '<strong>Nombre de questions:</strong> '.$reponse['nb'].'</br>';
        echo '<strong>Nombre total de reponse:</strong> '.$nbAnswer['nb'].'</br>';
        echo '<strong>Lien à donner pour répondre au quizz:</strong> <a href="http://projetwebmasson.herokuapp.com/repondreQuizz.php?idQuizz='.$quizzInfo['idQuizz'].'">http://projetwebmasson.herokuapp.com/repondreQuizz.php?idQuizz='.$quizzInfo['idQuizz'].'</a></br>';
        echo '<a class="btn btn-info" href="quizz.php?idQuizz='.$quizzInfo['idQuizz'].'" role="button">Voir le quizz</a>';
        echo '<a class="btn btn-info btn-sm" href="affichageReponse.php?idQuizz='.$quizzInfo['idQuizz'].'" role="button">Voir les réponses</a>';
        echo '</p>';
      }
      ?><a class="btn btn-success" href="creationQuizz.php" role="button">Créer un nouveau quizz</a>

    <?php  include('footer.php');?>
</body>
</html>
