<?php


  function insertInUsers($mail,$mdp,$nom,$prenom){//Ajoute un utilisateur
    include('secure/config.php');
    $mail = trim(htmlentities(htmlspecialchars($mail)));
    $mdp = crypte((trim(htmlentities(htmlspecialchars($mdp)))));
    $nom = trim(htmlentities(htmlspecialchars($nom)));
    $prenom = trim(htmlentities(htmlspecialchars($prenom)));
    try{
      $bdd = new PDO('mysql:host='.$hote.';dbname='.$dbName.';charset=utf8',$loginEcriture,$passEcriture);
    }
    catch(Exception $e){
      return $e;
    }
    $req = $bdd->prepare('INSERT INTO users(mail, mdp, nom, prenom,nbQuizzDelete) VALUES(:mail, :mdp, :nom, :prenom,0)');
    $req->execute(array(
       ':mail' => $mail,
       ':mdp' => $mdp,
       ':nom' => $nom,
       ':prenom' => $prenom,
     ));
  }


  function isInUsers($mail){//Vérifie si l'utilisateur est déjà dans la base
    include('secure/config.php');
    $mail = trim(htmlentities(htmlspecialchars($mail)));
    try{
      $bdd = new PDO('mysql:host='.$hote.';dbname='.$dbName.';charset=utf8',$loginLecture,$passLecture);
    }
    catch(Exception $e){
      return $e;
    }
    $req = $bdd->prepare('SELECT mail from users where mail = :mail');
    $req->execute(array(
       ':mail' => $mail,
     ));
     return $req->fetch();
   }

function canConnect(){//Vérifie si l'utilisateur peut se connecter avec les informations présentes dans le cookie
  if(!isset($_COOKIE['mail']) or !isset($_COOKIE['mail'])){
    return false;
  }else{
    include('secure/config.php');
      try{
        $bd = new PDO('mysql:host='.$hote.';dbname='.$dbName.';charset=utf8',$loginLecture,$passLecture);
        $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      }
      catch(Exception $e){
        return $e;
      }
      $req = $bd->prepare("SELECT * FROM users u WHERE u.mail = :mail AND mdp = :mdp");
      $req->execute(array(':mail' => $_COOKIE['mail'], ':mdp' => $_COOKIE['mdp']));
      return $req->fetch();
  }
}


function crypte($mdp){//Crypte un mot de passe
  return (md5("!^#!=".$mdp));
}

  function UsersInfo(){//Renvoie les informations de l'utilisateur, nécéssite d'être connecté
  if (canConnect()){
    include('secure/config.php');
      try{
        $bd = new PDO('mysql:host='.$hote.';dbname='.$dbName.';charset=utf8',$loginLecture,$passLecture);
        $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      }
      catch(Exception $e){
        return $e;
      }
      $req = $bd->prepare("SELECT u.mail,u.nom,prenom,nbQuizzDelete FROM users u WHERE u.mail = :mail ");
      $req->execute(array(':mail' => $_COOKIE['mail']));
      return $req->fetch();
    }
  }

  function nbQuizz(){//Renvoie le nombre de quizz de l'utilisateur, nécéssite d'être connecté
    if (canConnect()){
      include('secure/config.php');
        try{
          $bd = new PDO('mysql:host='.$hote.';dbname='.$dbName.';charset=utf8',$loginLecture,$passLecture);
          $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(Exception $e){
          return $e;
        }
        $req = $bd->prepare("SELECT count(*) as nbQuizz FROM quizz q WHERE q.mail = :mail ");
        $req->execute(array(':mail' => $_COOKIE['mail']));
        return $req->fetch();
    }
  }

 ?>