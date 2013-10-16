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
include CHEMIN_MODELE . 'evenement.php';

$tab_utilisateur = lister_utilisateur_dans_bdd();
$event = selectionner_evenement_dans_bdd($_GET['id']);
$user = selectionner_utilisateur_dans_bdd($event["user_id"]);

include CHEMIN_VUE . 'formulaire_modifier_evenement.php';
?>
