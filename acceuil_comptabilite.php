<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Appli-Frais</title>
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
                  session_start();

                  if (!isset ($_SESSION['email']) && $_SESSION['role'] !=1)
                     {
                        echo "Vous n'êtes pas connecté";
                     } else {
                        $email=$_SESSION['email'];
                        echo "Bonjour $email <br> <br>";
                        echo "Profil comptable <br> <br>";
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
        <div>
          <h1 class=" text-center"> Saisir le code ci-dessous </h1>      
        </div>
      </div>
    </div>
  </main>
  
</body>
</html>

