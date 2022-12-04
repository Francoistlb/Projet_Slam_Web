<?php
session_start();
ob_start();
?>
<?php
// SECURITE DE CONNEXION A LA PAGE
 if (!isset ($_SESSION['email']) || $_SESSION['role'] !=0)
 {
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
    echo "Profil visiteur <br> <br>";
    echo "<a href='kill_session.php'> Déconnexion </a>" ;
    // INFORMATION DE SESSION           
                  
    echo'</div></div></div></div></div>
        <div class="contenu">
        <div class="ligne"></div>
        <div>
        <div class="varelements">';

    

    // REDIRECTION SAISIE NOUVELLE FICHE FRAIS
    echo "<h2>Saisir une nouvelle fiche de frais : </h2> <br>";

    echo '<a  href=visiteur_saisie_ff.php class="nvlff"> Nouvelle fiche de frais </a><br><br>';

    echo "<h2>Historique des fiches frais : </h2> <br>";

    // AFFICHAGE DES FICHE FRAIS UTILISATEUR CONNECTE
    $ID_ut=$_SESSION['ID_utilisateur'];

    $req_affiche_nvl_ff= $bdd->prepare("SELECT u.ID_utilisateur, f.ID_fiche_frais, f.Statut_validation, f.Description_frais FROM fiche_frais f
    INNER JOIN utilisateur u on f.ID_utilisateur=u.ID_utilisateur WHERE f.ID_utilisateur=?");
    $req_affiche_nvl_ff->execute(array($ID_ut)); 

    while ($donnees1=$req_affiche_nvl_ff->fetch()) 
    {
    echo " - N° fiche frais (<strong>". $donnees1['ID_fiche_frais'].") </strong>   ";
    echo " - Description : </strong>". $donnees1['Description_frais']."</strong> "; //&nbsp pour créer un espace forcé
    echo " <a href='visiteur_historique.php?&?&ID_ff=".$donnees1['ID_fiche_frais']."' > Voir </a> <br>"; //?&ID_ut récupère dans le GET

    }
    // AFFICHAGE DES NOUVELLE FICHE FRAIS
    echo'<br><br>';



    
              
    echo'</div></div></div></div></main>
    </body>
    </html>';
}

