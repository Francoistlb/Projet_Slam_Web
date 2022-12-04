<?php
session_start();
?>
<!DOCTYPE html>
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
              <img src="assets/images/logo_gsb.jpg" alt="login" class="login-card-img">
            </div>

            <div class="centrage col-md-7">
              <div class="card-body text-center">
               <!-- Ouverture de la session --> 
               <?php
                  if (!isset ($_SESSION['email']) && $_SESSION['role'] !=4)
                     {
                        echo "Vous n'êtes pas connecté";
                     } else {
                        $email=$_SESSION['email'];
                        echo "Bonjour $email <br> <br>";
                        echo "Profil administrateur <br> <br>";
                        echo "<a href='kill_session.php'> Déconnexion </a>" ;
                     }
                  ?>
              </div>
            </div>

          </div>
        </div>
      </div>
      <div class="contenu">
        <div class="ligne"></div>
        <div class="varelements">
          <h2 class=" text-center"> Modifier un utilisateur GSB : </h2>     
        
        <div>
        <p> ID utilisateur en cours de traitement :  <strong><?php echo $_GET['Id'];  ?></strong></p>
        <form ACTION="administrateur_modify_insert_data.php" method="get">       
        <INPUT TYPE="text" NAME="Id" VALUE=<?php echo $_GET['Id']?> hidden >
        <label> Mail  : </label><INPUT TYPE="mail" NAME="Mail" VALUE=<?php echo $_GET['Mail']?> >
        <label> Nom : </label><INPUT TYPE="text" NAME="Nom" VALUE=<?php echo $_GET['Nom']?> ><br></br>
        <label> Prénom : </label><INPUT TYPE="text" NAME="Pseudo" VALUE=<?php echo $_GET['Pseudo']?> >
        <label> N° Téléphone : </label><INPUT TYPE="text" NAME="Telephone" VALUE=<?php echo $_GET['Tel']?> ><br></br>
        <label> Rôle : </label>
        <select name="Role" id="Role" VALUE="Admin" required>
            <option>--- Choisissez un role ---</option>
            <option>Visiteur</option>
            <option>Commerciaux</option>
            <option>Responsable</option>
            <option>Comptable</option>
            <option>Admin</option>
        </select><br></br>

        <input type="submit" value="Modifier" NAME="Modifier" ><br><br>
    </form>
        </div> 
        <a href="administrateur_liste_user.php" class="nvlff"> Retour </a><br><br>

        </div>
      </div>
    </div>
  </main>
  
</body>
</html>




<body>

    

</body>

<?php echo $_GET['Id']?>
<?php echo $_GET['Mail']?>
<?php echo $_GET['Nom']?>
<?php echo $_GET['Pseudo']?>
<?php echo $_GET['Tel']?>
<?php echo $_GET['Role']?>