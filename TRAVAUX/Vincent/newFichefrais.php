<?php
    session_start();
    $email=$_SESSION['email'];
    echo $email;
    ?>
<fieldset> 
                <legend> Date des frais </legend>
            </br/>
            <form action="insertFiche.php" method="POST">
                <legend> Saisie des informations </legend>
                <legend> Date début: </legend>  <input type="date" name="dateDebut" value="2017-06-01">
                <legend> Date fin: </legend>  <input type="date" name="dateFin"value="2022-06-01">
        </fieldset>
    <br/>
        <fieldset>  
                <legend> Saisie des frais </legend>
                <br/>

                <legend> Nombre de nuits </legend> <input type="number" name="nbNuit"step="1" value=0 required>
                <legend> Prix total </legend> <input type="number" name="prixTotalNuit" value=0 required>
        </fieldset>
    <br/>
        <fieldset> 
                <legend> Saisie des frais de restauration </legend>
                <br/>

                <legend> Nombre de repas </legend> <input type="number" name="nbRepas"step="1" value=0 required>
                <legend> Prix total </legend> <input type="number" name="prixTotalRepas"value=0 required>
        </fieldset>
    <br/>

        <fieldset> 
                <legend> Saisie des frais de déplacement </legend>
        <br/>
                 <legend> Nombre de kilomètres  </legend> <input type="number" name="nbKm"step="1" value=0 required>
                
                <label for="voiture_select">Choisir un montant:</label>
                <select name="cv-select" id="cv-select" required>
                    <option value="">-Veuillez choisir un montant en fonction de votre voiture-</option>
                    <option value="4cv">(Véhicule  4CV Diesel) 0.52 €/Km</option>
                    <option value="5cv">(Véhicule 5/6CV Diesel) 0.58 €/Km</option>
                    <option value="6cv">(Véhicule  4CV Essence) 0.62 €/Km</option>
                    <option value="6cve">(Véhicule 5/6CV Essence) 0.67 €/Km</option>
                </select>

        </fieldset>
        <br/>
        <fieldset> 
            <legend> Saisie frais additionnel </legend>
            <br/>

            <legend> Description  </legend> <input type="textarea " name="descriptionExtra"step="1" value ="rien  à déclarer">
            <legend> Prix total </legend> <input type="number" name="prixExtra" value=0 required>
          </fieldset>

        </fieldset>
        <input type="submit" name="Envoyer les informations" id="">
</form>
         </Fieldset>