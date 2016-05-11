<?php
  if (isset($_GET['message_error']) AND $_GET['message_error']=="infosErronees") {
    echo "<div class='alert alert-danger' role='alert'>
    Désolé, ce compte et/ou ce mot de passe n'existent pas
    </div> ";
  }elseif(isset($_GET['message_error']) AND $_GET['message_error']=="infoRequise") {
    echo "<div class='alert alert-danger' role='alert'>
    Merci de bien vouloir remplir tous les champs
    </div> "; }
    elseif(isset($_GET['message_error']) AND $_GET['message_error']=="connectionRequise") {
      echo "<div class='alert alert-danger' role='alert'>
      Vous devez être connecter pour accéder à la page précédente
      </div> "; }
   ?>
