<?php
//code déconnexion 
session_start();
if(isset($_SESSION['username'])){
  session_destroy();
  header('Location: connexion.php');
}
?>
