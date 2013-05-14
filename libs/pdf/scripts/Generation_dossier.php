<?php

// Génération du dossier en pdf

require_once(CHEMIN_LIB.'pdf/phpToPDF.php');
require_once(CHEMIN_LIB.'pdf/fpdf.php');
require_once(CHEMIN_LIB.'pdf/pdfclass.php');

$path = 'libs/pdf/export/dossier_'.$_SESSION['dossier_ref'].'.pdf';

$pdf = new PDF();

$pdf->SetDrawColor(200 , 200, 200);
$pdf->AddPage('');

$pdf->SetFont('arial','B',14);
$pdf->SetXY(20, 50);
$pdf->MultiCell(170,5,html_entity_decode(utf8_decode('
      Informations du Dossier :
')),0);
$pdf->SetFont('arial','B',10);
$pdf->SetXY(20, 60);
$pdf->MultiCell(80,7,html_entity_decode(utf8_decode('
  Propriétaire :
  Thème :
  Sous-thème :
  Commentaire :
  


')),1);
$pdf->SetFont('arial','',10);
$pdf->SetXY(50, 60);
$pdf->MultiCell(80,7,html_entity_decode(utf8_decode('
  '.$utilisateur['prenom'].' '.$utilisateur['nom'].'
  '.$theme['nom'].'
  '.$soustheme['nom'].'
')),0);
$pdf->SetFont('arial','',10);
$pdf->SetXY(25, 95);
$pdf->MultiCell(70,5,html_entity_decode(utf8_decode('super texte de oufffffffffff fffffff ffff ffffffffffff fffff ffffff ffffffffff fffffffffffffff ffffffffffffff fffffffff
')),0);
$pdf->SetFont('arial','B',10);
$pdf->SetXY(110, 60);
$pdf->MultiCell(80,7,html_entity_decode(utf8_decode('
  Cloturé :
  Raison de clôture :
  Date de clôture :
  Commentaire :
  


')),1);
$pdf->SetFont('arial','',10);
$pdf->SetXY(150, 60);
$pdf->MultiCell(80,7,html_entity_decode(utf8_decode('
  cloture
  raison
  date
')),0);
$pdf->SetFont('arial','',10);
$pdf->SetXY(115, 95);
$pdf->MultiCell(70,5,html_entity_decode(utf8_decode('super texte de oufffffffffff fffffff ffff ffffffffffff fffff ffffff ffffffffff fffffffffffffff ffffffffffffff fffffffff
')),0);
$pdf->SetFont('arial','B',14);
$pdf->SetXY(20, 120);
$pdf->MultiCell(160,5,html_entity_decode(utf8_decode('
      Informations du Client :
  
')),0);
$pdf->SetFont('arial','B',12);
$pdf->SetXY(20, 130);
$pdf->MultiCell(170,6,html_entity_decode(utf8_decode('
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
$pdf->SetXY(100, 130);
$pdf->MultiCell(80,6,html_entity_decode(utf8_decode('
  oui
  non
  oui
  non
  oui
  non
  oui
  non

')),0);
$pdf->SetFont('arial','B',14);
$pdf->SetXY(20, 190);
$pdf->MultiCell(160,5,html_entity_decode(utf8_decode('
      Informations du Fournisseur :
  
')),0);
$pdf->SetFont('arial','B',12);
$pdf->SetXY(20, 200);
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
$pdf->SetXY(100, 200);
$pdf->MultiCell(80,6,html_entity_decode(utf8_decode('
  oui
  non
  oui
  non
  oui
  non
  oui
  non
')),0);

$pdf->AddPage('');

$pdf->SetFont('arial','B',14);
$pdf->SetXY(20, 50);
$pdf->MultiCell(80,5,html_entity_decode(utf8_decode('
      Fichiers :
')),0);
$pdf->SetFont('arial','',10);
$pdf->SetXY(20, 60);
$pdf->MultiCell(80,6,html_entity_decode(utf8_decode('
  Nom :
  reg
  dsf
  zreg
  gerg
  egz

')),1);
$pdf->SetFont('arial','B',14);
$pdf->SetXY(110, 50);
$pdf->MultiCell(80,5,html_entity_decode(utf8_decode('
      Sites web :
')),0);
$pdf->SetFont('arial','',10);
$pdf->SetXY(110, 60);
$pdf->MultiCell(80,6,html_entity_decode(utf8_decode('
  Nom :
  reg
  dsf
  zreg
  gerg
  egz

')),1);
$pdf->SetFont('arial','B',14);
$pdf->SetXY(20, 110);
$pdf->MultiCell(80,5,html_entity_decode(utf8_decode('
      Evénements :
')),0);
$pdf->SetFont('arial','B',10);
$pdf->SetXY(20, 120);
$pdf->MultiCell(170,5,html_entity_decode(utf8_decode('
   Date :
   Utilisateur :
   Mode de contact :
   Traité :
   Commentaire :
   

   
')),1);





$pdf->Output($path);
?>
