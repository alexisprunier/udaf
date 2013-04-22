<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
<meta content="text/html; Charset=UTF-8" http-equiv="Content-Type" />
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
        <title>OGconso - UDAF53</title>

        <!-- Link favicon-->
        <!--Incompatible.png-->
        <link rel="shortcut icon" type="images/ico" href="images/favicon.ico"/> 
        <!--Compatible.png -->
        <link rel="shortcut icon" type="images/png" href="images/favicon.png" /> 

        <!-- Link css -->
        <link rel="stylesheet" type="text/css" href="css/fixedHeader.css"/>
        <link rel="stylesheet" type="text/css" href="css/zice.style.css"/>
        <!-- Link jquery -->
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type='text/javascript' src='js/evenementiel.js'></script>
        <script type="text/javascript" src='components/ui/jquery.ui.min.js'></script> 
        <script type="text/javascript" src='components/datatables/dataTables.min.js'></script>
        <script type="text/javascript" src='components/elastic/jquery.elastic.source.js'></script>
        <script type='text/javascript' src='components/fullcalendar/fullcalendar.js'></script>
        <script type='text/javascript' src='components/fixed-header-table/jquery.fixedheadertable.js'></script>
  
        
        <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="components/flot/excanvas.min.js"></script><![endif]--> 
    </head>        
    <body class="dashborad"> <!-- onBeforeUnload="return('Avez vous sauvegarder toutes les données?')" -->

        <!-- Header -->
        <div id="header">		
            <img class="logoUDAF" src="images/logo/LogoUDAFv0.1.png" alt="logoUDAF"/>
            <img class="logoAppli" src="images/logo/LogoOGconsov0.1.png" alt="logoOGconso" />


            <?php if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
                ?>
                <div class="account_info" id="account_info_admin">
                    <a href="accueil.php?module=administration&amp;action=gestion_administration">
                        <div class="setting">Espace Administration </div><img class="setting_icon" src="images/icon/gray_18/administrator.png" alt="iconadmin"/> </a>
                <?php } else { ?>
                    <div class="account_info" id="account_info_user">
                    <?php } ?>


                    <div class="welcome">Bienvenue <br /><b class="red"><?php echo $_SESSION['prenom'] . " " . $_SESSION['nom']; ?></b></div>
                    <a href="accueil.php?module=general&amp;action=deconnexion"><div class="logout"><b>D&eacute;connexion</b></div><img class="logout_icon" src="images/icon/gray_18/power.png" alt="iconpower"/></a>
                </div>
            </div>
        </div><!-- End Header -->

        <div id="left_menu">
            <ul id="main_menu" class="main_menu">
                <li class="limenu_first" ><a href="accueil.php?module=general&amp;action=afficher_accueil"><span class="ico gray shadow home" ></span><b>Accueil</b></a></li>
                <li class="limenu" ><a href="accueil.php?module=dossier&amp;action=creer_dossier" ><span class="ico gray shadow file"></span><b>Cr&eacute;er dossier</b></a></li>                               
                <li class="limenu" ><a href="accueil.php?module=recherche&amp;action=rechercher_dossier"><span class="ico gray shadow zoom" ></span><b>Rechercher dossier</b></a></li>
                <li class="limenu" ><a href="accueil.php?module=suivi&amp;action=suivi_dossier"><span class="ico gray shadow  bookmark"></span><b>Suivi dossiers</b> </a></li>
                <li class="limenu" ><a href="accueil.php?module=general&amp;action=generer_dossier"><span class="ico gray shadow diskette"></span><b>Exporter dossier vierge</b> </a></li>
                <li class="limenu" ><a href="accueil.php?module=calendrier&amp;action=afficher_calendrier"><span class="ico gray shadow calendar"></span><b>&eacute;v&eacute;nements</b></a></li>
                <li class="limenu" ><a href="accueil.php?module=statistique&amp;action=recuperer_stats"><span class="ico gray shadow stats_lines"></span><b>Statistiques</b> </a></li>
                <li class="limenu" ><a href="accueil.php?module=general&amp;action=afficher_documentation"><span class="ico gray shadow  notepad"></span><b>Documentation</b></a></li>
                <li class="limenu" ><a href="#"><span class="ico gray shadow stats_lines"></span><b>Statistiques</b> </a></li>
                <li class="limenu" ><a href="accueil.php?module=documentation&amp;action=afficher_documentation"><span class="ico gray shadow  notepad"></span><b>Documentation</b></a></li>
                <li class="limenu_last" ><a href="accueil.php?module=general&amp;action=afficher_apropos"><span class="ico gray shadow info"></span><b>&agrave; propos</b></a></li>
            </ul>
        </div>

        <!-- full width -->
        <div class="widget ">
            <br /><br />
            <div class="content" >
                <br />