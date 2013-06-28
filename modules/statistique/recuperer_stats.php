<?php
/**
 * @file      recuperer_stats.php
 * @author    Alexis PRUNIER
 * @version   1.0
 * @date      16 Avril 2012
 * @brief     Affichage des statistiques
 */

include CHEMIN_MODELE . 'evenement.php';
include CHEMIN_MODELE . 'dossier.php';

$tab_evenement = lister_evenement_dans_bdd();
$tab_dossier = lister_dossier_dans_bdd();

$year = date(Y);
$tableau = array();

foreach ($tab_dossier as &$dossier){
    $nouv_ligne = array(
        'dossier_id' => $dossier->dossier_ref,
        'date_crea' => $dossier->date_creation_d,
        'date_clot' => $dossier->date_cloture,
        'Rendez-vous' => 0,
        'Téléphone' => 0,
        'e-Mail' => 0,
        'Courrier' => 0,
        '1' => $dossier->theme_id == 1 ? 1 : 0,
        '2' => $dossier->theme_id == 2 ? 1 : 0,
        '3' => $dossier->theme_id == 3 ? 1 : 0,
        '4' => $dossier->theme_id == 4 ? 1 : 0,
        '5' => $dossier->theme_id == 5 ? 1 : 0,
        '6' => $dossier->theme_id == 6 ? 1 : 0,
        '7' => $dossier->theme_id == 7 ? 1 : 0,
        '8' => $dossier->theme_id == 8 ? 1 : 0,
        '9' => $dossier->theme_id == 9 ? 1 : 0,
        '10' => $dossier->theme_id == 10 ? 1 : 0,
        '11' => $dossier->theme_id == 11 ? 1 : 0,
        '12' => $dossier->theme_id == 12 ? 1 : 0,
        '13' => $dossier->theme_id == 13 ? 1 : 0,
        '14' => $dossier->theme_id == 14 ? 1 : 0,
        '15' => $dossier->theme_id == 15 ? 1 : 0,
        '16' => $dossier->theme_id == 16 ? 1 : 0, 
    );

    foreach ($tab_evenement as &$evenement){
        if ($dossier->dossier_ref == $evenement->dossier_id){
            $nouv_ligne[$evenement->mode_contact] += 1;
        }
    }

    $tableau[count($tableau)] = $nouv_ligne;
}

// CREATE XSL FILE

include CHEMIN_LIB . 'excel/PHPExcel.php';
include CHEMIN_LIB . 'excel/PHPExcel/Writer/Excel5.php';
require_once CHEMIN_LIB . 'excel/PHPExcel/IOFactory.php';

$objPHPExcel = new PHPExcel();

//– On nomme notre feuille
$objPHPExcel->setActiveSheetIndex(0);
$sheet=$objPHPExcel->getActiveSheet();
$sheet->setTitle('Statistiques OGconso');

$sheet->SetCellValue('B1', 'ID');
$sheet->SetCellValue('C1', 'Date de création');
$sheet->SetCellValue('D1', 'Date de clôture');
$sheet->SetCellValue('E1', 'Rendez-vous');
$sheet->SetCellValue('F1', 'Téléphone');
$sheet->SetCellValue('G1', 'Mail');
$sheet->SetCellValue('H1', 'Courrier');
$sheet->SetCellValue('I1', 'Alimentation-Agriculture');
$sheet->SetCellValue('J1', 'Assurance');
$sheet->SetCellValue('K1', 'Automobile-Transport');
$sheet->SetCellValue('L1', 'Banque-Argent');
$sheet->SetCellValue('M1', 'Commerce');
$sheet->SetCellValue('N1', 'Consumérisme');
$sheet->SetCellValue('O1', 'Droit-Justice');
$sheet->SetCellValue('P1', 'Economie');
$sheet->SetCellValue('Q1', 'Education-Société');
$sheet->SetCellValue('R1', 'Energie(Electricité-Gaz)');
$sheet->SetCellValue('S1', 'Environnement-Dévelopement durable');
$sheet->SetCellValue('T1', 'Internet-Image-Son');
$sheet->SetCellValue('U1', 'Logement-Immobilier');
$sheet->SetCellValue('V1', 'Loisir-Tourisme');
$sheet->SetCellValue('W1', 'Santé');
$sheet->SetCellValue('X1', 'Sécurité domestique');

$i=0;
foreach($tableau as $key => $value){
    $sheet->SetCellValue('A'.($i+2), $key);
    $j=B;
    foreach($value as $k => $v){
        $sheet->SetCellValue($j.($i+2), $v);
        $j++;
    }
    $i++;
}

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save(CHEMIN_LIB . 'excel/export/statistiques.xlsx');

include CHEMIN_VUE . 'vue_statistique.php';
?>
