<?php
/**
 * @file      creer_evenement.php
 * @author    
 * @version   1.0
 * @date      30 janvier 2012
 * @brief     Controleur de la page d'ajout d'un evenement.
 *
 * @details    Ce fichier est la partie controleur de la vue formulaire_creation_evenement.php.
 */
include CHEMIN_MODELE . 'utilisateur.php';

$tab_utilisateur = lister_utilisateur_dans_bdd();


include CHEMIN_VUE . 'formulaire_creation_evenement.php';
?>
