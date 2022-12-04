
<?php
session_start();
// SECURITE DE CONNEXION A LA PAGE   
if (!isset ($_SESSION['email']) || $_SESSION['role'] !=4)
{
    ob_start();
    echo "<script language='Javascript'>alert('Le login ou le mot de passe est incorrecte.')</script>";
    header('Refresh: 0.1 ; index.php'); 
    ob_flush();
    session_destroy();
}
else
{
   if (isset($_GET['option']) == "supprimer")
// SECURITE DE CONNEXION A LA PAGE
   {
      // CONNEXION A LA BASE DE DONNEES
      require_once "connexion_base.php";
      // CONNEXION A LA BASE DE DONNEES

      // REQUETE SQL POUR SUPPRIMER L'UTILISATEUR
      $reponse = $bdd->prepare('DELETE FROM utilisateur WHERE ID_utilisateur = ?');
      $reponse->execute(array($_GET['Id']));
      // REQUETE SQL POUR SUPPRIMER L'UTILISATEUR




      // VERIFICATION DE LA REQUETE + MESSAGE A DEFINIR
      // REDIRECTION AVEC MESSAGE QUAND OK
      ob_start();
      echo "<script language='Javascript'>alert('Utilisateur ".$_GET['Id']." supprimé')</script>";
      header('Refresh: 0.1 ; administrateur_liste_user.php'); 
      ob_flush();  
      // REDIRECTION AVEC MESSAGE QUAND OK
      
   }
   else
   {
      ob_start();
        echo "<script language='Javascript'>alert('Veuillez choisir un utilisateur')</script>";
        header('Refresh: 0.1 ; administrateur_liste_user.php'); 
        ob_flush(); 
   }
}
?>
