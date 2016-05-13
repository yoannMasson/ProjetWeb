<?php
include_once('footer.php');
include_once('header.php');
include_once('functionsDB/functionsDBUsers.php');
include_once('functionsDB/functionsDBQuizz.php');
include_once('functionsDB/functionsDBQuestion.php');
include_once('redirection/repondreRedirection.php');
?>

<!DOCTYPE html>
<html>
<head>
  <title>Reponse au quizz</title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <link rel="stylesheet" href="bootstrap/css/bootstrap.css"/>
</head>
<body>
  <?php
  $quizz = AllQuizzInfoId($_GET['idQuizz']);
  echo "<h1>Répondre au quizz de ".$quizz['nomU']." ".$quizz['prenom']."</h1>";
  echo "<h2>".$quizz['nomQ']."</h2>";
  echo "<h3>".$quizz['description']."</h3>";

  echo '<form class="form-horizontal" method="post" action="affichageReponse.php?idQuizz='.$_GET['idQuizz'].'&where=Reponse">';
  $questions = QuestionInfo($_GET['idQuizz']);
  $i=0;
  foreach ($questions as $question){
    echo '<p>';
    echo '<strong>question: </strong>'.$question['texte'].'</br>';
    echo '<div class="input-group">
      <input type="text" class="form-control" name="reponse'.$i.'" placeholder="réponse" id="reponse'.$question['texte'].'" >
    </div> </p>';
    echo '<input type="hidden" name="texte'.$i.'" value="'.$question['texte'].'">';
    $i=$i+1;
  }
  echo '<input type="hidden" name="idQuizz" value="'.$_GET['idQuizz'].'">';
  echo '<input type="submit" class="btn btn-success form-control" value="envoyer mes réponses"/>';
  echo '</form>'
  ?>
