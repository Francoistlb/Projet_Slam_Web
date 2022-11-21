<?php

session_start();

session_destroy();

header('location: index.php');
echo '<script language="Javascript">alert("Vous êtes déconnecté." )</script>';
exit();

?>