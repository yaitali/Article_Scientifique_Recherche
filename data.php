<?php

session_start();
require('php/classe_utilisateur.php');
require('php/dbConnect.php');
//récupéré les messages

$Inbox = Utilisateur::Afficher_Msg($_SESSION['id']);

foreach($Inbox as $msg){
  //get the author
  $sql_get_user = 'SELECT * FROM touitos WHERE id=?';
  $prepared = $db->prepare($sql_get_user);
  $prepared->execute(array($msg->idAuteur));
  $aut = $prepared->fetchAll(PDO::FETCH_OBJ);

  foreach($aut as $a){
	  
     echo" <div class=\"Messages\" id=\"auto_load_div\">
       <h3>Message Envoyé par :{$a->pseudonyme}</h3>
       <h4>Date d'envoie :{$msg->laDate}</h4>
       <p>{$msg->texte}</p></div>";
  }
  
  
  }
      
?>
