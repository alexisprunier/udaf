<?php

/**
 * @file      generer_dossier.php
 * @author    
 * @version   1.0
 * @date      11 mars 2013
 * @brief     Controleur de la page generer dossier vierge
 *
 */
 
/** On veut utiliser le modèle des dossiers (~/modules/dossier.php)*/
include CHEMIN_MODELE.'generation_dossier.php';

include CHEMIN_VUE.'vue_genere_dossier.php';

if (isset($_GET["generer"]) && $_GET["generer"]=="ok") 
	{ 
			$id_dossier = generer_dossier_vierge();
			
			echo $id_dossier;
          
          /** Si la base de données a bien voulu archiver le entretien (pas de doublons)*/
          if ($id_dossier==true) 
          {                
		    /** Affichage de la confirmation d'insertion */
		    header('location: accueil.php?module=general&action=generer_dossier&generation=ok')  ;     
		          
          } 
          else/** Gestion des doublons */
          {
          	    include CHEMIN_VUE.'vue_genere_dossier.php';
          }
	}
?>

