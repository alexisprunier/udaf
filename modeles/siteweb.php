<?php

/**
 * @file      siteweb.php
 * @author    Alexis PRUNIER
 * @version   1.0
 * @date      25 mars 2013
 * @brief     Defnit les m&eacute;thode de gestion site.
 *
 * @details    Ce fichier permet de d&eacute;finir les m&eacute;thode de suppression, de modification, d'ajout d'utilisateurs .
 */

/**
 * @brief      Permet l'ajout d'un site dans la base de donn&eacute;es
 * 
 * @param	$lien				varchar lien du site
 * @param	$dossier_id			varchar dossier lie au site
 * @return   True en cas de succes, False en cas d'echec
 */
function ajouter_site_dans_bdd($lien, $nom, $dossier_id) {
    $pdo = PDO2::getInstance();

    $requete = $pdo->prepare("INSERT INTO siteweb SET
				lien = :lien,
                                nom = :nom,
				dossier_id = :dossier_id");

    $requete->bindValue(':lien', $lien);
    $requete->bindValue(':nom', $nom);
    $requete->bindValue(':dossier_id', intval($dossier_id));

    if ($requete->execute()) {
        /** si l'insertion c'est bien passe la methode retourne le dernier id de l'utilisateur inser&eacute; */
        return $pdo->lastInsertId();
    }
    /** sinon elle retourne une erreur */
    return $requete->errorInfo();
}

/**
 * @brief      methode de selection des sites dans la base de donn&eacute;es
 * 
 * @return    un tableau de dossiers 
 * 
 */
function lister_site_dans_bdd() {
    /** on instancie une nouvelle connexion a la base de donn&eacute;es via la classe PDO2 */
    $pdo = PDO2::getInstance();

    /** on pr&eacute;pare notre requete avec les valeurs pass&eacute;s en parametre */
    $requete = $pdo->prepare("SELECT * FROM siteweb");

    /** j'execute cette requète */
    $requete->execute();
    /** j'initialise un tableau */
    $tab = array();

    /** pour chaque resultat retourn&eacute; je l'ajoute dans mon tableau */
    while ($result = $requete->fetch(PDO::FETCH_OBJ)) {

        array_push($tab, $result);
    }

    $requete->closeCursor();

    /** je retourne un tableau d'objet news */
    return $tab;
}
function supprimer_site_dans_bdd($id_site) {
    /** on instancie une nouvelle connexion a la base de donnees via la classe PDO2 */
    $pdo = PDO2::getInstance();

    /** on prépare notre requete avec les valeurs passés en parametre */
    $requete = $pdo->prepare("DELETE FROM siteweb where site_id = :id_site");

    $requete->bindValue(':id_site', $id_site);
    $requete->execute();

    if ($result = $requete->fetch(PDO::FETCH_ASSOC)) {

        print_r($result);
        $requete->closeCursor();
        return $result;
    }
    return $requete->errorInfo();
}
?>