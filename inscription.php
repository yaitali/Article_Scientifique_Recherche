<?php
//faire appelle au fichier qui contient la connexion a notre BDD
require('php/dbConnect.php');
require('php/classe_utilisateur.php'); // faire appelle a la clase utilisateur qui sert a faire les intérracions entre l'utilisateur et çes infos
if(!empty($_POST)){
  extract($_POST);
  $error = false;
  //vérifier que le nom d'utilisateur introduit dans le formulaire n'existe pas dans la BDD
  $sql_test_username = "SELECT * FROM touitos WHERE pseudonyme=?";
  $prepared_test = $db->prepare($sql_test_username);
  $prepared_test->execute(array($username));
  $num_result = $prepared_test->rowCount();
  if($num_result>=1){
    $error = true;
    $error_user = "le nom d'utilisateur que vous avez entrer existe déja !";
  }

  //vérifier que l'email introduit dans le formulaire n'existe pas dans la BDD
  $sql_test_mail = "SELECT * FROM touitos WHERE email=?";
  $prepared_test_mail = $db->prepare($sql_test_mail);
  $prepared_test_mail->execute(array($email));
  $num_result2 = $prepared_test_mail->rowCount();
  if($num_result>=1){
    $error = true;
    $error_mail = "l'email que vous avez entrer existe déja !";
  }
  if(!$error){ // si y'a pas d'erreurs
    //uploader la photo dans le dossier des photos
   $target_Path = 'pictures'; // definir le dossier géneral des fichies
   @$target_Path = $target_Path.'/'.basename( $_FILES['Pic']['name'] );
   @move_uploaded_file( $_FILES['Pic']['tmp_name'], $target_Path ); // pour mettre le fichier dans ça catégorie
    //crée un objet de type User
   $user = new Utilisateur($username,md5($password),$email,$target_Path,$statut);

    //inserer l'utilisateur en utilisant la méthode qu'on a définie :
    $user->insert();
    header("Location: connexion.php");
  }


}//end if (!empty post)
?><!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
      <link rel="stylesheet" href="css/master.css">
    <title>Crée un compte</title>
  </head>
  <body>
    <!-- Formulaire de connexion-->
<div class="errosSignup">
  <?php if(isset($error_user)){echo  $error_user."<br/>";}
             if(isset($error_mail)){echo $error_mail."<br/>";}

   ?>
</div>
    <div class="SignUpForm">


    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
      
      
      <div class="form-group">
       <label for="exampleInputEmail1">Nom D'utilisateur</label>
       <input type="text" class="form-control" name="username" placeholder="Nom d'utilisateur" required>
     </div>
     
      <div class="form-group">
        <label for="exampleInputEmail1">Email</label>
        <input type="email" class="form-control" name="email" placeholder="Votre mail" required>
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Photo de profil</label>
        <input type="file" class="form-control" name="Pic">
      </div>
     
    <div class="form-group">
       <label for="exampleInputEmail1">Statut</label>
       <textarea class="form-control" name="statut" placeholder="partagez un statut" required></textarea>
       
     </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Mot de passe</label>
    <input type="password" class="form-control" name="password" placeholder="Mot de passe" required>
  </div>
  <button type="submit"  class="btn btn-info"   onclick="SoumettreFormulaire();">Enregistrer</button>
  <button type="submit" class="btn btn-info"   onclick="RedirectionJavascript();">Annuler </button>
  <script type="text/javascript">
  function SoumettreFormulaire(){  
    if (confirm ('Voulez vous vraiment valider le formulaire ? ')){
      document.forms["mon_formulaire"].submit();
    }
  }
  
  function RedirectionJavascript(){
        document.location.href="connexion.php";
      }
  
</script>
</form>
</div>
  </body>
</html>
