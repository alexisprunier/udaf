<?php

/**
 * @file      fournisseur.php
 * @author    Jocelyn SIMON
 * @version   1.0
 * @date      18 fevrier 2013
 * @brief     Definit les methodes du module fournisseur.
 *
 * @details    Ce fichier permet de concentrer les methodes du module fournisseur.
 */

/**
 * @brief      methode de selection des fournisseurs dans la base de donnees
 * 
 * @return    un tableau de fournisseurs 
 * 
 */
function lister_fournisseur_dans_bdd() {
    /** on instancie une nouvelle connexion a la base de donnees via la classe PDO2 */
    $pdo = PDO2::getInstance();

    /** on prepare notre requete avec les valeurs passes en parametre */
    $requete = $pdo->prepare("SELECT * FROM fournisseur");

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
 * @brief      Permet l'ajout d'un fournisseur dans la base de donnees
 * 
 * @param	$nom				string nom du fournisseur
 * @param	$prenom				string prenom du fournisseur
 * @param	$raison				string raison sociale du fournisseur
 * @param	$adr_postale		string adresse du fournisseur
 * @param	$code_postal		integer code postal du fournisseur
 * @param	$ville				string lieu de vie du fournisseur
 * @param	$mail				string mail du fournisseur
 * @param	$tel				integer telephone du fournisseur
 * @param	$commentaire		string commentaire fournisseur
 * @return   True en cas de succes, False en cas d'echec
 */
function ajouter_fournisseur_dans_bdd($date_crea_f, $nom, $prenom, $raison, $adr_postale, $code_postal, $ville, $tel, $mail, $commentaire) {
    $pdo = PDO2::getInstance();

    $requete = $pdo->prepare("INSERT INTO fournisseur SET
            date_creation_f = :date_creation_f,
            nom = :nom,
            prenom = :prenom,
            raison_sociale = :raison_sociale,
            adr_postale = :adr_postale,
            code_postal = :code_postal,
            ville = :ville,
            tel = :tel,
            mail = :mail,
            comment_fournisseur = :comment");

    $requete->bindValue(':date_creation_f', $date_crea_f);
    $requete->bindValue(':nom', $nom);
    $requete->bindValue(':prenom', $prenom);
    $requete->bindValue(':raison_sociale', $raison);
    $requete->bindValue(':adr_postale', $adr_postale);
    $requete->bindValue(':code_postal', $code_postal);
    $requete->bindValue(':ville', $ville);
    $requete->bindValue(':tel', $tel);
    $requete->bindValue(':mail', $mail);
    $requete->bindValue(':comment', $commentaire);

    if ($requete->execute()) {
        /** si l'insertion c'est bien passe la methode retourne le dernier id de la news inseree */
        return $pdo->lastInsertId();
    }
    /** sinon elle retourne une erreur */
    return $requete->errorInfo();
}
function modifier_fournisseur_dans_bdd($fournisseur_id, $date_crea_f, $nom, $prenom, $raison, $adr_postale, $code_postal, $ville, $tel, $mail, $commentaire) {
    $pdo = PDO2::getInstance();
    
    $requete = $pdo->prepare("UPDATE fournisseur SET
            date_creation_f = :date_creation_f,
            nom = :nom,
            prenom = :prenom,
            raison_sociale = :raison_sociale,
            adr_postale = :adr_postale,
            code_postal = :code_postal,
            ville = :ville,
            tel = :tel,
            mail = :mail,
            comment_fournisseur = :comment_fournisseur
                WHERE fournisseur_id = :fournisseur_id");

    $requete->bindValue(':date_creation_f', $date_crea_f);
    $requete->bindValue(':nom', $nom);
    $requete->bindValue(':prenom', $prenom);
    $requete->bindValue(':raison_sociale', $raison);
    $requete->bindValue(':adr_postale', $adr_postale);
    $requete->bindValue(':code_postal', $code_postal);
    $requete->bindValue(':ville', $ville);
    $requete->bindValue(':tel', $tel);
    $requete->bindValue(':mail', $mail);
    $requete->bindValue(':comment_fournisseur', $commentaire);
    $requete->bindValue(':fournisseur_id', $fournisseur_id);

    if ($requete->execute()) {
        /** si l'insertion c'est bien passe la methode retourne le dernier id de la news inseree */
        return $fournisseur_id;
    }
    /** sinon elle retourne une erreur */
    return $requete->errorInfo();
}

/**
 * @brief      methode de selection des fournisseurs dans la base de donn�es
 * 
 * @param	   $id_fournisseur Integer Identifiant du fournisseur
 * @return     un tableau de donnees d'un fournisseur 
 * 
 */
function selectionner_fournisseur_dans_bdd($id_fournisseur) {
    /** on instancie une nouvelle connexion a la base de donnees via la classe PDO2 */
    $pdo = PDO2::getInstance();

    /** on prepare notre requete avec les valeurs passes en parametre */
    $requete = $pdo->prepare("SELECT * FROM fournisseur WHERE fournisseur_id = :id_fournisseur");

    $requete->bindValue(':id_fournisseur', $id_fournisseur);

    /** j'execute cette requete */
    $requete->execute();

    if ($result = $requete->fetch(PDO::FETCH_ASSOC)) {

        $requete->closeCursor();
        return $result;
    }

    /** je retourne un tableau d'objet theme */
    return $tab;
}
function selectionner_fournisseur_dans_bdd_nom($nom, $prenom, $raison_sociale) {
    /** on instancie une nouvelle connexion a la base de donnees via la classe PDO2 */
    $pdo = PDO2::getInstance();

    /** on prepare notre requete avec les valeurs passes en parametre */
    $requete = $pdo->prepare("SELECT * FROM fournisseur WHERE nom = :nom AND prenom = :prenom AND raison_sociale=:raison_sociale");

    $requete->bindValue(':nom', $nom);
    $requete->bindValue(':prenom', $prenom);
    $requete->bindValue(':raison_sociale', $raison_sociale);
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
 * @brief      methode de suppression des fournisseurs dans la base de donnees
 * 
 * @param	   $id_user Integer Identifiant du fournisseur
 * 
 */
function supprimer_fournisseur_dans_bdd($id_fournisseur) {
    /** on instancie une nouvelle connexion a la base de donnees via la classe PDO2 */
    $pdo = PDO2::getInstance();

    /** on prépare notre requete avec les valeurs passés en parametre */
    $requete = $pdo->prepare("DELETE FROM fournisseur where fournisseur_id = :id_fournisseur");

    $requete->bindValue(':id_fournisseur', $id_fournisseur);
    $requete->execute();

    if ($result = $requete->fetch(PDO::FETCH_ASSOC)) {

        print_r($result);
        $requete->closeCursor();
        return $result;
    }
    return $requete->errorInfo();
}

?>