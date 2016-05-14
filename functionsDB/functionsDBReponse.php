<?php
function insertInReponse($texte,$idQuizz,$reponse){//Insère une réponse dans le quizz, nécéssite d'être connecté
  include('secure/config.php');
  $texte = $texte;
  $idQuizz = trim(htmlentities(htmlspecialchars($idQuizz)));
  $reponse = trim(htmlentities(htmlspecialchars($reponse)));
  if(canConnect()){
    try{
      $bdd = new PDO('mysql:host='.$hote.';dbname='.$dbName.';charset=utf8',$loginEcriture,$passEcriture);
    }
    catch(Exception $e){
      return $e;
    }
    $req = $bdd->prepare('INSERT INTO reponse(mail,texte,idQuizz,reponse) VALUES(:mail, :texte, :idQuizz, :reponse)');
    $req->execute(array(
       ':mail' => $_COOKIE['mail'],
       ':texte' => $texte,
       ':idQuizz' => $idQuizz,
       ':reponse' => $reponse
     ));
  }
}

 function isInReponse($texte,$idQuizz){//Vérifie si l'utilisateur n'a pas déjà répondu à la question, nécéssite d'être connecté
    if (canConnect()){
      include('secure/config.php');
      $mail = trim(htmlentities(htmlspecialchars($mail)));
      try{
        $bdd = new PDO('mysql:host='.$hote.';dbname='.$dbName.';charset=utf8',$loginLecture,$passLecture);
      }
      catch(Exception $e){
        return $e;
      }
      $req = $bdd->prepare('SELECT * from question where mail = :mail AND texte = :texte AND IdQuizz = :idQuizz');
      $req->execute(array(
         ':mail' => $mail,
         ':texte' => $texte,
         ':idQuizz' => $idQuizz
       ));
       return $req->fetch();
    }
  }

  function reponseInfo($texte,$idQuizz){//Renvoie toutes les réponses pour une question passé en paramètre
    if (canConnect()){
      include('secure/config.php');
      $idQuizz =  trim(htmlentities(htmlspecialchars($idQuizz)));
      try{
        $bdd = new PDO('mysql:host='.$hote.';dbname='.$dbName.';charset=utf8',$loginLecture,$passLecture);
      }
      catch(Exception $e){
        return $e;
      }
      $req = $bdd->prepare('SELECT u.nom,u.prenom,r.texte,r.reponse from reponse r,users u where r.texte = :texte AND r.idQuizz = :idQuizz AND r.mail=u.mail');
      $req->execute(array(
         ':texte' => $texte,
         ':idQuizz' => $idQuizz
       ));
       return $req;
    }
  }

?>
