<?php
    session_start();
    
    // SECURITE DE CONNEXION A LA PAGE
    if (!isset ($_SESSION['email']) || $_SESSION['role'] !=0)
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
        <h1 class=" text-center"> </h1>  
        <div class="fichefrais">';
    
    // FORMULAIRE DE SAISIE POUR NOUVELLE FICHE DE FRAIS 
    echo"
    <h2><strong> Saisie d'une nouvelle fiche de frais </strong> </h2>  <br>
    <form action='visiteur_insert_data.php' method='POST'>
        <fieldset> 
            <legend class='legend'> Période de déplacement  </legend>
            <legend> Date début: </legend>  <input type='date' name='dateDebut'  required>
            <legend> Date fin: </legend>  <input type='date' name='dateFin' required>
        </fieldset>

        <br/>

        <fieldset>  
            <legend class='legend'> Description </legend>
            <input type='text' name='description'  required>
        </fieldset>

        <br/>

        <fieldset>  
            <legend class='legend'> Saisie des frais d'hébergements </legend>
            <legend> Nombre de nuits </legend> <input type='number' name='nbNuit'step='1' >
            <legend> Prix total </legend> <input type='number' name='prixTotalNuit'  >
        </fieldset>

        <br/>

        <fieldset> 
            <legend class='legend'> Saisie des frais de restauration </legend>
            <legend> Nombre de repas </legend> <input type='number' name='nbRepas'step='1'  >
            <legend> Prix total </legend> <input type='number' name='prixTotalRepas' >
        </fieldset>

        <br/>

        <fieldset> 
            <legend class='legend'> Saisie des frais de déplacement </legend>
            <legend> Nombre de kilomètres  </legend> <input type='number' name='nbKm'step='1' >
            <label for='voiture_select'>Choisir un montant:</label>
            <select name='cv-select' id='cv-select' >
                <option value=''>-Veuillez choisir un montant en fonction de votre voiture-</option>
                <option value='4cv'>(Véhicule  4CV Diesel) 0.52 €/Km</option>
                <option value='5cv'>(Véhicule 5/6CV Diesel) 0.58 €/Km</option>
                <option value='6cv'>(Véhicule  4CV Essence) 0.62 €/Km</option>
                <option value='6cve'>(Véhicule 5/6CV Essence) 0.67 €/Km</option>
            </select>
        </fieldset>

        <br/>

        <fieldset> 
            <legend class='legend'> Saisie frais additionnel </legend>
            <legend> Description  </legend> <input type='textarea ' name='descriptionExtra'step='1' >
            <legend> Prix total </legend> <input type='number' name='prixExtra' value='' >
        </fieldset>
    
        <br>

        <input type='submit' name='Envoyer' value='Envoyer'> 

        <br>
        <br>

    </form>";
    // FORMULAIRE DE SAISIE POUR NOUVELLE FICHE DE FRAIS 

    // REDIRECTION VERS ACCUEIL
    echo'<br><a href="visiteur_accueil.php" class="nvlff"> Retour </a><br><br>';
    // REDIRECTION VERS ACCUEIL

    echo'</div></div></div></div></main>
    </body>
    </html>';
    }
?>
     