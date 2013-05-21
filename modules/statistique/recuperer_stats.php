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

// CREATE PDF FILE

require_once(CHEMIN_LIB.'pdf/phpToPDF.php');
require_once(CHEMIN_LIB.'pdf/fpdf.php');
require_once(CHEMIN_LIB.'pdf/pdfclass_stats.php');

$path = 'libs/pdf/export/statistiques.pdf';

$pdf = new PDF();
$pdf->AddPage('L');
$pdf->SetFont('Arial','',20);

$header = array('Date', 'RV', 'Tel', 'Mail', 'Total', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16');
$pdf->Write(30, "                                         Statistiques de ".$year." au ".date(d."-".m."-".Y)."\n");
$pdf->SetFont('courier','',9);
$pdf->Write(5, html_entity_decode(utf8_decode("1. Alimentation-Agriculture     5. Commerce                 9. Education-Société                         13. Logement-Immobilier\n")));
$pdf->Write(5, html_entity_decode(utf8_decode("2. Assurance                    6. Consumerisme             10 Energie(Electricité-Gaz)                  14. Loisir-tourisme\n")));
$pdf->Write(5, html_entity_decode(utf8_decode("3. Automobile-Transport         7. Droit-Justice            11. Environnement-Développement durable      15. Santé\n")));
$pdf->Write(5, html_entity_decode(utf8_decode("4. Banque-Argent                8. Economie                 12. Internet-Image-Son                       16. Sécurité Domestique\n")));
$pdf->Write(5, "\n");
$pdf->SetFont('Arial','',10);
$pdf->FancyTable($header, $tableau);
$pdf->Output($path);

include CHEMIN_VUE . 'vue_statistique.php';
?>
