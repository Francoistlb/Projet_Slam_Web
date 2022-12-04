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
    echo "Profil administrateur <br> <br>";
    echo "<a href='kill_session.php'> Déconnexion </a>" ;
    // INFORMATION DE SESSION           
                  
    echo'</div></div></div></div></div>
        <div class="contenu">
        <div class="ligne"></div>
        <div>
        <h1 class=" text-center"></h1>  
        <div class="varelements">';

      // FORMULAIRE AJOUT UTILISATEUR
      echo'
        <h2 class=" text-center"> Ajouter un utilisateur GSB : </h2>  <br>    
        <div>
        <form action="administrateur_ajout_insert_data.php" method="POST">
        <label> Nom <font color="FF0000">*</font> :             </label><INPUT TYPE="text" NAME="Nom" required="required">
        <label> Prénom <font color="FF0000">*</font> :          </label><INPUT TYPE="text" NAME="Prenom" required="required" ><br></br>
        <label> Mail <font color="FF0000">*</font> :            </label><INPUT TYPE="mail" NAME="Mail"  required="required">  <br></br>
        <label> Téléphone <font color="FF0000">*</font> :             </label><INPUT TYPE="float" NAME="Telephone" required="required"><br></br>
        <label> Mot de passe <font color="FF0000">*</font> :    </label><INPUT TYPE="password" NAME="Mdp" required="required"> <br></br>
        
        
        
        <label> Rôle <font color="FF0000">*</font> :
        <select name="Role" id="Role" required="required">
            <option>--- Choisissez un role ---</option>
            <option>Visiteur</option>
            <option>Responsable</option>
            <option>Comptable</option>
            <option>Admin</option>
        </select><font color="FF0000"> *</font><br></br>

        <input type="reset" value="Réinitialiser">
        <input type="submit" value="Ajouter" NAME="Ajouter" > <br>
        </form>';
        // FORMULAIRE AJOUT UTILISATEUR

      //REDIRECTION VERS ACCUEIL
        echo'<br><a href="administrateur_accueil.php" class="nvlff"> Retour </a><br>
        </div> ';
      //REDIRECTION VERS ACCUEIL
        echo'</div></div></div></div></main>
    </body>
    </html>';
}

?>


