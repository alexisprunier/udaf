<?php

$_SESSION = array();
session_unset();
session_destroy();

header('location: index.php?statut=logout');
?>

