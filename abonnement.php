
<?php
//subsreibtions here
session_start();
require('php/classe_utilisateur.php');

if(@$_REQUEST['op'] =="add"){
  Utilisateur::AjouterAbonnement($_SESSION['id'],@$_REQUEST['id']);
  header('Location: abn.php');

}

if(@$_REQUEST['op']=="remove"){
  Utilisateur::EffacerAbonnement($_SESSION['id'],@$_REQUEST['id']);
  header('Location: abn.php');
}
?>
