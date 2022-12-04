<?php
session_start();
?>
<?php
// SECURITE DE CONNEXION A LA PAGE
 if (!isset ($_SESSION['email']) || $_SESSION['role'] !=1)
 {
   ob_start();
   echo "<script language='Javascript'>alert('Le login ou le mot de passe est incorrecte.')</script>";
   header('Refresh: 0.1 ; index.php'); 
   ob_flush();
   session_destroy();
 }
 else
  { 
   if (empty($_GET['ID_ut']))
   {
      ob_start();
      echo "<script language='Javascript'>alert('Veuillez selectionner une fiche de frais.')</script>";
      header('Refresh: 0.1 ; comptabilite_accueil.'); 
      ob_flush();
   }
   // SECURITE DE CONNEXION A LA PAGE
   else
   { 
    // CONNEXION A LA BASE DE DONNEES
    require_once "connexion_base.php";
     // CONNEXION A LA BASE DE DONNEES

    echo'<!DOCTYPE html>
      <html lang="fr">
      <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Appli-Frais</title>
        <link href="assets/images/logo_gsb.jpg" rel="icon">
        <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="assets/css/login.css">
      </head>

      <body>
        <main class="min-vh-100 py-3 py-md-0">
        <div class="centrage">
        <div class="container2">
        <div class="card login-card">
        <div class="row no-gutters">
        <div class="img col-md-5">
        <img src="assets/images/logo_gsb.jpg" alt="login" class="login-card-img"></div>
        <div class="centrage col-md-7">
        <div class="card-body text-center">';

    // INFORMATION DE SESSION     
    $email=$_SESSION['email'];
    echo "Bonjour $email <br> <br>";
    echo "Profil comptable <br> <br>";
    echo "<a href='kill_session.php'> Déconnexion </a>" ;
    // INFORMATION DE SESSION           
                  
    echo'</div></div></div></div></div>
        <div class="contenu">
        <div class="ligne"></div>
        <div>
        <h1 class=" text-center"></h1>  
        <div class="varelements">';

      //RECUPERATION ID UTILISATEUR ET ID FICHE FRAI
      $ID_ut=$_GET['ID_ut'];
      $ID_ff=$_GET['ID_ff'];
      //RECUPERATION ID UTILISATEUR ET ID FICHE FRAI
      

      // RECUPERATION DES DONNEES DE LA FICHE FRAIS POUR LE STATUT "NOUVELLE"
      $nvl_ff="SELECT u.Nom_utilisateur, u.Prenom_utilisateur, u.Mail_utilisateur, 
                     f.ID_utilisateur, f.ID_fiche_frais, f.Created_at_frais, f.Description_frais, 
                     f.Date_debut, f.Date_fin, f.Deplacement_voiture, f.Distance_km, 
                     f.Total_indemnite_km, f.Nombre_nuit, f.Total_cout_nuit, f.Nombre_repas, 
                     f.Total_cout_repas, f.Description_autre_depence, f.Autre_depence_cout, f.Statut_validation
                    
                     FROM fiche_frais f 
                     INNER JOIN utilisateur u ON f.ID_utilisateur=u.ID_utilisateur 
                     
                     WHERE f.Statut_validation=0 AND f.ID_fiche_frais=$ID_ff ";

      $req_nvl_ff= $bdd->prepare($nvl_ff);
      $req_nvl_ff->execute(); 
      // RECUPERATION DES DONNEES DE LA FICHE FRAIS POUR LE STATUT "NOUVELLE"

   
      
       // AFFICHAGE DES INFORMATIONS LIEES A LA FICHE FRAIS
      while ($donnes =  $req_nvl_ff->fetch()) 
      {
         $ID_ff=$donnes['ID_fiche_frais'];

         if($donnes['Nombre_nuit']>0)
         {
            $cpn=($donnes['Total_cout_nuit']/$donnes['Nombre_nuit']);
         }
         else
         {
            $cpn=0;
         }

         if($donnes['Nombre_repas']>0)
         {
            $cpr=($donnes['Total_cout_repas']/$donnes['Nombre_repas']);
         }
         else
         {
            $cpr=0;
         }


         
         echo "Fiche frais n° <strong>". $donnes['ID_fiche_frais']." </strong><br><br>";

         echo "Visiteur : ". $donnes['Nom_utilisateur']." &nbsp ";
         echo $donnes['Prenom_utilisateur']."<br>";
         echo "Adresse mail : ". $donnes['Mail_utilisateur']."<br><br>";

         echo "Créer le : ". $donnes['Created_at_frais']."<br>";
         echo "Description : ".$donnes['Description_frais']."<br>";
         echo "Du : ". $donnes['Date_debut']."<br>";
         echo "Au : ". $donnes['Date_fin']."<br><br>";

         echo "<strong>Déplacement</strong> <br>";
         echo "Déplacement en voiture : ". $donnes['Deplacement_voiture']."<br>";
         echo "Distance kilomètrique : ". $donnes['Distance_km']." <br>";
         echo "Coût kilomètrique : ". $donnes['Total_indemnite_km']."<br><br>";

         //echo "Autre déplacement (Description et type ):". $donnes['Autre_deplacement']."<br><br>";
         //echo "Montant du déplacement déplacement :". $donnes['Prix_autre_deplacement']."<br><br>";

         echo "<strong>Hébergement</strong> <br>";
         echo "Nombre de nuit : ". $donnes['Nombre_nuit']."<br>";
         echo "Coût par nuit : ". round($cpn,2)."<br><br>";
          
         echo "<strong>Repas</strong> <br>";
         echo "Nombre de repas : ". $donnes['Nombre_repas']."<br>";
         echo "Coût par repas : ". round($cpr,2)."<br><br>";

         echo "<strong>Autre(s) frais :</strong> <br>";
         echo "Description autre(s) frais : ". $donnes['Description_autre_depence']."<br>";
         echo "Montant autre(s) frais : ". $donnes['Autre_depence_cout']."<br><br>";

         if($donnes['Description_autre_depence']!=='')
         {
            echo "<strong> Justificatif(s) : </strong> <br>";
            echo "Justificatif : ".$donnes['justificatif']."<br>";
         }
         echo "<br>";

         if($donnes['Total_indemnite_km']>35)
         {
            $cindemn=$donnes['Total_indemnite_km']-35;
            echo "<br><br>";
            echo "<strong>Frais de dépassement : </strong> <br>";
            echo "! Les frais de déplacement dépasse de". round($cindemn,2)."€" ;
         }
         

         if($cpn>35 || $cpr>35)
         {  
            echo "<strong>Frais de dépassement : </strong> <br>";

            if($cpn>35)
            {
               $cpn2=$cpn-35;
               echo " - Les frais d'hébergement par nuit dépasse de ". round($cpn2,2)."€ <br>" ;
            }

            if($cpr>35)
            {
               $cpr2=$cpr-35;
               echo " - Les frais de restauration par repas dépasse de ". round($cpr2,2)."€ <br> <br> <br>" ;
            }
         }

         
      }
       // AFFICHAGE DES INFORMATIONS LIEES A LA FICHE FRAIS


      // BOUTON DE VALIDATION OU SUSPEND DE LA FICHE FRAIS 
      echo"<!DOCTYPE html>
      <form action='comptabilite_nouvelle.php?&ID_ut=".$ID_ut."?&ID_ff=".$ID_ff."' method='POST'>
      <label> Validation de la fiche frais </label> <br>
      <input type='radio' id='Oui' name='valid_ff' value='oui' >
      <label for='oui'> Oui </label>

      <input type='radio' id='Non' name='valid_ff' value='non' >
      <label for='non'> Non </label>

      <input type='submit' name='Envoyer' value='Envoyer' />
      </form> </html>";

      
      if (!isset($_POST['Envoyer']))
      {
         echo "";
      }
      else
      {
         $rep_valid=$_POST['valid_ff'];

         echo $rep_valid;
         echo $ID_ff;
         echo $ID_ut;
         switch($rep_valid)
         {
            case 'oui' :  
               $req_valid_oui= $bdd->prepare("UPDATE fiche_frais SET Statut_validation=1 WHERE ID_fiche_frais=? AND ID_utilisateur=?");
               $req_valid_oui->execute(array($ID_ff, $ID_ut));

               
               echo '<script language="Javascript">alert("Fiche de frais validé." )</script>';
               header('Refresh: 0.1 ; comptabilite_accueil.php'); 
               ob_flush();
               exit();
            break;

            case 'non' :  
              
               $req_valid_oui= $bdd->prepare("UPDATE fiche_frais SET Statut_validation=2 WHERE ID_fiche_frais=? AND ID_utilisateur=?");
               $req_valid_oui->execute(array($ID_ff, $ID_ut)); 
               echo '<script language="Javascript">alert("Fiche de frais suspendue." )</script>';
               header('location: comptabilite_accueil.php');
               //echo '<script language="Javascript">alert("Fiche de frais suspendue." )</script>';
               exit();
            break;
         }
      }
      // BOUTON DE VALIDATION OU SUSPEND DE LA FICHE FRAIS

      // REDIRECTION VERS ACCUEIL
      echo'<br><a href="comptabilite_accueil.php" class="nvlff"> Retour </a><br><br>';
      // REDIRECTION VERS ACCUEIL
   
}
echo'</div></div></div></div></main>
    </body>
    </html>';

}




?>





