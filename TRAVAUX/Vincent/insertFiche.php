<?php
require_once ('connexion_gsb.php');

// Session start pour récupérer l'id 
//$id_session = $_POST

//$_SESSION['favcolor'] = 'green';
// récupération de l'id de la session 
//$id_session=$_SESSION['email'];
//récupération des données
$dateDebut = $_POST["dateDebut"];
$dateFin=$_POST["dateFin"];
$nbNuit=$_POST["nbNuit"];
$prixTotalNuit=$_POST["prixTotalNuit"];
$nbRepas=$_POST["nbRepas"];
$prixTotalRepas=$_POST["prixTotalRepas"];
$nbKm=$_POST["nbKm"];
$prixTotalKM=$_POST['prixTotalKm'];
$descriptionExtra=$_POST["descriptionExtra"];
$prixExtra=$_POST["prixExtra"];
$choixCv=$_POST["cv-select"];

echo "$dateDebut <br/>";
echo "$dateFin <br/>";
echo "$nbNuit<br/>";
echo "$prixTotalNuit<br/>";
echo "$nbRepas<br/>";
echo "$prixTotalRepas<br/>";
echo "$nbKm<br/>";
echo "$descriptionExtra<br/>";
echo "$prixExtra<br/>";
echo "$choixCv<br/>";

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
    
    //insert values in bdd valeurs après le INSERT INTO = valeurs de la bdd)
    $reponse = $bdd->prepare ("INSERT INTO fiche_frais (Date_debut,Date_fin,Nombre_nuit,Total_coût_nuit,Nombre_repas,Total_coût_repas,Distance_km,Total_indemnite_km,Description_autre_depence,Autre_depence_coût) VALUES (?,?,?,?,?,?,?,?,?,?)");
    $reponse->execute(array($dateDebut,$dateFin,$nbNuit,$prixTotalNuit,$nbRepas,$prixTotalRepas,$nbKm,$choixCv,$descriptionExtra,$prixExtra));
        $resultat =$reponse ->fetch ();
        echo "$resultat";

        // venir recuperer l'id de la session, pour le rentrer dans la table fiche de frais. à recupérer dans la table user, et gérer avec la session d'ouverte

?>