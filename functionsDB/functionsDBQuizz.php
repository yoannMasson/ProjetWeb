<?php
function QuizzInfo(){
  if (canConnect()){
    include('secure/config.php');
      try{
        $bd = new PDO('mysql:host='.$hote.';dbname='.$dbName.';charset=utf8',$loginLecture,$passLecture);
        $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      }
      catch(Exception $e){
        return $e;
      }
      $req = $bd->prepare("SELECT q.idQuizz,q.nom,q.description FROM users u,quizz q WHERE u.mail = :mail AND u.mdp = :mdp AND q.mail = u.mail");
      $req->execute(array(':mail' => $_COOKIE['mail']
                          ,':mdp' => $_COOKIE['mdp']));
      return $req;
    }
}

function insertInQuizz($nom,$description){
  if(canConnect()){
    include('secure/config.php');
    $mail = trim(htmlentities(htmlspecialchars($_COOKIE['mail'])));
    $nom = trim(htmlentities(htmlspecialchars($nom)));
    $description = trim(htmlentities(htmlspecialchars($description)));
    try{
      $bdd = new PDO('mysql:host='.$hote.';dbname='.$dbName.';charset=utf8',$loginEcriture,$passEcriture);
    }
    catch(Exception $e){
      return $e;
    }
    $req = $bdd->prepare('INSERT INTO quizz(nom,description,mail) VALUES(:nom, :description, :mail)');
    $req->execute(array(
       'mail' => $mail,
       'nom' => $nom,
       'description' => $description
     ));
  }

}

function isInQuizz($nomQuizz){
  include('secure/config.php');
  if(canConnect()){
    $nomQuizz = trim(htmlentities(htmlspecialchars($nomQuizz)));
    try{
      $bdd = new PDO('mysql:host='.$hote.';dbname='.$dbName.';charset=utf8',$loginLecture,$passLecture);
    }
    catch(Exception $e){
      return $e;
    }
    $req = $bdd->prepare('SELECT * from quizz,users where nom = :nomQuizz  and users.mail = quizz.mail');
    $req->execute(array(
       'nomQuizz' => $nomQuizz,
     ));
     return $req->fetch();
  }
 }

 function canModified($idQuizz){
   include('secure/config.php');
   if(canConnect()){
     $idQuizz = trim(htmlentities(htmlspecialchars($idQuizz)));
     try{
       $bdd = new PDO('mysql:host='.$hote.';dbname='.$dbName.';charset=utf8',$loginLecture,$passLecture);
     }
     catch(Exception $e){
       return $e;
     }
     $req = $bdd->prepare('SELECT * from quizz,users where idQuizz = :idQuizz  and users.mail = quizz.mail');
     $req->execute(array(
        'idQuizz' => $idQuizz,
      ));
      return $req->fetch();
   }
  }

  function deleteQuizz($idQuizz){
    include('secure/config.php');
    if(canConnect()){
      $idQuizz = trim(htmlentities(htmlspecialchars($idQuizz)));
      try{
        $bdd = new PDO('mysql:host='.$hote.';dbname='.$dbName.';charset=utf8',$loginEcriture,$passEcriture);
      }
      catch(Exception $e){
        return $e;
      }
      $req = $bdd->prepare('DELETE FROM quizz WHERE idQuizz = :idQuizz');
      $req->execute(array(
         'idQuizz' => $idQuizz,
       ));
    }
   }

   function nbAnswer($nomQuizz){
     include('secure/config.php');
      if(canConnect()){
       $idQuizz = trim(htmlentities(htmlspecialchars($nomQuizz)));
       try{
         $bdd = new PDO('mysql:host='.$hote.';dbname='.$dbName.';charset=utf8',$loginLecture,$passLecture);
       }
       catch(Exception $e){
         return $e;
       }
       $req = $bdd->prepare('SELECT count(*) as nb FROM Reponse r,Quizz q WHERE q.nomQuizz = :nomQuizz AND q.mail = :mail AND q.idQuizz = r.idQuizz' );
       $req->execute(array(
          'nomQuizz' => $nomQuizz,
          ':mail' => $_COOKIE['mail']
        ));
      return $req -> fetch();
      }
   }


?>
