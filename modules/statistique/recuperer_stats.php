<?php
/**
 * @file      recuperer_stats.php
 * @author    Alexis PRUNIER
 * @version   1.0
 * @date      16 Avril 2012
 * @brief     Affichage des statistiques annuelles
 */

include CHEMIN_MODELE . 'evenement.php';

$tab_evenement = lister_evenement_dans_bdd();

$year = date(Y);

foreach ($$tab_evenement as &$event){
    if ( substr($event->dossier_id, 0, 4) == $year ) {
        
    }
}









include CHEMIN_VUE . 'vue_statistique.php';
?>
