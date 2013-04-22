<?php
/**
 * @file      recuperer_stats.php
 * @author    Alexis PRUNIER
 * @version   1.0
 * @date      16 Avril 2012
 * @brief     Affichage des statistiques annuelles
 */

include CHEMIN_MODELE . 'evenement.php';
include CHEMIN_MODELE . 'dossier.php';

$tab_evenement = lister_evenement_dans_bdd();

$year = date(Y);
$tableau = array();

foreach ($tab_evenement as &$event){
    if ( substr($event->date_event, -4) == $year ) {
        $date_existe = false;
        for ( $i=0; $i<count($tableau); $i++ ) {
            if ( $tableau[$i]['date'] == $event->date_event ){
                $tableau[$i][$event->mode_contact] += 1;
                $tableau[$i]['total'] += 1;
                $obj = selectionner_dossier_dans_bdd($event->dossier_id);
                $tableau[$i][$obj['theme_id']] += 1;
                $date_existe = true;
            }
        }
        if ( !$date_existe ){
            $dossier = selectionner_dossier_dans_bdd($event->dossier_id);
            $nouv_ligne = array(
                'date' => $event->date_event,
                $event->mode_contact => 1,
                'total' => 1,
                $dossier['theme_id'] => 1);
            $tableau[count($tableau)] = $nouv_ligne;
        }
    }
}

include CHEMIN_VUE . 'vue_statistique.php';
?>
