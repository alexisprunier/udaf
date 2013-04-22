<script type="text/javascript">
  $(document).ready(function() {
     
      $(".contenu_doc").hide();
      $(".ssmenu_doc").hide();
      
      $(".titre_menu_doc").click(function(){
          $(".titre_menu_doc").removeClass("select_titre");
        if($(this).next("ul.ssmenu_doc:visible").length != 0) 
            $(this).next("ul.ssmenu_doc").slideUp("fast"); 
        else { 
            $("ul.ssmenu_doc").slideUp("fast");
            $(this).next("ul.ssmenu_doc").slideDown("fast");
            $(this).addClass("select_titre");       
        }            
      });
      var page_demande;
      $(".ssmenu_doc a").click(function(){
            event.preventDefault();
            $(page_demande).fadeOut(50);            
            $(".ssmenu_doc a").removeClass("select_sstitre");
            $(this).addClass("select_sstitre");
            page_demande = "#doc_" + $(this).attr("href");
            $(page_demande).fadeIn(500);
      });
      
      
   
});

</script>
<div id="div_menu_doc">
    <ul id="menu_doc">
        <li class='titre_menu_doc'>Gérer un client</li>
        <ul class="ssmenu_doc">
            <li><a href="ajouter_client">Ajouter un client</a></li>
            <li><a href="modifier_client">Modifier un client</a></li>
            <li><a href="consulter_client">Consulter un client</a></li>
            <li><a href="transferer_client">Transférer un client à un autre utilisateur</a></li>
            <?php
            if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
            ?>
            <li><a href="supprimer_client">Supprimer un client</a></li>
            <?php } ?>
        </ul>
        <li class='titre_menu_doc'>Gérer les fichiers liés à un dossier</li>
        <ul class="ssmenu_doc">
            <li><a href="stocker_fichier">Stocker un fichier</a></li>
            <li><a href="supprimer_fichier">Supprimer un fichier</a></li>
            <li><a href="telecharger_fichier">Télécharger un fichier</a></li>
        </ul>
        <li class='titre_menu_doc'>Gérer les fournisseurs</li>
        <ul class="ssmenu_doc">
            <li><a href="ajouter_fournisseur">Ajouter un fournisseur au dossier</a></li>
             <?php
            if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
            ?>
            <li><a href="supprimer_fournisseur">Supprimer un fournisseur</a></li>
            <?php } ?>
        </ul>
        <li class='titre_menu_doc'>Gérer les site internet d'un dossier</li>
        <ul class="ssmenu_doc">
            <li><a href="ajouter_site">Ajouter un site internet</a></li>
            <li><a href="supprimer_site">Supprimer un site internet</a></li>
            <li><a href="visiter_site">Visiter un site internet du dossier</a></li>
        </ul>
        <li class='titre_menu_doc'>Gerer les dossier</li>
        <ul class="ssmenu_doc">
            <li><a href="creer_dossier">Creer un nouveau dossier</a></li>
            <li><a href="suivi_dossier">Consulter/Modifier les informations d'un de ses dossier</a></li>
            <li><a href="rechercher_dossier">Consulter les information d'un dossier</a></li>
            <li><a href="exporter_dossier">Exporter une fiche de dossier vierge</a></li>

        </ul>
        <li class='titre_menu_doc'>Générer un rapport annuel</li>
        <ul class="ssmenu_doc">
            <li><a href="afficher_rapport">Afficher le rapport annuel</a></li>
            <li><a href="exporter_rapport">Exporter le rapport annuel</a></li>
        </ul>
         <?php
            if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
            ?>
        <li class='titre_menu_doc'>Gérer les utilisateur</li>
        <ul class="ssmenu_doc">
            <li><a href="ajouter_user">Ajouter un utilisateur</a></li>
            <li><a href="modifier_user">Modifier un utilisateur</a></li>
            <li><a href="supprimer_user">Supprimer un utilisateur</a></li>
        </ul>
            <?php } ?>
        <li class='titre_menu_doc'>Gérer les évenements</li>
        <ul class="ssmenu_doc">
            <li><a href="calendrier">Consulter le calendrier</a></li>
        </ul>
    </ul>
</div>
 
<div id="contenu_doc">
    <!--DOC GERER UN CLIENT-->
    <div id="doc_ajouter_client" class="contenu_doc">CONTENU PAGE AJOUTER CLIENT</div>
    <div id="doc_modifier_client" class="contenu_doc">CONTENU PAGE MODIFIER CLIENT</div>
    <div id="doc_consulter_client" class="contenu_doc">CONTENU PAGE CONSULTER CLIENT</div>
    <div id="doc_transferer_client" class="contenu_doc">CONTENU PAGE TRANSFERER UN CLIENT</div>
     <?php
            if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
            ?>
            <div id="doc_supprimer_client" class="contenu_doc">CONTENU SUPPRIMER UN CLIENT</div>
     <?php } ?>
     
     <!--DOC GERER FIHCIERS-->
    <div id="doc_stocker_fichier" class="contenu_doc">CONTENU PAGE STOCKER FICHIER</div>
    <div id="doc_supprimer_fichier" class="contenu_doc">CONTENU PAGE SUPPRIMER FICHIER</div>
    <div id="doc_telecharger_fichier" class="contenu_doc">CONTENU PAGE TELECHARGER FICHIER</div>
    
    <!--DOC GERER FOURNISSEURS-->
    <div id="doc_ajouter_fournisseur" class="contenu_doc">CONTENU PAGE AJOUTER FOURNISSEUR</div>
    <?php
            if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
            ?>
    <div id="doc_supprimer_fournisseur" class="contenu_doc">CONTENU PAGE SUPPRIMER FOURNISSEUR</div>
            <?php } ?>
    
    <!--DOC GERER SITE WEB-->
    <div id="doc_ajouter_site" class="contenu_doc">CONTENU PAGE AJOUTER SITE</div>
    <div id="doc_supprimer_site" class="contenu_doc">CONTENU PAGE SUPPRIMER SITE</div>
    <div id="doc_visiter_site" class="contenu_doc">CONTENU PAGE VISITER SITE</div>
    
    <!--DOC GERER DOSSIER-->
    <div id="doc_creer_dossier" class="contenu_doc">CONTENU PAGE CREER DOSSIER</div>
    <div id="doc_suivi_dossier" class="contenu_doc">CONTENU PAGE SUIVI DOSSIER</div>
    <div id="doc_rechercher_dossier" class="contenu_doc">CONTENU PAGE RECHERCHER DOSSIER</div>
    <div id="doc_exporter_dossier" class="contenu_doc">CONTENU PAGE EXPORTER DOSSIER</div>
    
    <!--DOC RAPPORT ANNUEL-->
    <div id="doc_afficher_rapport" class="contenu_doc">CONTENU PAGE AFFICHER RAPPORT</div>
    <div id="doc_exporter_rapport" class="contenu_doc">CONTENU PAGE EXPORTER RAPPORT</div>
    
    
    
</div>