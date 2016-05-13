<?php include_once('header.php');
include_once('footer.php');
include_once ('functionsDB/functionsDBUsers.php');
include_once ('functionsDB/functionsDBQuizz.php');
include_once ('functionsDB/functionsDBQuestion.php');
include_once('functionsDB/functionsDBReponse.php');
include_once ('redirection/affichageQuizzRedirection.php');?>
<!DOCTYPE html>
<html>
<head>
  <title>Affichage des quizz</title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <link rel="stylesheet" href="bootstrap/css/bootstrap.css"/>
</head>
<body>
  <h1>Vous pouvez consulter tous les quizz</h1>
  <?php
  include_once ('redirection/affichageQuizzRedirection.php');
  $quizzInfo = AllQuizzInfo();
  foreach ($quizzInfo as $quizz){
    echo '<p>';
    echo '<strong>Nom du propriétaire:</strong> '.$quizz['nomU'].' '.$quizz['prenom'].'</br>';
    echo '<strong>Mail:</strong> '.$quizz['mail'].'</br>';
    echo '<strong>Nom du quizz:</strong> '.$quizz['nomQ'].'</br>';
    echo '<strong>Description:</strong> '.$quizz['description'].'</br>';
    echo '<strong>Nombre de question du quizz:</strong> '.$quizz['nb'].'</br>';
    echo '<strong>Date du quizz:</strong> '.date('d-m-Y',$quizz['date']).'</br>';
    if(canConnect()){
      echo '<a class="btn btn-info btn-sm" href="repondreQuizz.php?idQuizz='.$quizz['idQuizz'].'" role="button">Repondre au quizz</a>';
      echo '<a class="btn btn-info btn-sm" href="affichageReponse.php?idQuizz='.$quizz['idQuizz'].'" role="button">Voir les réponses</a>';
    }else{
      echo '<a class="btn btn-info btn-sm" href="Connection.php" role="button">Connectez-vous pour répondre au quizz</a>';
    }
    echo '</p>';
  }?>
