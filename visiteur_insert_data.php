<?php
session_start();
?>
<?php
// SECURITE DE CONNEXION A LA PAGE
if (!isset ($_SESSION['email']) || $_SESSION['role'] !=0)
{
  ob_start();
  echo "<script language='Javascript'>alert('Le login ou le mot de passe est incorrecte.')</script>";
  header('Refresh: 0.1 ; index.php'); 
  ob_flush();
  session_destroy();
}
 else
{  
    if (!isset($_POST['Envoyer']))
    {
        ob_start();
        echo "<script language='Javascript'>alert('Veuillez compléter le formulaire se saisie.')</script>";
        header('Refresh: 0.1 ; visiteur_accueil.php'); 
        ob_flush();
    }
// SECURITE DE CONNEXION A LA PAGE
    else
    {
        // CONNEXION A LA BASE DE DONNEES
        require_once "connexion_base.php";
        // CONNEXION A LA BASE DE DONNEES

        // RECUPERATION DES DONNES DU FORMULAIRE
        $idutilisateur=$_SESSION['ID_utilisateur'];
        $dateDebut=$_POST["dateDebut"];
        $dateFin=$_POST["dateFin"];
        $description=$_POST["description"];
        $nbNuit=$_POST["nbNuit"];
        $prixTotalNuit=$_POST["prixTotalNuit"];
        $nbRepas=$_POST["nbRepas"];
        $prixTotalRepas=$_POST["prixTotalRepas"];
        $nbKm=$_POST["nbKm"];
        $descriptionExtra=$_POST["descriptionExtra"];
        $prixExtra=$_POST["prixExtra"];
        $choixCv=$_POST["cv-select"];
        // RECUPERATION DES DONNES DU FORMULAIRE

        // TAUX INDEMNITE SELON CHOIX DES CV 
        switch ($choixCv)
        {
        case "4cv":  $totalIndemnite1 = $nbKm*0.52; 
            break;
        case "5cv":  $totalIndemnite1 = $nbKm*0.58;
            break;
        case "6cv":  $totalIndemnite1 = $nbKm*0.62;
            break;
        case "6cve": $totalIndemnite1 = $nbKm*0.67;
            break;
        }
        // TAUX INDEMNITE SELON CHOIX DES CV 


        // REQUETE SQL POUR INSERTION DES INFORMATIONS DE LA NOUVELLE FICHE FRAIS
        $reponse = $bdd->prepare ("INSERT INTO fiche_frais (ID_utilisateur,Date_debut,Date_fin,Description_frais,Nombre_nuit,Total_cout_nuit,Nombre_repas,Total_cout_repas,Distance_km,Total_indemnite_km,Description_autre_depence,Autre_depence_cout) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");
        $reponse->execute(array($idutilisateur,$dateDebut,$dateFin,$description,$nbNuit,$prixTotalNuit,$nbRepas,$prixTotalRepas,$nbKm,$totalIndemnite1,$descriptionExtra,$prixExtra));
            $resultat =$reponse ->fetch ();
         // REQUETE SQL POUR INSERTION DES INFORMATIONS DE LA NOUVELLE FICHE FRAIS


        // INFORMATION SUR L ETAT DE LA REQUETE ET REDIRECTION VERS ACCUEIL SI "OK"
        if($reponse)
        {
            ob_start();
            echo "<script language='Javascript'>alert('Nouvelle fiche frais envoyée.')</script>";
            header('Refresh: 0.1 ; visiteur_accueil.php'); 
            ob_flush();
        }
        else
        {
            echo"Une erreur est survenue";
        }
        // INFORMATION SUR L ETAT DE LA REQUETE ET REDIRECTION SI "OK"

    }
}
?>

