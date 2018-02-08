<?php session_start();
require('php/classe_utilisateur.php');
//cette page est accessible que pour les membres connecté:
if(!isset($_SESSION['username'])){
  header('Location: connexion.php');
}
$subs = Utilisateur::GestionAbonnement($_SESSION['id']);

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

               <div class="Results">
                 <table class="table">
                   <thead>
                     <tr>
                       <th>#</th>
                       <th>Nom D'utilisateur</th>
                       <th>Email</th>
                       <th>Photo</th>
                       <th>Opérations</th>
                      </tr>
                    </thead>
                    <tbody>
                     <?php foreach($subs as $user){ ?>
                      <tr>
                        <th scope="row">1</th>
                        <td><?php echo $user->pseudonyme;?></td>
                        <td><?php  echo $user->email;?></td>
                        <td><img src="<?php  echo $user->photo?>" Title="<?php echo $user->pseudonyme;?>" width="120" height="120" /></td>
                        <td><a href="envoi.php?id=<?php echo $user->id; ?>">Envoyer Message</a> /
                         <a href="profil.php?id=<?php echo $user->id; ?>">Profil</a> /
                        <a href="index.php?id=<?php echo $user->id; ?>">retour </a>/
                        <?php
                        //tester si on n'est pas abboné a cet utilisateur
                        if(Utilisateur::EstAbonner($user->idReceveur,$_SESSION['id'])){
                        ?>
                        <a href="abonnement.php?op=add&id=<?php// echo $FoundUser->id;?>">S'abonner</a></td>
                        <?php }else{ ?>

                          <td><a href="abonnement.php?op=remove&id=<?php echo $user->id;?>">Désabonner</a></td>

                          <?php } ?>
                      </tr>
                      <?php } ?>
                     </tbody>
                   </table>
               </div>

        </div>

     </div><!--Container -->
  </body>
</html>
