<?php session_start();
require('php/classe_utilisateur.php');
//cette page est accessible que pour les membres connectés:
if(!isset($_SESSION['username'])){
  header('Location: connexion.php');
}
?><!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/master.css">

    <title>Projet de programmation web 2016</title>
  </head>
  <body>
     <div class="Container">
       <?php include('php/menu.php'); ?>
        <div class="MainWebsite">

          <div class="Feeds">
                  <div class="title">
                    <h1>Projet de programmation web 2016 "Touitteur"</h1>
                    <h2>Ce Projet Contient : </h2>
                    
<p>1. Possibilite de creer un nouvel utilisateur  a l'aide d'un formulaire d'inscription.<br></p>
<p>2. Systeme de Connexion/Deconnexion sécurisé  pour les utilisateurs.<br></p>
<p>3. Un utilisateur peut rechercher d'autre utilisateurs.<br></p>
<p>4. Un utilisateur connecte peut acceder  a sa page personnelle et modifier des informations le concernant,<br></p>
<p>5. Un utilisateur connecte peut  echanger des messages prives, avec d’autre utilisateurs<br></p>
<p>6. Un utilisateur connecte peut decider de suivre ou de ne plus suivre un autre utilisateur.<br></p>
<p>7. Un utilisateur connecte possede un mur sur lequel s'affiche ses messages les plus recents.<br></p>
<p>8. Un utilisateur connecte peut consulter son profil ainsi le profil des autre utilisateurs en les recherchant .<br>
</h3>

      </p>
                  </div>
          </div>

        </div>
     </div>
  </body>
</html>
