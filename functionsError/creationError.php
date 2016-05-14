<?php
if (isset($_GET['message_error']) AND $_GET['message_error']=="notFull"){
  echo "<div class='alert alert-danger' role='alert'>
  <a href=''# class='alert-link'>merci de remplir tous les champs</a>
  </div> ";}
  elseif (isset($_GET['message_error']) AND $_GET['message_error']=="pbPass") {
    echo "<div class='alert alert-danger' role='alert'>
    <a href=''# class='alert-link'>Merci de bien confirmer le mot de passe</a>
    </div> ";
  }elseif (isset($_GET['message_error']) AND $_GET['message_error']=="wrongUsers") {
    echo "<div class='alert alert-danger' role='alert'>
    <a href=''# class='alert-link'>E-mail déjà utilisée</a>
    </div> ";
  }elseif (isset($_GET['message_error']) AND $_GET['message_error']=="wrongEmail") {
    echo "<div class='alert alert-danger' role='alert'>
    <a href=''# class='alert-link'>E-mail non valide</a>
    </div> ";
    }
  ?>
