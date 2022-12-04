<?php
session_start();
?>
<?php
// SECURITE DE CONNEXION A LA PAGE
 if (!isset ($_SESSION['email']) || $_SESSION['role'] !=3)
 {
  ob_start();
  echo "<script language='Javascript'>alert('Le login ou le mot de passe est incorrecte.')</script>";
  header('Refresh: 0.1 ; index.php'); 
  ob_flush();
  session_destroy();
 }
  else
  {  
    // CONNEXION A LA BASE DE DONNEES
    require_once "connexion_base.php";

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
    echo "Profil administrateur <br> <br>";
    echo "<a href='kill_session.php'> Déconnexion </a>" ;
    // INFORMATION DE SESSION           
                  
    echo'</div></div></div></div></div>
        <div class="contenu">
        <div class="ligne"></div>
        <div>
   
        <div class="varelements">

        <h2 class=" text-center"> Synthèse des informations GSB - Visiteurs </h2> 
          <form action="" method="POST">
<div >
<button class="w-50 btn btn-lg btn-primary" type="submit" name="fichesdate"   > Toutes les fiches frais : </button>
</div>';
// FILTRE SUR LA LISTE DES FICHE FRAIS
if (isset($_POST['fichesdate'])) 
{
  require_once 'connexion_base.php';

    // AFFICHAGE FICHE FRAIS VALIDEES
    $affiche_ff="SELECT u.Nom_utilisateur, u.Prenom_utilisateur, u.ID_utilisateur, f.ID_fiche_frais, f.Statut_validation, f.Description_frais, f.Created_at_frais FROM fiche_frais f
                    INNER JOIN utilisateur u on f.ID_utilisateur=u.ID_utilisateur ORDER BY u.Nom_utilisateur";

    $req_affiche_ff= $bdd->prepare($affiche_ff);
    $req_affiche_ff->execute(); 

    while ($donnees0= $req_affiche_ff->fetch()) 
    {
      echo " - N° fiche frais (<strong>". $donnees0['ID_fiche_frais'].") </strong> : ";
      echo $donnees0['Description_frais']."";
      echo " - Crée le ".$donnees0['Created_at_frais']."";
      echo " - Visiteur : </strong>". $donnees0['Nom_utilisateur']."</strong> "; //&nbsp pour créer un espace forcé
      echo $donnees0['Prenom_utilisateur']."<br>";
      
    }
    // AFFICHAGE FICHE FRAIS VALIDEES
}
// FILTRE SUR LA LISTE DES FICHE FRAIS

echo'<div >
<button class="w-50 btn btn-lg btn-primary" type="submit" name="fichesnom" > Tous les visiteurs : </button>
</div>';

// FILTRE SUR LA LISTE DES VISITEURS
if (isset($_POST['fichesnom'])) 
{
  require_once 'connexion_base.php';

    // AFFICHAGE UTILISATEUR 
    $affiche_ut="SELECT Nom_utilisateur, Prenom_utilisateur, ID_utilisateur, Mail_utilisateur, Tel_utilisateur
                FROM utilisateur WHERE ID_role=0 ORDER BY Nom_utilisateur";

    $req_affiche_ut= $bdd->prepare($affiche_ut);
    $req_affiche_ut->execute(); 

    while ($donnees0= $req_affiche_ut->fetch()) 
    {
      echo $donnees0['Nom_utilisateur']."&nbsp &nbsp";
      echo $donnees0['Prenom_utilisateur']."&nbsp &nbsp";
      echo $donnees0['Mail_utilisateur']."&nbsp &nbsp";
      echo $donnees0['Tel_utilisateur']."&nbsp &nbsp";
      echo $donnees0['ID_utilisateur']."&nbsp &nbsp <br>";
    }
    // AFFICHAGE UTILISATEUR 

}
// FILTRE SUR LA LISTE DES VISITEURS

echo'</form>';

    echo'<br><br>';          
    echo'</div></div></div></div></main>
    </body>
    </html>';
}
?>