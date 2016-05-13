<?php
function insertInQuestion($texte,$idQuizz){

  include('secure/config.php');
  $texte = $texte;
  try{
    $bdd = new PDO('mysql:host='.$hote.';dbname='.$dbName.';charset=utf8',$loginEcriture,$passEcriture);
  }
  catch(Exception $e){
    return $e;
  }
  $req = $bdd->prepare('INSERT INTO question(texte,idQuizz) VALUES(:texte, :idQuizz)');
  $req->execute(array(':texte' => $texte,
                      ':idQuizz' => $idQuizz));
}

function QuestionInfo($idQuizz){ // renvoie les informations de toutes les questions d'un quizz, nécéssite d'être connecté
  if (canConnect()){
    include('secure/config.php');
      try{
        $bd = new PDO('mysql:host='.$hote.';dbname='.$dbName.';charset=utf8',$loginLecture,$passLecture);
        $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      }
      catch(Exception $e){
        return $e;
      }
      $req = $bd->prepare("SELECT * FROM question q WHERE q.idQuizz = :idQuizz");
      $req->execute(array(':idQuizz' => $idQuizz));
      return $req;
    }
}
