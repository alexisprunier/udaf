<?php

/**
 * @file      afficher_documentation.php
 * @author    
 * @version   1.0
 * @date      11 mars 2013
 * @brief     Controleur de la page documentation
 *
 * @details    Ce fichier est la partie controleur de la vue vue_documentation.php.
 */

if(isset($_GET['page']) && !empty($_GET['page'])) {
   
    $p = htmlentities($_GET['page']);
     
    switch($p) {
        case 'accueil': $contenu = 'Contenu de la page "accueil"';
        break;
        case 'creer_dossier': $contenu = 'Contenu de la page "creer_dossier"';
        break;
        case 'evenement': $contenu = 'Contenu de la page "evenement"';
        break;
        case 'stats': $contenu = 'Contenu de la page "stat"';
        break;
        default: $contenu = 'Page inconnue';
        break;
    }
     
    echo $contenu;
}
include CHEMIN_VUE . 'vue_documentation.html';
?>

