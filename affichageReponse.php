<?php include_once('header.php');
include_once('footer.php');
include_once ('functionsDB/functionsDBUsers.php');
include_once ('functionsDB/functionsDBQuizz.php');
include_once ('functionsDB/functionsDBQuestion.php');
include_once('functionsDB/functionsDBReponse.php');
include_once ('redirection/affichageReponseRedirection.php');?>
<!DOCTYPE html>
<html>
<head>
  <title>Affichage des reponses</title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <link rel="stylesheet" href="bootstrap/css/bootstrap.css"/>
</head>
<body>
  <h1>Vous pouvez consulter ici toutes les réponses du quizz</h1>
  <?php
  $nbAnswer = nbAnswerId($_GET['idQuizz']);
  $quizz = QuizzInfoId($_GET['idQuizz']);
    echo '<p>';
    echo '<strong>Nom du propriétaire:</strong> '.$quizz['nomU'].' '.$quizz['prenom'].'</br>';
    echo '<strong>Mail:</strong> '.$quizz['mail'].'</br>';
    echo '<strong>Nom du quizz:</strong> '.$quizz['nomQ'].'</br>';
    echo '<strong>Description:</strong> '.$quizz['description'].'</br>';
    echo '<strong>Nombre total de reponse: </strong>'.$nbAnswer['nb'].'</br>';
    echo '<strong>Date du quizz: </strong>'.date('d-m-Y',$quizz['date']).'</br>';
    echo '</p>';

    $questions = QuestionInfo($_GET['idQuizz']);
    foreach ($questions as $question){
      echo '<p>';
      echo '<div class="panel panel-primary">';
      echo '<div class="panel-heading">
              <h4 class="panel-title"><strong>question:</strong> '.$question['texte'].'</br></h4>
          </div>';
      $reponses = reponseInfo($question['texte'],$_GET['idQuizz']);
      foreach ($reponses as $reponse) {
        echo '<em>( '.$reponse['nom'].' '.$reponse['prenom'].' ):</em>'.$reponse['reponse'].'</br>';
      }
      echo'</div>';
    }
    ?>
  </body>
</html>
