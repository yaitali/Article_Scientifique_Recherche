<?php
  
  
//faire appelle au fichier qui contien la connexion a notre BDD
session_start();
if(!isset($_SESSION['username'])){
  header('Location: connexion.php');
}
require('php/dbConnect.php');
require('php/classe_utilisateur.php'); // faire appelle a la clase Utilisateur qui sert a faire les intérracions entre l'utilisateur et ses infos
if(isset($_REQUEST['id'])){
  $id = $_REQUEST['id'];
}
$User_infos = Utilisateur::AfficherProfil($id);

if(!empty($_POST)){
  extract($_POST);
  var_dump($_POST);
  $target_Path = 'pictures'; // definir le dossier géneral des fichies
  @$target_Path = $target_Path.'/'.basename( $_FILES['photo']['name'] );
  @move_uploaded_file( $_FILES['photo']['tmp_name'], $target_Path ); // pour mettre le fichier dans ça catégorie
  
 
  Utilisateur::MiseAJours($id,$pseudonyme,$email,$target_Path,$statut);
  header("Location: profil.php");
  

}//end if (!empty post)
?><!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
      <link rel="stylesheet" href="css/master.css">
    <title>editer profil</title>
  </head>
  <body>
    <!-- Formulaire de connexion-->
<div class="errosSignup">
  <?php if(isset($error_user)){echo  $error_user."<br/>";}
             if(isset($error_mail)){echo $error_mail."<br/>";}

   ?>
</div>
    <div class="SignUpForm">

   <?php if(!empty($User_infos)){ ?>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
    
    <div class="form-group">
       <label for="exampleInputPseudonyme">Nom D'utilisateur</label>
       <input type="text" class="form-control" name="pseudonyme" placeholder="Nom d'utilisateur" value="<?php echo $User_infos->pseudonyme; ?>" required>
     </div>
     
      <div class="form-group">
        <label for="exampleInputEmail1">Email</label>
        <input type="email" class="form-control" name="email" placeholder="Votre email" value="<?php echo $User_infos->email; ?>" required>
      </div>
      
      <div class="form-group">
        <label for="exampleInputPassword1">Photo de profil</label>
        <input type="file" class="form-control" name="photo" placeholder="photo de profil" required>
      </div>
     <div class="form-group">
       <label for="exampleInputEmail1">Statut</label>
        <textarea class="form-control" name="statut" placeholder="partagez un statut"  value="<?php echo $User_infos->statut; ?>" required></textarea>
       
     </div>
  
  <input type="text" hidden name="id" value="<?php echo $id; ?>">
  <button type="submit" class="btn btn-info">Mettre a jour</button>
</form>
<?php  }?>
</div>
  </body>
</html>
