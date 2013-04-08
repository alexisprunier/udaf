<?php
include CHEMIN_MODELE . 'evenement.php';
include CHEMIN_MODELE . 'personne.php';
include CHEMIN_MODELE . 'dossier.php';

$tab_evenement = lister_evenement_dans_bdd();

$lignes_tableau = array();

foreach ($tab_evenement as &$evenement){
    
    if ($evenement->user_id == $_SESSION['id']){
        $dossier = selectionner_dossier_dans_bdd($evenement->dossier_id);
        $personne = selectionner_personne_dans_bdd($dossier['personne_id']);
        
        $ligne = array(
            'n_dossier' => $dossier['dossier_ref'],
            'nom' => $personne['nom'],
            'prenom' => $personne['prenom'],
            'mode_contact' => $evenement->mode_contact,
            'date' => $evenement->date_event,
        );

        array_push($lignes_tableau, $ligne);
        
    }
}

include CHEMIN_VUE . 'vue_calendrier.php';
?>