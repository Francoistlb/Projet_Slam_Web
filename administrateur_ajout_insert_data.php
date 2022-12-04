
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
    if(!isset($_POST['Ajouter']))
    {
        ob_start();
        echo "<script language='Javascript'>alert('Veuillez remplir le formulaire')</script>";
        header('Refresh: 0.1 ; administrateur_accueil.php'); 
        ob_flush(); 
    }
     // SECURITE DE CONNEXION A LA PAGE
    else
    {
        if($_POST['Role']!='--- Choisissez un role ---')
        {
            // CONNEXION A LA BASE DE DONNEES
            require_once "connexion_base.php"; 
            // CONNEXION A LA BASE DE DONNEES

            // RECUPERATION DES INFORMATIONS DU FORMULAIRE AJOUT UTILISATEUR
            $Mail=$_POST['Mail'];            
            $Mdp=password_hash($_POST['Mdp'], PASSWORD_DEFAULT); // HASHAGE DU MDP
            $Nom=$_POST['Nom'];
            $Prenom=$_POST['Prenom'];
            $Telephone=$_POST['Telephone'];

            switch ($_POST['Role']) 
            {
                case "Visiteur":
                    $Role = 0;
                    break;
                case "secretaire":
                    $Role = 2;
                    break;
                case "Responsable":
                    $Role = 3;
                    break;
                case "Comptable":
                    $Role = 1;
                    break;
                case "Admin":
                    $Role = 4;
                    break;
                case "--- Choisissez un role ---":   
                    // Ne rien faire 
            }
             // RECUPERATION DES INFORMATIONS DU FORMULAIRE AJOUT UTILISATEUR

            // REQUETE POUR L'INSERTION DES DONNES DANS LA BDD
            $reponse = $bdd->prepare("INSERT INTO utilisateur(Mail_utilisateur,Passwordd,Nom_utilisateur,Prenom_utilisateur,Tel_utilisateur,ID_role) VALUES (?,?,?,?,?,?)");
            $reponse->execute(array($Mail, $Mdp, $Nom, $Prenom, $Telephone, $Role));
            // REQUETE POUR L'INSERTION DES DONNES DANS LA BDD

            
            ob_start();
            echo "<script language='Javascript'>alert('Utilisateur ajouté !')</script>";
            header('Refresh: 0.1 ; administrateur_accueil.php'); 
            ob_flush();
            
        }  
        else 
        {
            ob_start();
            echo "<script language='Javascript'>alert('Veuillez choisir un rôle')</script>";
            header('Refresh: 0.1 ; administrateur_ajout.php'); 
            ob_flush(); 
        }
    }    
}

?>