<?php

/**
 * @file      generation_dossier.php
 * @author    
 * @version   1.0
 * @date      18 mars 2013
 * @brief     Defnit les m&eacute;thode de generation dossier vierge.
 *
 */

 /**
 * @brief      méthode de generation de PDF pour l'export de dossier vierge
 * 
 * 
 */
function generer_dossier_vierge() 
{
	include CHEMIN_LIB.'pdf/phpToPDF.php';
	
	while (ob_get_level())
		ob_end_clean();
		header("Content-Encoding: None", true); //regle le soucis de fpdf Output
	$PDF=new phpToPDF();
	$PDF->SetFont('Arial','',10);
	$PDF->Addpage('L');
	
	// Définition des propriétés du tableau.
	$proprietesTableau = array(
	'TB_ALIGN' => 'L',
	'L_MARGIN' => -5,
	'BRD_COLOR' => array(0,0,0),
	'BRD_SIZE' => '0.1',
	);
	
	// Définition des propriétés du header du tableau.	
	$proprieteHeader = array(
	'T_COLOR' => array(0,0,0),
	'T_SIZE' => 8,
	'T_FONT' => 'Arial',
	'T_ALIGN' => 'C',
	'V_ALIGN' => 'C',
	'T_TYPE' => 'I',
	'LN_SIZE' => 6,
	'BG_COLOR_COL0' => array(225,225,225),
	'BG_COLOR' => array(225,225,225),
	'BRD_COLOR' => array(255,255,255),
	'BRD_SIZE' => 0.1,
	'BRD_TYPE' => '1',
	'BRD_TYPE_NEW_PAGE' => '',
	);
	
	// Contenu du header du tableau.	
	$contenuHeader = array(
	22, 20, 8, 20, 24, 33, 33, 30, 35, 10, 10, 44,
	"Nom", "Type", "Int.", "Ref.", "Num. Serie", "Société (Propriétaire)", "Utilisateur (Agence)", "Lieu", "Batterie", "Volt", "Etat", "Observations",
	);

	// Définition des propriétés du reste du contenu du tableau.	
	$proprieteContenu = array(
	'T_COLOR' => array(0,0,0),
	'T_SIZE' => 7,
	'T_FONT' => 'Arial',
	'T_ALIGN_COL0' => 'L',
	'T_ALIGN' => 'R',
	'V_ALIGN' => 'M',
	'T_TYPE' => '',
	'LN_SIZE' => 6,
	'BG_COLOR_COL0' => array(255,255,255),
	'BG_COLOR' => array(255,255,255),
	'BRD_COLOR' => array(0,0,0),
	'BRD_SIZE' => 0.1,
	'BRD_TYPE' => '1',
	'BRD_TYPE_NEW_PAGE' => '',
	);
	
	$PDF->Cell(277,7,"Liste des matériels",1,1,'C'); 
	
	/** on écrit la requête sql et on l'execute*/
	//$result =mysql_query("SELECT * FROM listemateriel");	
	$result =mysql_query("SELECT soc.IDSociete, soc.SO_RaisonSociale, user.IDUtilisateur, user.Prenom, lm.Nom, lm.NumeroInterne, lm.Reference, lm.NumeroSerie, lm.LieuAffectation, lm.NumeroSerie, lm.ReferenceBatterie, lm.TensionBatterie, lm.Etat, lm.Observations, lm.Type_Machine_IDType_Machine, lm.Societe_IDSociete FROM societe AS soc, utilisateur AS user, listemateriel AS lm WHERE lm.Utilisateur_IDUtilisateur = user.IDUtilisateur AND lm.Societe_IDSociete = soc.IDSociete ORDER BY soc.SO_RaisonSociale ASC");	
	$count = mysql_query("SELECT COUNT(*) FROM listemateriel");
	
	$contenuTableau = array();
	while($tab = mysql_fetch_array($result))
	{
		if($tab['Type_Machine_IDType_Machine'] == 1) {
			$type = 'Accompagnée';
		} else if($tab['Type_Machine_IDType_Machine'] == 2) {
			$type = 'Autoportée';
		} else if($tab['Type_Machine_IDType_Machine'] == 3) {
			$type = 'A câble';
		} else {
			$type = 'Autre type';
		}
		// Contenu du tableau.	
		array_push($contenuTableau, $tab['Nom'], $type, $tab['NumeroInterne'], $tab['Reference'], $tab['NumeroSerie'], $tab['SO_RaisonSociale'], $tab['Prenom'], $tab['LieuAffectation'], 
		$tab['ReferenceBatterie'], $tab['TensionBatterie'], $tab['Etat'], $tab['Observations']);
	}
	$PDF->drawTableau($PDF, $proprietesTableau, $proprieteHeader, $contenuHeader, $proprieteContenu, $contenuTableau);
	
	$resultat=mysql_fetch_row($count);
	
	$PDF->Write(10, $resultat[0].' matériels');
	$PDF->Output();
	
	/** on ferme la connexion */
	mysql_close(); 
}