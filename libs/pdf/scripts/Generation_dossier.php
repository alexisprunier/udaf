<?php
$NB_EVENEMENTS = 3;
// Génération du dossier en pdf
require_once(CHEMIN_LIB.'pdf/phpToPDF.php');
require_once(CHEMIN_LIB.'pdf/fpdf.php');
require_once(CHEMIN_LIB.'pdf/pdfclass.php');

$path = 'libs/pdf/export/dossier_'.$_SESSION['dossier_ref'].'.pdf';

$pdf = new PDF();

$pdf->SetDrawColor(200 , 200, 200);
$pdf->AddPage('');

$pdf->Image('images/logo/LogoUDAF_fond_blanc.png', 30, 100, 150);

$pdf->SetFont('arial','B',14);
$pdf->SetXY(20, 40);
$pdf->MultiCell(170,5,html_entity_decode(utf8_decode('
      Clôture du dossier :
')),0);
$pdf->SetFont('arial','B',10);
$pdf->SetXY(20, 50);
$pdf->MultiCell(170,7,html_entity_decode(utf8_decode('
    Cloturé :
    Raison de clôture :
    Date de clôture :
    Commentaire :  
  


')),1);
//Pointilés info cloture
$pdf->SetFont('arial','',10);
$pdf->SetXY(65, 50);
$pdf->MultiCell(170,7,html_entity_decode(utf8_decode('
  '.$is_cloture.'
  '.$dossier_select['raison_cloture'].'
  '.$dossier_select['date_cloture'].'
')),0);
//Pointilés commentaire de cloture
$pdf->SetFont('arial','',10);
$pdf->SetXY(20, 76);
$pdf->MultiCell(170,7,html_entity_decode(utf8_decode(
$dossier_select['comment_cloture']
)),0);

$pdf->SetFont('arial','B',14);
$pdf->SetXY(20, 105);
$pdf->MultiCell(170,5,html_entity_decode(utf8_decode('
      Informations du Dossier :
')),0);
$pdf->SetFont('arial','B',10);
$pdf->SetXY(20, 115);
$pdf->MultiCell(170,7,html_entity_decode(utf8_decode('
  Date de création :
  Propriétaire :
  Thème :
  Sous-thème :
  Problématique :
  
















')),1);
$pdf->SetFont('arial','',10);
$pdf->SetXY(55, 115);
$pdf->MultiCell(150,7,html_entity_decode(utf8_decode('
  '.$dossier_select['date_creation_d'].'
  '.$utilisateur['prenom'].' '.$utilisateur['nom'].'
  '.$theme['nom'].'
  '.$sstheme['nom'].'
')),0);
//Pointillés problématique
$pdf->SetFont('arial','',10);
$pdf->SetXY(25, 161);
$pdf->MultiCell(160,7,html_entity_decode(utf8_decode(
    $dossier_select['problematique']
)),0);
$pdf->AddPage('');
$pdf->Image('images/logo/LogoUDAF_fond_blanc.png', 30, 100, 150);

$pdf->SetFont('arial','B',14);
$pdf->SetXY(20, 40);
$pdf->MultiCell(160,5,html_entity_decode(utf8_decode('
      Informations du Client :
  
')),0);
$pdf->SetFont('arial','B',12);
$pdf->SetXY(20, 50);
$pdf->MultiCell(170,7,html_entity_decode(utf8_decode('
  Nom :
  Prénom :
  Adresse :
  Code Postal :
  Ville :
  Mail :
  Téléphone :
  Téléphone Mobile :

')),1);
$pdf->SetFont('arial','',12);
$pdf->SetXY(60, 50);
$pdf->MultiCell(150,7,html_entity_decode(utf8_decode('
  '.$client['nom'].'
  '.$client['prenom'].'
  '.$client['adr_postale'].'
  '.$client['code_postal'].'
  '.$client['ville'].'
  '.$client['mail'].'
  '.$client['tel_fixe'].'
  '.$client['tel_port'].'
')),0);

$pdf->SetFont('arial','B',14);
$pdf->SetXY(20, 120);
$pdf->MultiCell(160,5,html_entity_decode(utf8_decode('
      Informations du Fournisseur :
  
')),0);
$pdf->SetFont('arial','B',12);
$pdf->SetXY(20, 130);
$pdf->MultiCell(170,6,html_entity_decode(utf8_decode('
  Nom :
  Prénom :
  Raison Sociale :
  Adresse :
  Code Postal :
  Ville :
  Mail :
  Téléphone :
  Commentaire :

')),1);
$pdf->SetFont('arial','',12);
$pdf->SetXY(60, 130);
$pdf->MultiCell(150,6,html_entity_decode(utf8_decode('
  '.$fournisseur['nom'].'
  '.$fournisseur['prenom'].'
  '.$fournisseur['raison_sociale'].'
  '.$fournisseur['adr_postale'].'
  '.$fournisseur['code_postal'].'
  '.$fournisseur['ville'].'
  '.$fournisseur['mail'].'
  '.$fournisseur['tel'].'
  '.$fournisseur['tel_port'].'
  '.$fournisseur['comment_fournisseur'].'
')),0);

$pdf->SetFont('arial','B',14);
$pdf->SetXY(20, 200);
$pdf->MultiCell(80,5,html_entity_decode(utf8_decode('
      Fichiers :
')),0);
$pdf->SetFont('arial','',10);
$pdf->SetXY(20, 210);
$pdf->MultiCell(85,6,html_entity_decode(utf8_decode('
  Fichier 1 :
  Fichier 2 :
  Fichier 3 :
  Fichier 4 :
  Fichier 5 :
  Fichier 6 :

')),1);
$hauteur_fichier = 216;
foreach ($tab_fichier as &$fichier) {
    if ($fichier->dossier_id == $_SESSION['dossier_ref']) {
        $pdf->SetFont('arial','',10);
        $pdf->SetXY(40, $hauteur_fichier);
        $hauteur_fichier += 6;
        $pdf->MultiCell(80,6,html_entity_decode(utf8_decode($fichier->nom)),0);
    }
}
$pdf->SetFont('arial','B',14);
$pdf->SetXY(110, 200);
$pdf->MultiCell(80,5,html_entity_decode(utf8_decode('
      Sites web :
')),0);
$pdf->SetFont('arial','',10);
$pdf->SetXY(110, 210);
$pdf->MultiCell(80,6,html_entity_decode(utf8_decode('
  Nom site 1 :
  Lien site 1 :
  Nom site 2 :
  Lien site 2 :
  Nom site 3 :
  Lien site 3 :

')),1);
$hauteur_fichier = 216;
$i = 0;
foreach ($tab_site as &$site) {
    if ($site->dossier_id == $_SESSION['dossier_ref'] && i < 3) {
        $pdf->SetFont('arial','',10);
        $pdf->SetXY(140, $hauteur_fichier);
        $pdf->MultiCell(80,6,html_entity_decode(utf8_decode($site->nom)),0);
        $pdf->SetXY(140, $hauteur_fichier+6);
        $pdf->MultiCell(80,6,html_entity_decode(utf8_decode($site->lien)),0);
        $hauteur_fichier += 12;
        $i += 1;
    }
}
foreach ($tab_evenement as &$evenement) {
    if ($evenement->dossier_id == $_SESSION['dossier_ref']) {
        $is_traite = $evenement->traite == 1 ? "Oui" : "Non";
        $user_ev = selectionner_utilisateur_dans_bdd($evenement->user_id);

        $pdf->AddPage('');
        $pdf->Image('images/logo/LogoUDAF_fond_blanc.png', 30, 100, 150);

        $pdf->SetFont('arial','B',14);
        $pdf->SetXY(20, 40);
        $pdf->MultiCell(80,5,html_entity_decode(utf8_decode('
              Evénements :
        ')),0);
        $pdf->SetFont('arial','',12);
        $pdf->SetXY(20, 50);
        $pdf->MultiCell(170,7,html_entity_decode(utf8_decode('
          Date :
          Utilisateur :
          Mode de contact :
          Traité :
          Commentaire :

























            ')),1);
            $pdf->SetFont('arial','',12);
            $pdf->SetXY(53, 50);
            $pdf->MultiCell(150,7,html_entity_decode(utf8_decode('
                '.$evenement->date_event.'
                '.$user_ev['nom'].' '.$user_ev['prenom'].'
                '.$evenement->mode_contact.'
                '.$is_traite.'
            ')),0);
            $pdf->SetFont('arial','',10);
            $pdf->SetXY(25, 95);
            $pdf->MultiCell(160,7,html_entity_decode(utf8_decode($evenement->comm_event)),0);
    }
}
$pdf->Output($path);
?>