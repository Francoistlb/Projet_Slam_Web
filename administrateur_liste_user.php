<?php
session_start();
?>
<?php
// SECURITE DE CONNEXION A LA PAGE
 if (!isset ($_SESSION['email']) || $_SESSION['role'] !=4)
 {
   ob_start();
   echo "<script language='Javascript'>alert('Le login ou le mot de passe est incorrecte.')</script>";
   header('Refresh: 0.1 ; index.php'); 
   ob_flush();
   session_destroy();
   // SECURITE DE CONNEXION A LA PAGE
 }
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
    echo "Profil administrateur <br> <br>";
    echo "<a href='kill_session.php'> Déconnexion </a>" ;
    // INFORMATION DE SESSION           
                  
    echo'</div></div></div></div></div>
        <div class="contenu">
        <div class="ligne"></div>
        <div>
        <h1 class=" text-center"></h1>  
        <div class="varelements">

        <h2 class=" text-center"> Modifier / Supprimer un utilisateur GSB : </h2>  <br>'; 
                       
        // RECUPERATION DES DONNES UTILISATEUR
        $ID_ut=$_SESSION['ID_utilisateur'];
        
            $reponse = $bdd->query("SELECT * FROM utilisateur WHERE ID_utilisateur !='$ID_ut' ORDER BY ID_utilisateur ASC");
            while ($donnees = $reponse->fetch())
        {
        // RECUPERATION DES DONNES UTILISATEUR

        // AFFICHAGE DE LA LISTE UTILISATEURS

    echo'<p>';
    echo "ID : ", htmlspecialchars($donnees['ID_utilisateur']) ; ?> / <?php echo "Mail : ", htmlspecialchars($donnees['Mail_utilisateur']) ; ?> / <?php echo "Nom : ", htmlspecialchars($donnees['Nom_utilisateur']) ; ?> / <?php echo "Prénom : ", htmlspecialchars($donnees['Prenom_utilisateur']) ; ?> / <?php echo "Tel : ",htmlspecialchars($donnees['Tel_utilisateur']) ; ?> / <?php echo "Role : ", htmlspecialchars($donnees['ID_role']) ; 
    echo "&nbsp &nbsp <a href='administrateur_suppr_insert_data.php?option=supprimer&Id=".strval($donnees['ID_utilisateur']."'>Supprimer</a>");
    echo "&nbsp <a href='administrateur_modify.php?option=modifier&Id=".$donnees['ID_utilisateur']."&Mail=".$donnees['Mail_utilisateur']."&Nom=".$donnees['Nom_utilisateur']."&Pseudo=".$donnees['Prenom_utilisateur']."&Tel=".$donnees['Tel_utilisateur']."&Role=".$donnees['ID_role']." '> Modifier</a>";
    echo'<p>';
        // AFFICHAGE DE LA LISTE UTILISATEURS
        }
        $reponse->closeCursor();
        
        // REDIRECTION VERS ACCUEIL
        echo'<br><a href="administrateur_accueil.php" class="nvlff"> Retour </a><br><br>';
        // REDIRECTION VERS ACCUEIL

        echo'</div></div></div></div></main>
    </body>
    </html>';
}
?>
