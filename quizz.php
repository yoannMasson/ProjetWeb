<?php
include_once('functionsDB/functionsDBUsers.php');
include_once('functionsDB/functionsDBQuizz.php');
include_once('functionsDB/functionsDBQuestion.php');
include_once('redirection/quizzRedirection.php');
?>
<!DOCTYPE html>
<html>
<head>
  <title>Quizz</title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <link rel="stylesheet" href="bootstrap/css/bootstrap.css"/>
</head>

<body>
  <?php include('header.php'); ?>
  <h2>Ici vous pouvez gérer votre quizz</h2>
  <?php
      $quizzInfo = QuizzInfoId($_GET['idQuizz']);
      $reponse = nbQuestion($_GET['idQuizz']);
      echo '<p>';
      echo 'Nom: '.$quizzInfo['nom'].'</br>';
      echo 'Description: '.$quizzInfo['description'].'</br>';
      echo 'Date du quizz: '.date('d-m-Y', $quizzInfo['date']).'</br>';
      echo 'Nombre de questions: '.$reponse['nb'].'</br>';
      echo '<a class="btn btn-danger" href="destructionQuizz.php?idQuizz='.$quizzInfo['idQuizz'].'" role="button">Supprimer ce quizz</a>';
      echo '</p>';

      $questions = QuestionInfo($_GET['idQuizz']);
      foreach ($questions as $question){
        $reponse = nbQuestion($question['idQuizz']);
        echo '<p>';
        echo 'question: '.$question['texte'];
        echo '<a class="btn btn-info btn-sm" href="reponse.php?idQuizz='.$question['idQuizz'].'&texte='.$question['texte'].'" role="button">Voir les réponses</a>';
        echo '</p>';
      }

      include('footer.php');?>

      <form method="post" action=<?php echo "quizz.php?idQuizz=".$_GET['idQuizz'];?>>
        <div class="input-group">
          <span class="input-group-addon" id="basic-addon3">question</span>
          <input type="text" class="form-control" name="texte" placeholder="question" id="texte" >
        </div>

      <input class="btn btn-success" type="submit" value="Rajouter une question" />

</body>
</html>
