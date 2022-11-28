<?php
require_once ('connexion_gsb.php');

// Session start pour récupérer l'email pour ensutie récupérer l'id liée à l'email
session_start();
$email=$_SESSION['email'];
$idutilisateur=$_SESSION['ID_utilisateur'];
echo $email;
echo $idutilisateur;

//récupération des données avant d'insert to BDD

$dateDebut=$_POST["dateDebut"];
$dateFin=$_POST["dateFin"];
$nbNuit=$_POST["nbNuit"];
$prixTotalNuit=$_POST["prixTotalNuit"];
$nbRepas=$_POST["nbRepas"];
$prixTotalRepas=$_POST["prixTotalRepas"];
$nbKm=$_POST["nbKm"];
$descriptionExtra=$_POST["descriptionExtra"];
$prixExtra=$_POST["prixExtra"];
$choixCv=$_POST["cv-select"];
$email=$_SESSION['email'];
$idutilisateur=$_SESSION['ID_utilisateur'];
// permet de choisir le taux d'indemnité selon le choix du véhicule fait dans le formulaire 
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
    echo "$totalIndemnite1";
    




echo"$dateDebut DD <br/>";
echo"$dateFin  DF <br/>";
echo"$nbNuit NUITS  <br/>";
echo"$prixTotalNuit Prix nuit<br/>";
echo"$nbRepas NB repas<br/>";
echo"$prixTotalRepas total repas<br/>";
echo"$nbKm nb km<br/>";
echo"$descriptionExtra extra<br/>";
echo"$prixExtra prix extra<br/>";
echo"$choixCv choix cv<br/>";
echo"$email mail<br/>";
echo "$idutilisateur";


    
    //insert values in bdd valeurs après le INSERT INTO = valeurs de la bdd)
    $reponse = $bdd->prepare ("INSERT INTO fiche_frais (ID_utilisateur,Date_debut,Date_fin,Nombre_nuit,Total_cout_nuit,Nombre_repas,Total_cout_repas,Distance_km,Total_indemnite_km,Description_autre_depence,Autre_depence_cout,Email) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");
    $reponse->execute(array($idutilisateur,$dateDebut,$dateFin,$nbNuit,$prixTotalNuit,$nbRepas,$prixTotalRepas,$nbKm,$totalIndemnite1,$descriptionExtra,$prixExtra,$email));
        $resultat =$reponse ->fetch ();
        echo "$resultat";
?>

