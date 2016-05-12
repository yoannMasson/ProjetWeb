<?php
if(isset($_GET['where']) and $_GET['where']="Reponse"){//On vient de répondre aux questions
  if(canConnect()){//Il faut être connecté
    if(isset($_POST['idQuizz']) and isInQuizz($_POST['idQuizz'])){//Il faut que idQuizz soit set, gare aux petits malins...
      $questions = QuestionInfo($_POST['idQuizz']);
      foreach ($questions as $question) {
        if(isset($_POST[trim(htmlentities(htmlspecialchars($question['texte'])))])){//L'utilisateur a répondu à cette question
          $reponse = $_POST[$question['texte']];
          echo $question['texte'].$_POST['idQuizz'].$reponse.'</br>';
          insertInReponse($question['texte'],$_POST['idQuizz'],$reponse);
        }
      }

    }
  }
}

?>
