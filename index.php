<?php
session_start();
/**
 * @file      index.php
 * @author    Jocelyn SIMON
 * @version   1.0
 * @date      11 f&eacute;vrier 2013
 * @brief     Page d'authentification.
 *
 * @details    Ce fichier permet &eacute; l'utilisateur de s'authentifier et de cr&eacute;er les variables de sessions.
 */
/** config.php fichier contenant toute la configuration et les variables d'environnement */
include ('config/config.php');

if (isset($_POST["username"]) and isset($_POST["password"])) {
    sleep(1);
    $ident = mysql_real_escape_string($_POST["username"]);
    $pass = mysql_real_escape_string($_POST["password"]);
    $pass_crypt = sha1($pass);
   
    $result = q("SELECT * FROM utilisateur WHERE ident = '$ident' AND pass = '$pass'");

    if (mysql_num_rows($result) == 0) {
        header('location: index.php?erreur=login');
    } else {
        $row = mysql_fetch_assoc($result);

        $_SESSION['auth'] = 1; // enregistrement de la session
        // d&eacute;claration des variables de session
        $_SESSION['id'] = $row['user_id']; // Son id
        $_SESSION['prenom'] = $row['prenom']; // Son prenom
        $_SESSION['nom'] = $row['nom']; // Son nom
        $_SESSION['admin'] = $row['administrateur']; // Si il est admin

        header('location: accueil.php?module=general&action=afficher_accueil');

        $return_arr["status"] = 1;
        echo json_encode($return_arr);
    }
    exit();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=uft-8"/>
        <!-- Link favicon-->
        <!--Incompatible .png-->
        <link rel="shortcut icon" type="images/ico" href="images/favicon.ico"/> 
        <!--Compatible .png-->
        <link rel="shortcut icon" type="images/png" href="images/favicon.png" /> 
        <!-- Link css-->
        <link rel="stylesheet" type="text/css" href="css/zice.style.css"/>
        <title>Identification OGconso</title>
        <!--[if lt IE 9]>
			<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
    </head>
    <body>
        <div id="identification">
            <form method="post" action="" id="form_id">
                <fieldset id="login">
                    <img class="logo_id" id="logoAppli" src="images/logo/LogoOGconsov0.1.png"/>

                    <h3>Pour acc&eacute;der &agrave; l'application OGconso, merci de saisir vos identifiants :</h3>

                    <?php if (isset($_GET['erreur']) && ($_GET['erreur'] == "login")) { ?>
                        <div id="login_failed" class="bandeau_login">Mauvaise identification ! <br /></div>
                    <?php } ?>

                    <?php if (isset($_GET['statut']) && ($_GET['statut'] == "logout")) { ?>
                        <div id="logout_sucess" class="bandeau_login">D&eacute;connexion r&eacute;ussie ! <br /></div>
                    <?php } ?>

                    <?php if (isset($_GET['erreur']) && ($_GET['erreur'] == "error")) { ?>
                        <div id="login_failed" class="bandeau_login">Acc&eacute;s Interdit ! <br /></div>
                    <?php } ?>

                    <div id="login">
                        <label for="id" id="lab_id" class="label_login" aria-label="Identifiant"></label>
                        <input type="text" name="username" class="inputfield" id="id" required aria-required="true" title="Votre identifiant">
                    </div>
                    <div id="login">
                        <label for="pass" id="lab_pass" class="label_login" aria-label="Mot de passe"></label>
                        <input type="password" name="password" class="inputfield" id="pass" required aria-required="true" title="Votre mot de passe">
                    </div> 
                    <button type="submit" name="ok" class="login_button" title="Se connecter"></button>
                </fieldset>	 
            </form>
        </div>
    </body>
</html>