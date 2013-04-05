<?php

/**
 * @file      sstheme.php
 * @author    Jocelyn SIMON
 * @version   1.0
 * @date      18 fevrier 2013
 * @brief     Definit les methodes du module soustheme.
 *
 * @details    Ce fichier permet de concentrer les methodes du module soustheme.
 */

/**
 * @brief      methode de selection des sous-theme  dans la base de donnees
 * 
 * @return    un tableau de sous-theme 
 * 
 */
function lister_sstheme_dans_bdd() {
    /** on instancie une nouvelle connexion a la base de donnees via la classe PDO2 */
    $pdo = PDO2::getInstance();

    /** on prépare notre requète avec les valeurs passes en parametre */
    $requete = $pdo->prepare("SELECT * FROM soustheme");

    /** j'execute cette requète */
    $requete->execute();
    /** j'initialise un tableau */
    $tab = array();

    /** pour chaque resultat retourné je l'ajoute dans mon tableau */
    while ($result = $requete->fetch(PDO::FETCH_OBJ)) {

        array_push($tab, $result);
    }

    $requete->closeCursor();

    /** je retourne un tableau d'objet news */
    return $tab;
}

/**
 * @brief      methode de selection du thème dans la base de donn�es
 * 
 * @param       $id_theme Integer Identifiant du theme
 * @return     un tableau de donn�es d'une personne 
 * 
 */
function selectionner_sstheme_dans_bdd($id_sstheme) {
    /** on instancie une nouvelle connexion a la base de donnees via la classe PDO2 */
    $pdo = PDO2::getInstance();

    /** on prepare notre requete avec les valeurs passes en parametre */
    $requete = $pdo->prepare("SELECT * FROM soustheme WHERE soustheme_id = :id_sstheme");

    $requete->bindValue(':id_sstheme', $id_sstheme);

    /** j'execute cette requete */
    $requete->execute();

    if ($result = $requete->fetch(PDO::FETCH_ASSOC)) {

        $requete->closeCursor();
        return $result;
    }

    /** je retourne un tableau d'objet theme */
    return $tab;
}

?>