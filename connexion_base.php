<?php

try {
   $bdd = new PDO ('mysql:host=localhost;dbname=gsb;','root','');
   $bdd -> setAttribute (PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
   $bdd -> exec("set character set utf8");
}
catch (exception $e){
   die ('Erreur:'.$e -> getMessage());
}
?>
