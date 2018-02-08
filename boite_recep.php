<?php session_start();
require('php/classe_utilisateur.php');
//cette page est accessible que pour les membres connecté:
if(!isset($_SESSION['username'])){
  header('Location: connexion.php');
}
?><!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
     <script type="text/javascript"src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
   <script type="text/javascript">
   function auto_load(){
      $.ajax({
        url: "data.php",
        cache: false,
        success: function(data){
           $("#auto_load_div").html(data);
        }
      });
}

$(document).ready(function(){
auto_load(); //Call auto_load() function when DOM is Ready
});
//Refresh auto_load() function after 10000 milliseconds
setInterval(auto_load,1000);
   </script>
    <link rel="stylesheet" href="css/master.css">

    <title>Projet de programmation web 2016</title>
  </head>
  <body>
     <div class="Container">
        <?php include('php/menu.php'); ?>
        <div class="MainWebsite">
          <div class="MsgFeeds">
                     <div id="auto_load_div"></div>
          </div><!--Feeds-->



        </div>
     </div><!--Container -->
  </body>
</html>
