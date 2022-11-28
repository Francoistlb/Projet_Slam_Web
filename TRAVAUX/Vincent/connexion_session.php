<?php

ob_start();
session_start();

if (!isset ($_POST['Envoyer']) && empty($_POST['Envoyer']) && empty($_POST['email']) && empty($_POST['password']))
   {
      echo "Veuillez saisir vos identifiants  <br> <br>";
   } 
   else
   {  
      // Etape 1 : Connexion à la basse de données
      require_once "connexion_gsb.php";

      // Etape 2 : Récupération des données du formulaire
      htmlspecialchars($id=$_POST['email']); // éviter des injections XSS
      htmlspecialchars($mdp=$_POST['password']);
      
      // Etape 3 : Requête de connexion : contrôle de l'email et récupération du mdp hash
      // Récupération des données dans la table utilisateur
      $log="SELECT * FROM utilisateur WHERE Mail_utilisateur ='$id'";
      $req= $bdd->prepare($log);
      $req->execute();
      
      // Stockage des réponses dans la variable $login
      $login=$req->fetch(); 
      //var_dump($login);
    
               //var_dump($login);                   // Affiche le résultat de la variable Login issue du fetch
               //echo '<br><br>'.$login['ID_role'];  // Affiche le résultat de $login['ID_role']

      // Vérifie l'existance du login (si $count trouve 0, il n'y a pas de login)
      $count=$req->rowCount();
               //echo $count;

      // Etape 4 : Vérification de l'email. Si >= 0 alors le login éxiste
      if($count>0)
      {
         // Etape 5 :Comparaison du mdp saisi et hashé 
         if(password_verify($mdp, $login['Passwordd'])) 
         {
            // Etape 6 : Ouverture de session intval pour convert string to int
            $_SESSION['email'] = $id;
            $_SESSION['role'] = $login['ID_role'];
            $_SESSION['id_User'] = intval($login['ID_utilisateur']);

            //var_dump($_SESSION);

      
            // Etape 7 : Ouverture de l'interface selon le rôle
           switch ($login['ID_role']) 
            {
               case 0:
                  header('location: Acceuil_visiteur.php'); // Ouvre l'interface pour le visiteur
                  exit(); 
               break;

               case 1:
                  header('location: Acceuil_comptabilite.php'); // Ouvre l'interface pour le comptable
                  exit();  
               break;

               case 2:
                  header('location: Acceuil_secretaire.php'); // Ouvre l'interface pour le responsable visiteur
                  exit(); 
               break;

               case 3:
                  header('location: Acceuil_responsable.php'); // Ouvre l'interface pour l'administrateur
                  exit(); 
               break;

               case 4:

                  header('location: Acceuil_administrateur.php'); // Ouvre l'interface pour le secretaire
                  exit(); 
               break;
            }
            
         }
         else
         {
            // Si le mot de passe est incorrect, redirection sur index.php avec message d'alerte
            echo "<script language='Javascript'>alert('Le login ou le mot de passe est incorrecte.')</script>";
            header('Refresh: 0.1; index.php'); 
            ob_flush();
         }
      }
      else
      {
         // Si le login est incorrect, redirection sur index.php
         echo "<script language='Javascript'>alert('Le login ou le mot de passe est incorrecte.')</script>";
         header('Refresh: 0.1; index.php'); 
         ob_flush();
      }
   }

?>