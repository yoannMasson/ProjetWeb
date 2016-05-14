<?php
function QuizzInfo(){ // renvoie les informations de tous les quizz d'un utilisateurs, nécéssite d'être connecté
  if (canConnect()){
    include('secure/config.php');
      try{
        $bd = new PDO('mysql:host='.$hote.';dbname='.$dbName.';charset=utf8',$loginLecture,$passLecture);
        $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      }
      catch(Exception $e){
        return $e;
      }
      $req = $bd->prepare("SELECT q.idQuizz,q.nom,q.description,q.date FROM users u,quizz q WHERE u.mail = :mail AND u.mdp = :mdp AND q.mail = u.mail");
      $req->execute(array(':mail' => $_COOKIE['mail']
                          ,':mdp' => $_COOKIE['mdp']));
      return $req;
    }
}



function AllQuizzInfo(){ // renvoie les informations sur les quizzs, le nombre de réponses et sur l'utilisateur, nécéssite d'être connecté
  include('secure/config.php');
    try{
      $bd = new PDO('mysql:host='.$hote.';dbname='.$dbName.';charset=utf8',$loginLecture,$passLecture);
      $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(Exception $e){
      return $e;
    }
    $req = $bd->prepare("SELECT u.nom AS nomU,u.prenom,u.mail,q.nom AS nomQ,q.description,q.date,q.idQuizz,count(*) as nb FROM users u,quizz q,question WHERE q.mail = u.mail and question.idQuizz=q.idQuizz
                        group by nomU,u.prenom,u.mail,nomQ,q.description,q.date,q.idQuizz order by q.date DESC");
    $req->execute(array());
    return $req;
}


function QuizzInfoId($idQuizz){ // renvoie les informations de ce quizz et de l'utilisateur concerné
    include('secure/config.php');
      try{
        $bd = new PDO('mysql:host='.$hote.';dbname='.$dbName.';charset=utf8',$loginLecture,$passLecture);
        $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      }
      catch(Exception $e){
        return $e;
      }
      $req = $bd->prepare("SELECT q.idQuizz,q.date,q.nom as nomQ,q.description,u.mail,u.nom as nomU, u.prenom FROM quizz q,users u WHERE q.mail = u.mail AND q.idQuizz = :idQuizz");
      $req->execute(array(':idQuizz' => $idQuizz));
      return $req->fetch();
    }

function AllQuizzInfoId($idQuizz){ // renvoie les informations de ce quizz
    include('secure/config.php');
      try{
        $bd = new PDO('mysql:host='.$hote.';dbname='.$dbName.';charset=utf8',$loginLecture,$passLecture);
        $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      }
      catch(Exception $e){
        return $e;
      }
      $req = $bd->prepare("SELECT u.nom AS nomU,u.prenom,u.mail,q.nom AS nomQ,q.description,q.date,q.idQuizz,count(*) as nb FROM users u,quizz q,question WHERE q.mail = u.mail
                          and q.idQuizz = :idQuizz AND question.idQuizz=q.idQuizz group by nomU,u.prenom,u.mail,nomQ,q.description,q.date,q.idQuizz");
      $req->execute(array(':idQuizz' => $idQuizz));
      return $req->fetch();
    }

function insertInQuizz($nom,$description){ //Insère un quizz, nécéssite d'être connecté
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
    $req = $bdd->prepare('INSERT INTO quizz(nom,description,mail,date) VALUES(:nom, :description, :mail,'.time().')');
    $req->execute(array(
       ':mail' => $mail,
       ':nom' => $nom,
       ':description' => $description
     ));
  }

}

function isInQuizzUsers($nomQuizz){//Dit si l'utilisateur a déjà crée ce quizz, nécéssite d'être connecté
  include('secure/config.php');
  if(canConnect()){
    $nomQuizz = trim(htmlentities(htmlspecialchars($nomQuizz)));
    try{
      $bdd = new PDO('mysql:host='.$hote.';dbname='.$dbName.';charset=utf8',$loginLecture,$passLecture);
    }
    catch(Exception $e){
      return $e;
    }
    $req = $bdd->prepare('SELECT * from quizz,users where nom = :nomQuizz  and users.mail = quizz.mail and users.mail = :mail');
    $req->execute(array(
       ':nomQuizz' => $nomQuizz,
       ':mail' => $_COOKIE['mail']
     ));
     return $req->fetch();
  }
 }

 function isInQuizz($idQuizz){//Dit si l'idQuizz existe
   include('secure/config.php');
   if(canConnect()){
     $idQuizz = trim(htmlentities(htmlspecialchars($idQuizz)));
     try{
       $bdd = new PDO('mysql:host='.$hote.';dbname='.$dbName.';charset=utf8',$loginLecture,$passLecture);
     }
     catch(Exception $e){
       return $e;
     }
     $req = $bdd->prepare('SELECT * from quizz where idQuizz = :idQuizz ');
     $req->execute(array(
        ':idQuizz' => $idQuizz,
      ));
      return $req->fetch();
   }
  }

 function belongsTo($idQuizz){//Dit si le quizz appartient à l'utilisateur, nécéssite d'être connecté
   include('secure/config.php');
   if(canConnect()){
     $idQuizz = trim(htmlentities(htmlspecialchars($idQuizz)));
     try{
       $bdd = new PDO('mysql:host='.$hote.';dbname='.$dbName.';charset=utf8',$loginLecture,$passLecture);
     }
     catch(Exception $e){
       return $e;
     }
     $req = $bdd->prepare('SELECT * from quizz,users where idQuizz = :idQuizz  and users.mail = quizz.mail and quizz.mail = :mail');
     $req->execute(array(
        'idQuizz' => $idQuizz,
        ':mail' => $_COOKIE['mail']
      ));
      return $req->fetch();
   }
  }

  function deleteQuizz($idQuizz){//Supprime un quizz, nécéssite d'être connecté et de posséder le quizz
    include('secure/config.php');
    if(canConnect() and belongsTo($idQuizz)){
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

   function nbQuestion($idQuizz){
     include('secure/config.php');
      if(canConnect()){
       $idQuizz = trim(htmlentities(htmlspecialchars($idQuizz)));
       try{
         $bdd = new PDO('mysql:host='.$hote.';dbname='.$dbName.';charset=utf8',$loginLecture,$passLecture);
       }
       catch(Exception $e){
         return $e;
       }
       $req = $bdd->prepare('SELECT count(*) as nb FROM question ,quizz  WHERE quizz.idQuizz = question.idQuizz AND quizz.idQuizz = :idQuizz' );
       $req->execute(array(
          ':idQuizz' => $idQuizz
        ));
      return $req -> fetch();
      }
    }


   function nbAnswerId($idQuizz){//Renvoie le nombre de reponse d'un quizz
     include('secure/config.php');
       $idQuizz = trim(htmlentities(htmlspecialchars($idQuizz)));
       try{
         $bdd = new PDO('mysql:host='.$hote.';dbname='.$dbName.';charset=utf8',$loginLecture,$passLecture);
       }
       catch(Exception $e){
         return $e;
       }
       $req = $bdd->prepare('SELECT count(DISTINCT mail) as nb FROM reponse r  WHERE r.idQuizz = :idQuizz');
       $req->execute(array(
          ':idQuizz' => $idQuizz
        ));
      return $req -> fetch();
      }



?>
