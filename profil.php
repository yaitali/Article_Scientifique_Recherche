<?php session_start();
require('php/classe_utilisateur.php');
//cette page est accessible que pour les membres connecté:
if(!isset($_SESSION['username'])){
  header('Location: connexion.php');
}
if(isset($_REQUEST['id'])){
  $id = $_REQUEST['id'];
}
else{
  $id = $_SESSION['id'];
}
$User = Utilisateur::AfficherProfil($id);
?><!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <link rel="stylesheet" href="css/master.css">

    <title>Projet de programmation web 2016</title>
  </head>
  <body>
     <div class="Container">
      <?php include('php/menu.php'); ?>
        <div class="MainWebsite">

          <div class="Feeds">
                <div class="Profil">
                  <img src="<?php echo $User->photo; ?>" title="<?php $User->pseudonyme; ?>" width="150" height="150" />
                  <h4>Nom D'utilisateur : <?php echo $User->pseudonyme; ?></h4>
                  <h4>Email : <?php echo $User->email; ?></h4>
                  <p>Statut : <?php echo $User->statut; ?></p>
                  <?php if(!isset($_REQUEST['id'])){ ?>
                 <a href="EditerProfil.php?id=<?php echo $id; ?>">Modifier mes infos</a>
                    <?php } ?>
                </div>
          </div><!--Feeds-->


        </div>
     </div><!--Container -->
  </body>
</html>
