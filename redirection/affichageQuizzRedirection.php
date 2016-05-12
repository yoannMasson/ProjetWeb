<?php
if(isset($_GET['where']) and $_GET['where']="Reponse"){//On vient de répondre aux questions
  if(canConnect()){//Il faut être connecté
    if(isset($_POST['idQuizz']) and isInQuizz($_POST['idQuizz'])){//Il faut que idQuizz soit set, gare aux petits malins...
      echo "idquizz reçu: ".$_POST['idQuizz']."</br>";
      $questions = QuestionInfo($_POST['idQuizz']);
      foreach ($questions as $question) {
        echo "test if sur isset: ".$question['texte'];
        $test = $_POST[$question['texte']];
        if(isset($texte)){//L'utilisateur a répondu à cette question
          echo "test du $ post: ".$_POST[trim(htmlentities(htmlspecialchars($question['texte'])))]."</br>";
          $reponse = $_POST[$question['texte']];
          echo "test de la réponse".$reponse;
          echo $question['texte'].$_POST['idQuizz'].$reponse.'</br>';
          insertInReponse($question['texte'],$_POST['idQuizz'],$reponse);
        }else{
          echo"La question n'existerait pas, ".$question['texte'];
        }
      }

    }
  }
}

?>
