<?php session_start();
if(!isset($_SESSION['username'])){
  header('Location: connexion.php');
}
require("php/classe_utilisateur.php");
require('php/dbConnect.php');

if(isset($_REQUEST['id'])){
  $idDest = $_REQUEST['id'];
  $destination = Utilisateur::AfficherProfil($idDest);
}
if(!empty($_POST)){

  extract($_POST);
  $sql_test_user = "SELECT * FROM touitos WHERE pseudonyme=?";
  $prep = $db->prepare($sql_test_user);
  $prep->execute(array($Destination));
  $res = $prep->rowCount();
  if($res == 0){
    $error = true;
    $error_user = "L'utilisateur que vous avez introduit est introvuable";
  }
  else{
    $result = $prep->fetchAll(PDO::FETCH_OBJ);
    foreach($result as $res){
      $iddest = $res->id;
    Utilisateur::Envoi_Msg($_SESSION['id'],$iddest,$msg_content);
    header('Location: index.php');
    }
  }

}
//cette page est accessible que pour les membres connecté:
if(!isset($_SESSION['username'])){
  header('Location: connexion.php');
}
?><!DOCTYPE html>
<html>
  <head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
    <script type="text/javascript">

    </script>
    <meta charset="utf-8">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <link rel="stylesheet" href="css/master.css">

    <title>Envoyer un message</title>
  </head>
  <body>
     <div class="Container">
        <?php include('php/menu.php'); ?>
        <div class="MainWebsite">
          <div class="MsgForm">
             <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <div class="form-group">
                   <label for="exampleInputEmail1">Destinataire</label>
                   <input type="text" value="<?php if(isset($destination)){echo $destination->pseudonyme;} ?>" class="form-control" name="Destination" placeholder="nom du destinataire ">
                </div>
               <div class="form-group">
                 <label for="exampleInputPassword1">Titre du message</label>
                 <input type="text" class="form-control" name="obj message" placeholder="objet du message">
               </div>
               <div class="form-group">
                 <label for="exampleInputPassword1">Contenu du message</label>
                     <textarea class="form-control txtar" name="msg_content" rows="7"></textarea>
               </div>
        <button type="submit" class="btn btn-info">Envoyer</button>
      </form>
      </div>
        </div>
     </div><!--Container -->
  </body>
</html>

