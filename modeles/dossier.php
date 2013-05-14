<?php

/**
 * @file      dossier.php
 * @author    Jocelyn SIMON
 * @version   1.0
 * @date      30 janvier 2013
 * @brief     Definit les methodes du module dossier.
 *
 * @details    Ce fichier permet de concentrer les m�thodes du module dossier tel que les modifications, ajout et archivages.
 */

/**
 * @brief      methode de comptage des dossiers en bdd
 * 
 * @return    un nombre de dossier deja existant
 * 
 */
function generation_reference() {

    $pdo = PDO2::getInstance();

    $requete = $pdo->prepare("SELECT COUNT(*) FROM dossier");
    /** j'execute cette requète */
    $requete->execute();
    /** j'initialise un tableau */
    $count = 0;

    /** pour chaque resultat retourné je l'ajoute dans mon tableau */
    while ($result = $requete->fetch(PDO::FETCH_NUM)) {

        $count = $result[0];
    }

    /** je retourne un tableau d'objet news */
    return $count;
}

/**
 * @brief      Permet l'ajout d'un dossier dans la base de donnees
 * 
 * @param	$reference			integer reference dossier
 * @param	$problematique		varchar problematique du dossier
 * @param	$createur_dossier	integer proprietaire du dossier
 * @param	$theme				integer theme du dossier
 * @param	$sstheme			integer soustheme du dossier
 * @return   True en cas de succes, False en cas d'echec
 */
function ajouter_dossier_dans_bdd($reference, $date_crea_d, $problematique, $cloture, $raison_cloture, $comment_cloture, $date_cloture, $doss_physique, $createur_dossier, $theme, $sstheme, $fournisseur, $personne) {
    $pdo = PDO2::getInstance();

    $requete = $pdo->prepare("INSERT INTO dossier SET
                        dossier_ref = :reference,
                        date_creation_d = :date_creation_d,
                        problematique = :problematique,
                        cloture = :cloture,
                        raison_cloture = :raison_cloture,
                        comment_cloture = :comment_cloture,
                        dossier_physique = :doss_physique,
                        date_cloture = :date_cloture,
                        user_id = :createur_dossier,
                        theme_id = :theme_id,
                        soustheme_id = :soustheme_id,
                        fournisseur_id = :fournisseur_id,
                        personne_id = :personne_id"
    );

    $requete->bindValue(':reference', $reference);
    $requete->bindValue(':date_creation_d', $date_crea_d);
    $requete->bindValue(':problematique', $problematique);
    $requete->bindValue(':cloture', $cloture);
    $requete->bindValue(':raison_cloture', $raison_cloture);
    $requete->bindValue(':comment_cloture', $comment_cloture);
    $requete->bindValue(':date_cloture', $date_cloture);
    $requete->bindValue(':doss_physique', $doss_physique);
    $requete->bindValue(':createur_dossier', $createur_dossier);
    $requete->bindValue(':theme_id', $theme);
    $requete->bindValue(':soustheme_id', $sstheme);
    $requete->bindValue(':fournisseur_id', $fournisseur);
    $requete->bindValue(':personne_id', $personne);


    if ($requete->execute()) {
        /** si l'insertion c'est bien passe la methode retourne le dernier id de la news inseree */
        return $pdo->lastInsertId();
    }
    /** sinon elle retourne une erreur */
    return $requete->errorInfo();
}
function modifier_dossier_dans_bdd($reference, $date_crea_d, $problematique, $cloture, $raison_cloture, $comment_cloture, $date_cloture, $doss_physique, $createur_dossier, $theme, $sstheme, $fournisseur, $personne) {
    $pdo = PDO2::getInstance();

    $requete = $pdo->prepare("UPDATE dossier SET                        
                        date_creation_d = :date_creation_d,
                        problematique = :problematique,
                        cloture = :cloture,
                        raison_cloture = :raison_cloture,
                        comment_cloture = :comment_cloture,
                        dossier_physique = :doss_physique,
                        date_cloture = :date_cloture,
                        user_id = :createur_dossier,
                        theme_id = :theme_id,
                        soustheme_id = :soustheme_id,
                        fournisseur_id = :fournisseur_id,
                        personne_id = :personne_id
                            WHERE dossier_ref = :reference"
    );

    $requete->bindValue(':reference', $reference);
    $requete->bindValue(':date_creation_d', $date_crea_d);
    $requete->bindValue(':problematique', $problematique);
    $requete->bindValue(':cloture', $cloture);
    $requete->bindValue(':raison_cloture', $raison_cloture);
    $requete->bindValue(':comment_cloture', $comment_cloture);
    $requete->bindValue(':date_cloture', $date_cloture);
    $requete->bindValue(':doss_physique', $doss_physique);
    $requete->bindValue(':createur_dossier', $createur_dossier);
    $requete->bindValue(':theme_id', $theme);
    $requete->bindValue(':soustheme_id', $sstheme);
    $requete->bindValue(':fournisseur_id', $fournisseur);
    $requete->bindValue(':personne_id', $personne);


    if ($requete->execute()) {
        /** si l'insertion c'est bien passe la methode retourne le dernier id de la news inseree */
        return $reference;
    }
    /** sinon elle retourne une erreur */
    return $requete->errorInfo();
}
/**
 * @brief      Permet l'ajout d'une personne dans la base de donnees
 * 
 * @param	$sex				integer sexe
 * @param	$nom				string nom du client
 * @param	$prenom				string prenom du client
 * @param	$adr_postale		string adresse du client
 * @param	$cp					integer code postal du client
 * @param	$ville				string lieu de vie du client
 * @param	$mail				string mail du client
 * @param	$tel_fixe			integer telephone du client
 * @param	$tel_port			integer portable du client
 * @return   True en cas de succes, False en cas d'echec
 */
function ajouter_personne_dans_bdd($date_crea_p, $nom, $prenom, $sexe, $adr_postale, $code_postal, $ville, $tel_fixe, $tel_port, $mail) {
    $pdo = PDO2::getInstance();

    $requete = $pdo->prepare("INSERT INTO personne SET
            date_creation_p = :date_creation_p,
            nom = :nom,
            prenom = :prenom,
            sexe = :sexe,
            adr_postale = :adr_postale,
            code_postal = :code_postal,
            ville = :ville,
            tel_fixe = :tel_fixe,
            tel_port = :tel_port,
            mail = :mail");

    $requete->bindValue(':date_creation_p', $date_crea_p);
    $requete->bindValue(':nom', $nom);
    $requete->bindValue(':prenom', $prenom);
    $requete->bindValue(':sexe', $sexe);
    $requete->bindValue(':adr_postale', $adr_postale);
    $requete->bindValue(':code_postal', $code_postal);
    $requete->bindValue(':ville', $ville);
    $requete->bindValue(':tel_fixe', $tel_fixe);
    $requete->bindValue(':tel_port', $tel_port);
    $requete->bindValue(':mail', $mail);

    if ($requete->execute()) {
        /** si l'insertion c'est bien passe la methode retourne le dernier id de la news inseree */
        return $pdo->lastInsertId();
    }
    /** sinon elle retourne une erreur */
    return $requete->errorInfo();
}
function modifier_personne_dans_bdd($personne_id, $date_crea_p, $nom, $prenom, $sexe, $adr_postale, $code_postal, $ville, $tel_fixe, $tel_port, $mail) {
    $pdo = PDO2::getInstance();

    $requete = $pdo->prepare("UPDATE personne SET
            date_creation_p = :date_creation_p,
            nom = :nom,
            prenom = :prenom,
            sexe = :sexe,
            adr_postale = :adr_postale,
            code_postal = :code_postal,
            ville = :ville,
            tel_fixe = :tel_fixe,
            tel_port = :tel_port,
            mail = :mail
                WHERE personne_id = :personne_id");

    $requete->bindValue(':date_creation_p', $date_crea_p);
    $requete->bindValue(':nom', $nom);
    $requete->bindValue(':prenom', $prenom);
    $requete->bindValue(':sexe', $sexe);
    $requete->bindValue(':adr_postale', $adr_postale);
    $requete->bindValue(':code_postal', $code_postal);
    $requete->bindValue(':ville', $ville);
    $requete->bindValue(':tel_fixe', $tel_fixe);
    $requete->bindValue(':tel_port', $tel_port);
    $requete->bindValue(':mail', $mail);
    $requete->bindValue(':personne_id', $personne_id);

    if ($requete->execute()) {
        /** si l'insertion c'est bien passe la methode retourne le dernier id de la news inseree */
        return $personne_id;
    }
    /** sinon elle retourne une erreur */
    return $requete->errorInfo();
}

/**
 * @brief      methode de selection des dossiers dans la base de donn�es
 * 
 * @return    un tableau de dossiers 
 * 
 */
function lister_dossier_dans_bdd() {
    /** on instancie une nouvelle connexion a la base de données via la classe PDO2 */
    $pdo = PDO2::getInstance();

    /** on prépare notre requète avec les valeurs passés en paramêtre */
    $requete = $pdo->prepare("SELECT * FROM dossier");

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
            comment_fournisseur = :comment
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
    $requete->bindValue(':comment', $commentaire);
    $requete->bindValue(':fournisseur_id', $fournisseur_id);

    if ($requete->execute()) {
        /** si l'insertion c'est bien passe la methode retourne le dernier id de la news inseree */
        return $fournisseur_id;
    }
    /** sinon elle retourne une erreur */
    return $requete->errorInfo();
}

/**
 * @brief      methode de selection de la personne du dossier dans la base de donn�es
 * 
 * @param	   $id_personne Integer Identifiant du client
 * @return     un tableau de donn�es d'un client 
 * 
 */
function selectionner_personne_du_dossier_dans_bdd($personne_id) {
    /** on instancie une nouvelle connexion a la base de donnees via la classe PDO2 */
    $pdo = PDO2::getInstance();

    /** on prepare notre requete avec les valeurs pass�s en parametre */
    $requete = $pdo->prepare("SELECT * FROM dossier WHERE personne_id = :personne_id");

    $requete->bindValue(':personne_id', $personne_id);

    /** j'execute cette requete */
    $requete->execute();

    if ($result = $requete->fetch(PDO::FETCH_ASSOC)) {

        $requete->closeCursor();
        return $result;
    }

    /** je retourne un tableau d'objet personne */
    return $tab;
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
 * @brief      methode de selection du dossier dans la base de donn�es
 * 
 * @param	   $dossier_id Integer Identifiant du dossierr
 * @return     un tableau de donn�es d'un dossier 
 * 
 */
function selectionner_dossier_dans_bdd($dossier_ref) {
    /** on instancie une nouvelle connexion a la base de donnees via la classe PDO2 */
    $pdo = PDO2::getInstance();

    /** on prepare notre requete avec les valeurs pass�s en parametre */
    $requete = $pdo->prepare("SELECT * FROM dossier WHERE dossier_ref = :dossier_ref");

    $requete->bindValue(':dossier_ref', $dossier_ref);

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
 * @brief      methode de suppression des dossiers dans la base de donnees
 * 
 * @param	   $id_user Integer Identifiant du dossier
 * 
 */
function supprimer_dossier_dans_bdd($dossier_ref) {
    /** on instancie une nouvelle connexion a la base de donnees via la classe PDO2 */
    $pdo = PDO2::getInstance();

    /** on prépare notre requete avec les valeurs passés en parametre */
    $requete = $pdo->prepare("DELETE FROM dossier where dossier_ref = :dossier_ref");

    $requete->bindValue(':dossier_ref', $dossier_ref);
    $requete->execute();

    if ($result = $requete->fetch(PDO::FETCH_ASSOC)) {

        print_r($result);
        $requete->closeCursor();
        return $result;
    }
    return $requete->errorInfo();
}

/**
 * @brief      methode de selection des dossiers dans la base de donn�es
 * 
 * @return    un tableau de dossiers 
 * 
 */
function lister_dossier_admin_dans_bdd() {
    /** on instancie une nouvelle connexion a la base de données via la classe PDO2 */
    $pdo = PDO2::getInstance();

    /** on prépare notre requète avec les valeurs passés en paramêtre */
    $requete = $pdo->prepare("SELECT * FROM dossier AS d, personne AS p WHERE d.personne_id = p.personne_id");

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
 * @brief      Permet la cloture d'un dossier dans la base de donnees
 * 
 * @param	$reference			integer reference dossier
 * @param	$problematique		varchar problematique du dossier
 * @param	$createur_dossier	integer proprietaire du dossier
 * @param	$theme				integer theme du dossier
 * @param	$sstheme			integer soustheme du dossier
 * @return   True en cas de succes, False en cas d'echec
 */
function cloturer_dossier_dans_bdd($dossier_id, $reference, $date_crea_d, $problematique, $cloture, $raison_cloture, $comment_cloture, $date_cloture_d, $doss_physique, $createur_dossier, $theme, $sstheme, $fournisseur, $personne) {
    $pdo = PDO2::getInstance();

    $requete = $pdo->prepare("UPDATE dossier SET
                        dossier_ref = :reference,
                        date_creation_d = :date_creation_d,
						problematique = :problematique,
						cloture = :cloture,
						raison_cloture = :raison_cloture,
						comment_cloture = :comment_cloture,
						date_cloture = :date_cloture,
						dossier_physique = :doss_physique,
						user_id = :createur_dossier,
						theme_id = :theme_id,
						soustheme_id = :soustheme_id,
                        fournisseur_id = :fournisseur_id,
                        personne_id = :personne_id
						WHERE
						dossier_id = :dossier_id");

	$requete->bindValue(':dossier_ref', $dossier_ref);
    $requete->bindValue(':reference', $reference);
    $requete->bindValue(':date_creation', $date_crea_d);
    $requete->bindValue(':problematique', $problematique);
	$requete->bindValue(':cloture', $cloture);
	$requete->bindValue(':raison_cloture', $raison_cloture);
	$requete->bindValue(':comment_cloture', $comment_cloture);
	$requete->bindValue(':date_cloture', $date_cloture_d);
	$requete->bindValue(':doss_physique', $doss_physique);
    $requete->bindValue(':createur_dossier', $createur_dossier);
    $requete->bindValue(':theme_id', $theme);
    $requete->bindValue(':soustheme_id', $sstheme);
    $requete->bindValue(':fournisseur_id', $fournisseur);
    $requete->bindValue(':personne_id', $personne);

    $result = $requete->execute();

	return $dossier_ref;
}


/**
 * @brief      methode de selection la ligne avec l'id le plsu grand
 * 
 * @param
 * @return     la valeur max des dossier_ref
 * 
 */
function selectionner_dossier_max_id_dans_bdd() {
    /** on instancie une nouvelle connexion a la base de donnees via la classe PDO2 */
    $pdo = PDO2::getInstance();

    /** on prepare notre requete avec les valeurs pass�s en parametre */
    $requete = $pdo->prepare("SELECT * FROM dossier 
            WHERE dossier_ref = ( SELECT max(dossier_ref) FROM dossier);
            ");

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

?>