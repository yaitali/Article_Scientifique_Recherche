<?php session_start();
require('php/classe_utilisateur.php');
//cette page est accessible que pour les membres connecté:
if(!isset($_SESSION['username'])){
  header('Location: connexion.php');
}

if(!empty($_POST)){
  extract($_POST);
    if(!Utilisateur::recherche($username)){
      $found = false;
      $error_not_found = "Aucun utilisateur n'est trouvé avec ce nom d'utilisateur : ".$username;
    }else{
      $found = true;
      $FoundUser = Utilisateur::recherche($username);
    }
}
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

              <div class="FindUser">
                <div class="Errors">
                   <?php if(@!$found){echo @$error_not_found;} ?>
                </div>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <input type="text" class="form-control" name="username" placeholder="Taper le nom d'utilisateur ici"><br>
                <input type="submit"  value="Trouver" class="btn btn-success">
              </form>
              </div>
              <?php if(@$found){ ?>
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

                      <tr>
                        <th scope="row"></th>
                        <td><?php echo $FoundUser->pseudonyme;?></td>
                        <td><?php  echo $FoundUser->email;?></td>
                        <td><img src="<?php  echo $FoundUser->photo?>" Title="<?php echo $FoundUser->pseudonyme;?>" width="120" height="120" /></td>
                        <td><a href="envoi.php?id=<?php echo $FoundUser->id; ?>">Envoyer Message</a> / <a href="profil.php?id=<?php echo $FoundUser->id; ?>">Profil</a> /<a href="index.php?id=<?php echo $FoundUser->id; ?>">retour à l'aceil</a>
                        <?php
                        //tester si on n'est pas abboné a cet utilisateur
                        if(!Utilisateur::EstAbonner($_SESSION['id'],$FoundUser->id)){
                        ?>
                        <a href="abonnement.php?op=add&id=<?php echo $FoundUser->id;?>">S'abonner</a></td>
                        <?php }else{ ?>
                       

                          <a href="abonnement.php?op=remove&id=<?php echo $FoundUser->id;?>">Désabonner</a></td>

                          <?php } ?>
                      </tr>

                     </tbody>
                   </table>
               </div>
               <?php } ?>
        </div>

     </div><!--Container -->
  </body>
</html>
