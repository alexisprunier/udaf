<?php

// Initialisation
include_once 'config/init.php';

// V�rification des droits d'acc�s de la page
if ($_SESSION['auth'] != 1) {
    header('location: index.php?erreur=error');
}

// D�but de la tamporisation de sortie
ob_start();

// Si un module est specifi�, on regarde s'il existe
if (!empty($_GET['module'])) {

    $module = dirname(__FILE__) . '/modules/' . $_GET['module'] . '/';

    // Si l'action est specifi�e, on l'utilise, sinon, on tente une action par d�faut
    $action = (!empty($_GET['action'])) ? $_GET['action'] . '.php' : 'index.php';

    // Si l'action existe, on l'ex�cute
    if (is_file($module . $action)) {

        include $module . $action;

        // Sinon, on affiche la page d'accueil !
    } else {

        include 'config/vide.php';
    }

// Module non specifi� ou invalide ? On affiche la page d'accueil !
} else {

    include 'config/vide.php';
}

// Fin de la tamporisation de sortie
$contenu = ob_get_clean();

// D�but du code HTML
include 'config/haut.php';

echo $contenu;
?>


<?php

// Fin du code HTML
include 'config/bas.php';
?>