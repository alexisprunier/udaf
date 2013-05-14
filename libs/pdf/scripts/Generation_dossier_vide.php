<?php

// Génération du dossier en pdf

require_once(CHEMIN_LIB.'pdf/phpToPDF.php');
require_once(CHEMIN_LIB.'pdf/fpdf.php');
require_once(CHEMIN_LIB.'pdf/pdfclass.php');

$path = 'libs/pdf/export/dossier_vierge.pdf';

$pdf = new PDF();

$pdf->SetDrawColor(200 , 200, 200);
$pdf->AddPage('');
$pdf->Image('images/logo/LogoUDAF_fond_blanc.png', 30, 100, 150); 
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
  ..........................................
  ..........................................
  ..........................................
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
$pdf->SetXY(145, 60);
$pdf->MultiCell(80,7,html_entity_decode(utf8_decode('
  ....................................
  ....................................
  ....................................
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
  ................................................................
  ................................................................
  ................................................................
  ................................................................
  ................................................................
  ................................................................
  ................................................................
  ................................................................

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
  ................................................................
  ................................................................
  ................................................................
  ................................................................
  ................................................................
  ................................................................
  ................................................................
  ................................................................
  ................................................................
')),0);

$pdf->AddPage('');
$pdf->Image('images/logo/LogoUDAF_fond_blanc.png', 30, 100, 150); 
$pdf->SetFont('arial','B',14);
$pdf->SetXY(20, 50);
$pdf->MultiCell(80,5,html_entity_decode(utf8_decode('
      Fichiers :
')),0);
$pdf->SetFont('arial','',10);
$pdf->SetXY(20, 60);
$pdf->MultiCell(80,6,html_entity_decode(utf8_decode('
  Fichier 1 :
  Fichier 2 :
  Fichier 3 :
  Fichier 4 :
  Fichier 5 :
  Fichier 6 :

')),1);
$pdf->SetFont('arial','',12);
$pdf->SetXY(50, 60);
$pdf->MultiCell(80,6,html_entity_decode(utf8_decode('
  ...................................
  ...................................
  ...................................
  ...................................
  ...................................
  ...................................
')),0);
$pdf->SetFont('arial','B',14);
$pdf->SetXY(110, 50);
$pdf->MultiCell(80,5,html_entity_decode(utf8_decode('
      Sites web :
')),0);
$pdf->SetFont('arial','',10);
$pdf->SetXY(110, 60);
$pdf->MultiCell(80,6,html_entity_decode(utf8_decode('
  Nom site 1 :
  Lien site 1 :
  Nom site 2 :
  Lien site 2 :
  Nom site 3 :
  Lien site 3 :

')),1);
$pdf->SetFont('arial','',12);
$pdf->SetXY(140, 60);
$pdf->MultiCell(80,6,html_entity_decode(utf8_decode('
  ...................................
  ...................................
  ...................................
  ...................................
  ...................................
  ...................................
')),0);
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
$pdf->SetFont('arial','',12);
$pdf->SetXY(80, 118);
$pdf->MultiCell(150,6,html_entity_decode(utf8_decode('
  .........................................................................
  .........................................................................
  .........................................................................
  .........................................................................

')),0);
$pdf->SetFont('arial','B',10);
$pdf->SetXY(20, 175);
$pdf->MultiCell(170,5,html_entity_decode(utf8_decode('
   Date :
   Utilisateur :
   Mode de contact :
   Traité :
   Commentaire :
   

   
')),1);
$pdf->SetFont('arial','',12);
$pdf->SetXY(80, 173);
$pdf->MultiCell(150,6,html_entity_decode(utf8_decode('
  .........................................................................
  .........................................................................
  .........................................................................
  .........................................................................

')),0);
$pdf->SetFont('arial','B',10);
$pdf->SetXY(20, 230);
$pdf->MultiCell(170,5,html_entity_decode(utf8_decode('
   Date :
   Utilisateur :
   Mode de contact :
   Traité :
   Commentaire :
   

   
')),1);
$pdf->SetFont('arial','',12);
$pdf->SetXY(80, 228);
$pdf->MultiCell(150,6,html_entity_decode(utf8_decode('
  .........................................................................
  .........................................................................
  .........................................................................
  .........................................................................

')),0);





$pdf->Output($path);
?>
