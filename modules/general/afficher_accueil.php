<?php

/**
 * @file      aficcher_accueil.php
 * @author    
 * @version   1.0
 * @date      11 mars 2013
 * @brief     Controleur de la page accueil
 *
 * @details    Ce fichier est la partie controleur de la vue vue_accueil.php.
 */
include CHEMIN_MODELE . 'evenement.php';
include CHEMIN_MODELE . 'dossier.php';
include CHEMIN_MODELE . 'personne.php';
include CHEMIN_MODELE . 'utilisateur.php';

$tab_evenement = lister_evenement_dans_bdd();

$lignes_tableau = array();

// on récupère les informations tous les dossiers
foreach ($tab_evenement as &$evenement) {

    $dossier = selectionner_dossier_dans_bdd($evenement->dossier_id);
    $personne = selectionner_personne_dans_bdd($dossier['personne_id']);
    $utilisateur = selectionner_utilisateur_dans_bdd($evenement->user_id);

    $ligne = array(
        'date_evenement' => $evenement->date_event,
        'mode_contact' => $evenement->mode_contact,
        'personne_nom' => $personne['nom'],
        'personne_prenom' => $personne['prenom'],
        'utilisateur' => $utilisateur['ident'],
        'id_utilisateur' => $utilisateur['user_id'],
    );

//On ajoute la ligne créé ($ligne) dans le tableau ($ligne_tableau)
    array_push($lignes_tableau, $ligne);
}


include CHEMIN_VUE . 'vue_accueil.php';
?>

