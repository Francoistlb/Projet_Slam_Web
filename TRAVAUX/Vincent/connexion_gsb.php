<?php

    try {

        $bdd = new PDO('mysql:host=localhost;dbname=gsb;charset=utf8', 'root', '');

        // echo 'accès avec succès à  la base de données ';
    } catch (Exception $e) {

        die('Erreur : ' . $e->getMessage());
    }

?>