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
    if (isset($_GET['Modifier']) == "Modifier") 
    {

        require_once "connexion_base.php";        // Connexion base

        $Id = $_GET['Id'];                      // Affectation des variables
        $Mail = $_GET['Mail'];              
        $Nom = $_GET['Nom'];
        $Prenom = $_GET['Pseudo'];
        $Telephone = $_GET['Telephone'];
        $ID_ut=$_SESSION['ID_utilisateur'];

        switch ($_GET['Role']) 
        {
            case "Visiteur":
                $Role = 0;
                break;
            case "Commerciaux":
                $Role = 1;
                break;
            case "Responsable":
                $Role = 2;
                break;
            case "Comptable":
                $Role = 3;
                break;
            case "Admin":
                $Role = 4;
                break;
            case "--- Choisissez un role ---":   
                // Ne rien faire 
        }

        if (!empty($Mail)) 
        {

            $reponse = $bdd->prepare("UPDATE utilisateur SET Mail_utilisateur = ? WHERE ID_utilisateur = ?");
            $reponse->execute(array($Mail, $Id));
    
        } else 
        {
        }

        if (!empty($Nom)) 
        {
    
            $reponse = $bdd->prepare("UPDATE utilisateur SET Nom_utilisateur = ? WHERE ID_utilisateur = ?");
            $reponse->execute(array($Nom, $Id));
    
        } 
        else 
        {
        }
    
        if (!empty($Prenom)) {
    
            $reponse = $bdd->prepare("UPDATE utilisateur SET Prenom_utilisateur = ? WHERE ID_utilisateur = ?");
            $reponse->execute(array($Prenom, $Id));
    
        } 
        else 
        {
        }
    
        if (!empty($Telephone)) 
        {
    
            $reponse = $bdd->prepare("UPDATE utilisateur SET Tel_utilisateur = ? WHERE ID_utilisateur = ?");
            $reponse->execute(array($Telephone, $Id));
    
        } 
        else 
        {
        }
    
        if (!empty($Role)) 
        {
            $reponse = $bdd->prepare("UPDATE utilisateur SET ID_role = ? WHERE ID_utilisateur = ?");
            $reponse->execute(array($Role, $Id));

        } else 
        {
        }
        

        // VERIFICATION DE LA REQUETE + MESSAGE A DEFINIR
        // REDIRECTION VERS ACCUEIL
        ob_start();
        echo "<script language='Javascript'>alert('Utilisateur ".$_GET['Id']." Modifié')</script>";
        header('Refresh: 0.1 ; administrateur_accueil.php'); 
        ob_flush();
        // REDIRECTION VERS ACCUEIL
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