<?php include_once('header.php');
include_once('footer.php');
include_once ('functionsDB/functionsDBUsers.php');
include_once ('functionsDB/functionsDBQuizz.php');
include_once ('functionsDB/functionsDBQuestion.php');
include_once('functionsDB/functionsDBReponse.php');?>
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
  $quizzInfo = AllQuizzInfo();
  foreach ($quizzInfo as $quizz){
    echo '<p>';
    echo 'Nom du propriétaire: '.$quizz['nomU'].' '.$quizz['prenom'].'</br>';
    echo 'Mail: '.$quizz['mail'].'</br>';
    echo 'Nom du quizz: '.$quizz['nomQ'].'</br>';
    echo $quizz['description'].'</br>';
    echo 'Nombre de question du quizz: '.$quizz['nb'].'</br>';
    echo 'Date du quizz: '.date('d-m-Y',$quizz['date']).'</br>';
    if(canConnect()){
      echo '<a class="btn btn-info btn-sm" href="repondreQuizz.php?idQuizz='.$quizz['idQuizz'].'" role="button">Repondre au quizz</a>';
    }else{
      echo '<a class="btn btn-info btn-sm" href="connection.php" role="button">Connectez-vous pour répondre au quizz</a>';
    }
    echo '</p>';
  }?>
