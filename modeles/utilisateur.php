<?php

/**
 * @file      utilisateur.php
 * @author    Anthony HIVERT
 * @version   1.0
 * @date      28 f&eacute;vrier 2013
 * @brief     Defnit les m&eacute;thode de gestion utilisateur.
 *
 * @details    Ce fichier permet de d&eacute;finir les m&eacute;thode de suppression, de modification, d'ajout d'utilisateurs .
 */

/**
 * @brief      Permet l'ajout d'un utilisateur dans la base de donn&eacute;es
 * 
 * @param	$ident				varchar identifiant de l'utilisateur
 * @param	$nom				varchar nom de l'utilisateur
 * @param	$prenom				varchar prenom de l'utilisateur
 * @param	$pass				varchar mot de passe utilisateur
 * @param	$administrateur		tinyint administrateur 1 utilisateur 0
 * @return   True en cas de succes, False en cas d'echec
 */
function ajouter_utilisateur_dans_bdd($ident, $nom, $prenom, $pass, $administrateur) {
    $pdo = PDO2::getInstance();

    $requete = $pdo->prepare("INSERT INTO utilisateur SET
            ident = :ident,
			nom = :nom,
			prenom = :prenom,
			pass = :pass,
			administrateur = :administrateur");

    $pass_crypt = sha1($pass);
    $requete->bindValue(':ident', $ident);
    $requete->bindValue(':nom', $nom);
    $requete->bindValue(':prenom', $prenom);
    $requete->bindValue(':pass', $pass_crypt);
    $requete->bindValue(':administrateur', $administrateur);

    if ($requete->execute()) {
        /** si l'insertion c'est bien passe la methode retourne le dernier id de l'utilisateur inser&eacute; */
        return $pdo->lastInsertId();
    }
    /** sinon elle retourne une erreur */
    return $requete->errorInfo();
}
/**
 * @brief      methode de selection de lutilisateur du dossier dans la base de donn�es
 * 
 * @param	   $user_id Integer Identifiant de l'utilisateur
 * @return     un tableau de donn�es d'un client 
 * 
 */
function selectionner_utilisateur_du_dossier_dans_bdd($user_id) {
    /** on instancie une nouvelle connexion a la base de donnees via la classe PDO2 */
    $pdo = PDO2::getInstance();

    /** on prepare notre requete avec les valeurs pass�s en parametre */
    $requete = $pdo->prepare("SELECT * FROM dossier WHERE user_id = :user_id");

    $requete->bindValue(':user_id', $user_id);

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
 * @brief      methode de selection des utilisateurs dans la base de donn&eacute;es
 * 
 * @return    un tableau de dossiers 
 * 
 */
function lister_utilisateur_dans_bdd() {
    /** on instancie une nouvelle connexion a la base de donn&eacute;es via la classe PDO2 */
    $pdo = PDO2::getInstance();

    /** on pr&eacute;pare notre requete avec les valeurs pass&eacute;s en parametre */
    $requete = $pdo->prepare("SELECT * FROM utilisateur");

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

/**
 * @brief      methode de selection des utilisateurs dans la base de donnees
 * 
 * @param	   $id_user Integer Identifiant de l'utilisateurs
 * @return     un tableau de donn&eacute;es d'un utilisateur
 * 
 */
function selectionner_utilisateur_dans_bdd($id_user) {
    /** on instancie une nouvelle connexion a la base de donnees via la classe PDO2 */
    $pdo = PDO2::getInstance();

    /** on prepare notre requete avec les valeurs passes en parametre */
    $requete = $pdo->prepare("SELECT * FROM utilisateur WHERE user_id = :id_user");

    $requete->bindValue(':id_user', $id_user);

    /** j'execute cette requete */
    $requete->execute();

    if ($result = $requete->fetch(PDO::FETCH_ASSOC)) {

        $requete->closeCursor();
        return $result;
    }

    /** je retourne un tableau d'objet */
    return $tab;
}

/**
 * @brief      methode de suppression des utilisateurs dans la base de donnees
 * 
 * @param	   $id_user Integer Identifiant de l'utilisateurs
 * 
 */
function supprimer_utilisateur_dans_bdd($id_user) {
    /** on instancie une nouvelle connexion a la base de donnees via la classe PDO2 */
    $pdo = PDO2::getInstance();

    /** on prépare notre requete avec les valeurs passés en parametre */
    $requete = $pdo->prepare("DELETE FROM utilisateur where user_id = :id_user");

    $requete->bindValue(':id_user', $id_user);
    $requete->execute();

    if ($result = $requete->fetch(PDO::FETCH_ASSOC)) {

        print_r($result);
        $requete->closeCursor();
        return $result;
    }
    return $requete->errorInfo();
}

/**
 * @brief      Permet la modification d'un utilisateur dans la base de données
 *
 * @param	$user_id			integer identifiant
 * @param	$identifiant		string identifiant
 * @param	$nom				string nom
 * @param	$prenom				string prenom
 * @param	$pass				string pass
 * @param	$admin				boolean admin
 * @return   True en cas de succès, False en cas d'echec
 */
function modifier_utilisateur_dans_bdd($user_id, $identifiant, $nom, $prenom, $pass, $admin) {
    $pdo = PDO2::getInstance();

    $requete = $pdo->prepare("UPDATE utilisateur SET
			ident = :identifiant,
			nom = :nom,
			prenom = :prenom,
			pass = :password,
			administrateur = :administrateur
			WHERE
			user_id = :user_id");

    $pass_crypt = sha1($pass);
    $requete->bindValue(':user_id', $user_id);
    $requete->bindValue(':identifiant', $identifiant);
    $requete->bindValue(':nom', $nom);
    $requete->bindValue(':prenom', $prenom);
    $requete->bindValue(':password', $pass_crypt);
    $requete->bindValue(':administrateur', $admin);


    $result = $requete->execute();

    return $user_id;
}

?>