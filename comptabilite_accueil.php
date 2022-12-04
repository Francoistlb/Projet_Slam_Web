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
        <br><h2 class=" text-center"> Contrôle des fiches frais  </h2>  
        <div class="varelements">';

    // RECUPERATION INFO NOUVELLE FICHE FRAIS
    $statut_nvl_ff="SELECT * FROM fiche_frais WHERE Statut_validation=0";
    $req_statut_nvl_ff= $bdd->prepare($statut_nvl_ff);
    $req_statut_nvl_ff->execute();

    $count=$req_statut_nvl_ff->rowCount();

    if($count<=0)
    {
      echo "Il n'y a aucune nouvelle feuille de frais à traiter <br><br>";
    }
    else
    {
      echo "Il y a ". $count." nouvelle(s) feuille de frais à traité : <br> ";
    }
    // RECUPERATION INFO NOUVELLE FICHE FRAIS
  
    // AFFICHAGE NOUVELLE FICHE FRAIS
    $affiche_nvl_ff="SELECT u.Nom_utilisateur, u.Prenom_utilisateur, u.ID_utilisateur, f.ID_fiche_frais, f.Statut_validation FROM fiche_frais f
                      INNER JOIN utilisateur u on f.ID_utilisateur=u.ID_utilisateur WHERE Statut_validation=0";

    $req_affiche_nvl_ff= $bdd->prepare($affiche_nvl_ff);
    $req_affiche_nvl_ff->execute(); 
    
    while ($donnees0=$req_affiche_nvl_ff->fetch()) 
    {
      echo " - N° fiche frais (<strong>". $donnees0['ID_fiche_frais'].") </strong>   ";
      echo " - Visiteur : </strong>". $donnees0['Nom_utilisateur']."</strong> "; //&nbsp pour créer un espace forcé
      echo $donnees0['Prenom_utilisateur']." <a href='comptabilite_nouvelle.php?&ID_ut=".$donnees0['ID_utilisateur']."?&ID_ff=".$donnees0['ID_fiche_frais']."' > Voir </a> <br>"; //?&ID_ut récupère dans le GET
      
    }
    // AFFICHAGE NOUVELLE FICHE FRAIS

    // RECUPERATION INFO DES FICHES FRAIS VALIDEES 
    $statut_nvl_ff="SELECT * FROM fiche_frais WHERE Statut_validation=1";
    $req_statut_nvl_ff= $bdd->prepare($statut_nvl_ff);
    $req_statut_nvl_ff->execute();

    $count=$req_statut_nvl_ff->rowCount();

    if($count<=0)
    {
      echo "<br>Il n'y a aucune feuille de frais traitée <br><br>";
    }
    else
    {
      echo "<br>Il y a ". $count."  feuille(s) de frais traitée(s) : <br> ";
    }
    // RECUPERATION INFO DES FICHES FRAIS VALIDEES

    // AFFICHAGE FICHE FRAIS VALIDEES
    $affiche_nvl_ff="SELECT u.Nom_utilisateur, u.Prenom_utilisateur, u.ID_utilisateur, f.ID_fiche_frais, f.Statut_validation FROM fiche_frais f
                    INNER JOIN utilisateur u on f.ID_utilisateur=u.ID_utilisateur WHERE Statut_validation=1 LIMIT 10";

    $req_affiche_nvl_ff= $bdd->prepare($affiche_nvl_ff);
    $req_affiche_nvl_ff->execute(); 

    while ($donnees0=$req_affiche_nvl_ff->fetch()) 
    {
      echo " - N° fiche frais (<strong>". $donnees0['ID_fiche_frais'].") </strong>   ";
      echo " - Visiteur : </strong>". $donnees0['Nom_utilisateur']."</strong> "; //&nbsp pour créer un espace forcé
      echo $donnees0['Prenom_utilisateur']." <a href='comptabilite_valide.php?&ID_ut=".$donnees0['ID_utilisateur']."?&ID_ff=".$donnees0['ID_fiche_frais']."'> Voir </a> <br>";
    }
    // AFFICHAGE FICHE FRAIS VALIDEES


    // RECUPERATION INFO DES FICHES FRAIS SUSPENDUES / EN ATTENTE
    $statut_nvl_ff="SELECT * FROM fiche_frais WHERE Statut_validation=2";
    $req_statut_nvl_ff= $bdd->prepare($statut_nvl_ff);
    $req_statut_nvl_ff->execute();

    $count=$req_statut_nvl_ff->rowCount();

    if($count<=0)
    {
      echo "<br>Il n'y a aucune feuille de frais suspendue <br><br>";
    }
    else
    {
      echo "<br>Il y a ". $count." feuille(s) de frais suspendue(s) : <br> ";
    }
    // RECUPERATION INFO DES FICHES FRAIS SUSPENDUE / EN ATTENTE

    // AFFICHAGE FICHE FRAIS SUSPENDUES / EN ATTENTE
    $affiche_nvl_ff="SELECT u.Nom_utilisateur, u.Prenom_utilisateur, u.ID_utilisateur, f.ID_fiche_frais, f.Statut_validation FROM fiche_frais f
                    INNER JOIN utilisateur u on f.ID_utilisateur=u.ID_utilisateur WHERE Statut_validation=2 LIMIT 10";

    $req_affiche_nvl_ff= $bdd->prepare($affiche_nvl_ff);
    $req_affiche_nvl_ff->execute(); 

    while ($donnees0=$req_affiche_nvl_ff->fetch()) 
    {
      echo " - N° fiche frais (<strong>". $donnees0['ID_fiche_frais'].") </strong>   ";
      echo " - Visiteur : </strong>". $donnees0['Nom_utilisateur']."</strong> "; //&nbsp pour créer un espace forcé
      echo $donnees0['Prenom_utilisateur']." <a href='comptabilite_suspendue.php?&ID_ut=".$donnees0['ID_utilisateur']."?&ID_ff=".$donnees0['ID_fiche_frais']."'> Voir </a><br> ";
    }
    // AFFICHAGE FICHE FRAIS SUSPENDUES / EN ATTENTE

    echo'<br><br>';
    
              
    echo'</div></div></div></div></main>
    </body>
    </html>';
}
?>

