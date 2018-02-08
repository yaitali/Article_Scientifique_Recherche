<?php
//faire appelle au fichier qui contien la connexion a notre BDD
session_start();
require('php/dbConnect.php');
if(!empty($_POST)){
  extract($_POST);
  //1- définie les messages d'erreur a affiché en cas ou on a trouvé une erreur
  $error_username = "Le Nom D'utilisateur est Incorrect !";
  $error_password = "Le Mot de passe est Incorrect !";
  //2- crée 2 variables booleéns
  $error = false;
	$logged = true;

  //3- vérifier d'abbord si le nom d'utilisateur existe dans la BDD
  $user_test_sql = "SELECT * FROM touitos WHERE pseudonyme=?";
	$user_test = $db->prepare($user_test_sql);
	$user_test->execute(array($username));
	$num_res = $user_test->rowCount();
  if ($num_res==0) {
    $error = true;
    $logged = false;
    $errur_user = " Nom d'Utilisateur Incorrect ! essaye une aure fois ";
  }else{
   foreach ($user_test as $users) {
     $dbpass = $users['motPasse'];
     if (md5($password) != $dbpass) {
       $error = true;
       $logged = false;
       $errur_pass = "password incorrect !";
     }//end if passwrd = $dbpass
   }//end foreash
 }//end else
  if ($logged) {
      $_SESSION['username'] = $username;
      $sql_id = "SELECT * FROM  touitos WHERE pseudonyme=?";
      $prep = $db->prepare($sql_id);
      $prep->execute(array($username));
      $res = $prep->fetchAll(PDO::FETCH_OBJ);
      foreach($res as $ids){
        $_SESSION['id'] = $ids->id;
      }
     

     header('location:index.php');
  }


}//end if (!empty post)
?><!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
      <link rel="stylesheet" href="css/master.css">
    <title>S'authentifier</title>
  </head>
  <body>
    <!-- Formulaire de connexion-->
<div class="erros">
  <?php if(isset($errur_user)){echo $errur_user."<br/>";}
             if(isset($error_password)){echo $error_password."<br/>";}

   ?>
</div>
    <div class="LoginForm">


    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
     <div class="form-group">
       <label for="exampleInputEmail1">Nom D'utilisateur</label>
       <input type="text" class="form-control" name="username" placeholder="Nom d'utilisateur">
     </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Mot de passe</label>
    <input type="password" class="form-control" name="password" placeholder="Mot de passe">
  </div>
   <a href="inscription.php">Crée un compte</a><br>
  
  <button type="submit" class="btn btn-info">Connecter</button>
</form>
</div>
  </body>
</html>
