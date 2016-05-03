<?php

  function insertInUsers($mail,$mdp,$nom,$prenom){
    $mail = trim(htmlentities(htmlspecialchars($mail)));
    $mdp = md5("!^#!=".(trim(htmlentities(htmlspecialchars($mdp)))));
    $nom = trim(htmlentities(htmlspecialchars($nom)));
    $prenom = trim(htmlentities(htmlspecialchars($prenom)));
    try{
      $bdd = new PDO('mysql:host=localhost;dbname=projetweb;charset=utf8', 'root', "polyweb");
    }
    catch(Exception $e){
      return $e;
    }
    $req = $bdd->prepare('INSERT INTO users(mail, mdp, nom, prenom,nbQuizzDelete) VALUES(:mail, :mdp, :nom, :prenom,0)');
    $req->execute(array(
       'mail' => $mail,
       'mdp' => $mdp,
       'nom' => $nom,
       'prenom' => $prenom,
     ));
  }

  function isInUsers($mail){
    $mail = trim(htmlentities(htmlspecialchars($mail)));
    try{
      $bdd = new PDO('mysql:host=localhost;dbname=projetweb;charset=utf8', 'root', "polyweb");
    }
    catch(Exception $e){
      return $e;
    }
    $req = $bdd->prepare('SELECT mail from users where mail = :mail');
    $req->execute(array(
       'mail' => $mail,
     ));
     while ($donnees = $req->fetch()){
       if( $donnees['mail'] = $mail){
         return true;
       }else{
         return false;
       }}

}



 ?>
