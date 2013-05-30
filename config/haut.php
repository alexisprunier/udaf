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
        <script type="text/javascript">
            $(document).ready( function () {
                $( "#dialog-confirm_dossier" ).dialog({                                
                    resizable: false,
                    height:200,
                    width:500,
                    autoOpen: false,
                    modal: true,
                    buttons: {
                        "Continuer": function() {
                            $( this ).dialog( "close" );
                            window.location.href = theHREF;
                        },
                        "Annuler": function() {
                            $( this ).dialog( "close" );
                        }
                    }
                }); 
                $("a#menu_creer_dossier").click(function(e) {
                    e.preventDefault();
                    theHREF = $(this).attr("href");
                    $("#dialog-confirm_dossier").dialog("open");
                });
            });
        </script>
        
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
<div id="dialog-confirm_dossier" class="dialog-confirm-ogconso"style="display : none;" title="Attention?">
    <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span>Si vous continuer, cela va entrainer la creation d'un nouveau dossier.</p>
</div>
        <div id="left_menu">
            <ul id="main_menu" class="main_menu">
                <li class="limenu_first" ><a href="accueil.php?module=general&amp;action=afficher_accueil"><span class="ico gray shadow home" ></span><b>Accueil</b></a></li>
                <li class="limenu" ><a id="menu_creer_dossier" href="accueil.php?module=dossier&amp;action=creer_dossier&ajout=dossier" ><span class="ico gray shadow file"></span><b>Cr&eacute;er dossier</b></a></li>                               
                <li class="limenu" ><a href="accueil.php?module=recherche&amp;action=rechercher_dossier"><span class="ico gray shadow zoom" ></span><b>Rechercher dossier</b></a></li>
                <li class="limenu" ><a href="accueil.php?module=suivi&amp;action=suivi_dossier"><span class="ico gray shadow  bookmark"></span><b>Suivi dossier</b> </a></li>
                <li class="limenu" ><a href="libs/pdf/export/dossier_vierge.pdf"><span class="ico gray shadow diskette"></span><b>Exporter dossier vierge</b> </a></li>
                <li class="limenu" ><a href="accueil.php?module=calendrier&amp;action=afficher_calendrier"><span class="ico gray shadow calendar"></span><b>&eacute;v&eacute;nements</b></a></li>
                <li class="limenu" ><a href="accueil.php?module=statistique&amp;action=recuperer_stats"><span class="ico gray shadow stats_lines"></span><b>Statistiques</b> </a></li>
                <li class="limenu" ><a href="accueil.php?module=documentation&amp;action=afficher_documentation"><span class="ico gray shadow  notepad"></span><b>Documentation</b></a></li>
                <li class="limenu_last" ><a href="accueil.php?module=general&amp;action=afficher_apropos"><span class="ico gray shadow info"></span><b>&agrave; propos</b></a></li>
            </ul>
        </div>

        <!-- full width -->
        <div class="widget ">
            <br /><br />
            <div class="content" >
                <br />