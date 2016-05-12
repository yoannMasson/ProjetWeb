<?php
if(isset($_GET['where']) and $_GET['where']="Reponse"){//On vient de répondre aux questions
  if(canConnect()){//Il faut être connecté
    if(isset($_POST['idQuizz']) and isInQuizz($_POST['idQuizz'])){//Il faut que idQuizz soit set, gare aux petits malins...
      $questions = QuestionInfo($_POST['idQuizz']);
      $i=0;
      foreach ($questions as $question) {
        if(isset($_POST['reponse'.$i])){//L'utilisateur a répondu à cette question
          $reponse = $_POST['reponse'.$i];
          insertInReponse($_POST['texte'.$i],$_POST['idQuizz'],$reponse);
        }
        $i = $i+1;
      }
    }
  }
}

?>
