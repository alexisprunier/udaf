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
        <li class='titre_menu_doc'>Gérer un dossier</li>
        <ul class="ssmenu_doc">
            <li><a href="creer_dossier">Créer un nouveau dossier</a></li>
            <li><a href="suivi_dossier">Modifier les informations d'un de ses dossier</a></li>
            <li><a href="rechercher_dossier">Consulter les informations d'un dossier</a></li>
            <li><a href="transferer_client">Transférer un dossier à un autre utilisateur</a></li>
            <li><a href="export_dossier">Exporter un dossier en PDF</a></li>
        </ul>
        <li class='titre_menu_doc'>Gérer les fichiers liés à un dossier</li>
        <ul class="ssmenu_doc">
            <li><a href="stocker_fichier">Stocker un fichier</a></li>
            <li><a href="supprimer_fichier">Supprimer un fichier</a></li>
            <li><a href="telecharger_fichier">Télécharger un fichier</a></li>
        </ul>
        <li class='titre_menu_doc'>Gérer les site internet d'un dossier</li>
        <ul class="ssmenu_doc">
            <li><a href="ajouter_site">Ajouter un site internet</a></li>
            <li><a href="supprimer_site">Supprimer un site internet</a></li>
            <li><a href="visiter_site">Visiter un site internet du dossier</a></li>
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
   <div id="doc_suivi_dossier" class="contenu_doc">
        <p>La modification d'un dossier est possible si et seulement si vous êtes proprietaire du dossier. Les dossiers dont vous êtes le propriétaire se trouve dans l'espace "Suivi Dossier".</p> 
        <p>Pour modifier un dossier cliquez sur l'élément du menu "Suivi Dossier" :</p>
        <img src="images/doc/suivi_dossier.jpg">
        <p>Dans cette page, vous pouvez filtrer les dossiers à afficher. Pour cela, remplissez les quelques champs afin d'optimiser le temps de recherche du dossier désiré</p>
        <img src="images/doc/filtre_recherche.jpg" style="width : 90%;">
        <p>Lorsque le dossier désiré est affiché, vous pouvez cliquer sur la ligne le présentant. Vous serez ensuite redirigé vers la page où se trouve l'ensemble des informations concernant le dossier.</p>
        <p>Vous êtes maintenant en mesure de modifier les champs à votre guise. Pour enregistrer les informations, il vous suffit de cliquer sur le bouton "Modifier le dossier"</p>
    </div>
   
    <div id="doc_transferer_client" class="contenu_doc">
        <p>Vous pouvez transférer un dossier à un autre utilisateur de l'application OGCONSO. Vous devez donc être le propriétaire du dossier à transférer.</p> 
        <p>Cliquez sur l'élément du menu "Suivi Dossier" :</p>
        <img src="images/doc/suivi_dossier.jpg">
        <p>Dans cette page, vous pouvez filtrer les dossiers à afficher. Pour cela, remplissez les quelques champs afin d'optimiser le temps de recherche du dossier désiré</p>
        <img src="images/doc/filtre_recherche.jpg" style="width : 90%;">
        <p>Lorsque le dossier désiré est affiché, vous pouvez cliquer sur la ligne le présentant. Vous serez ensuite redirigé vers la page où se trouve l'ensemble des informations concernant le dossier.</p>
        <p>A partir d'ici, il vous suffit de changer l'utilisateur de la liste déroulante appelée "Propriétaire" de la catégorie "Validation"</p>
        <img src="images/doc/transferer_dossier.jpg" align="center">
        <p>Cliquer ensuite sur le bouton "Modifier dossier" pour enregistrer les modifications apportées au dossier.</p>
        
    </div>
     <?php
            if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
            ?>
            <div id="doc_supprimer_client" class="contenu_doc">CONTENU SUPPRIMER UN CLIENT</div>
     <?php } ?>
     
     <!--DOC GERER FIHCIERS-->
    <div id="doc_stocker_fichier" class="contenu_doc">
        <p>L'application offre la possibilité de joindre des fichiers (word, pdf, ...) à un dossier.</p>
        <p>Pour cela rendez-vous sur le dossier auquel vous voulez ajouter un fichier. Ensuite dans l'espace 
            "Gestion fichiers", cliquez sur le bouton "Ajouter fichier...". Vous êtes redirigé vers une page 
            ou l'on vous demande de choisir un fichier. Cliquez sur le bouton "Choisir un fichier" puis 
            selectionnez le fichier à ajouter se trouvant sur votre ordinateur.</p>
        <p>Cliquez ensuite sur le bouton "Valider", vous êtes redirigé vers le dossier auquel le fichier a été ajouté.</p>
        <img src="images/doc/doc_fichiers.jpg" style="width : 90%;">
    </div>
    <div id="doc_supprimer_fichier" class="contenu_doc">
        <p>Vous pouvez supprimer les fichiers qui sont liés à un dossier.</p>
        <p>Pour cela rendez-vous sur le dossier ou un fichier à été ajouté. Ensuite dans l'espace 
            "Gestion fichiers" cliquer sur l'icône de suppression de couleur rouge permettant de supprimer le fichier.</p>
        <img src="images/doc/doc_fichiers_suppr.jpg" >  
        <p>Une fenêtre s'ouvre pour confirmer la suppression du fichier.</p>
        <p>Dans le cas ou vous validez, le fichier sera supprimé du dossier.</p>
        
    </div>
    <div id="doc_telecharger_fichier" class="contenu_doc">
        <p>Vous pouvez télécharger les fichiers ajoutés au dossier.</p>
        <p>Pour cela, rendez-vous sur le dossier auquel le fichier a été attribué. Ensuite dans l'espace 
            "Gestion fichiers" cliquer sur le nom du fichier afin de télécharger le télécharger.</p>
         <img src="images/doc/doc_fichiers_dl.jpg" >
            
    </div>
    
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
    <div id="doc_creer_dossier" class="contenu_doc">
        <p>Pour créer un nouveau dossier, il vous suffit de cliquer sur le menu "Créer Dossier".</p>
        <img src="images/doc/creer_dossier.jpg" > 
        <p>Une pop-up s'affichera pour confirmer cette création de dossier.</p>
        <img src="images/doc/creation_dossier.jpg" width="500px">
        <p>Dans le cas où vous confirmerez cette création, vous serez dirigé vers la page de création avec de multiples champs pour enregistrer les informations.</p>
        <p>Une fois les champs remplies, vous pouvez valider votre dossier en cliquant sur le bouton "Modifier le dossier". Les données sont alors enregistrées et vous vous retrouverez sur la page avec les informations du dossier que vous venez de modifier.</p>
    </div>
    <div id="doc_suivi_dossier" class="contenu_doc">
        <p>Pour modifier un dossier, vous devez vous assurer que ce dossier vous appartient. Dans le cas contraire, vous ne pourrez que le consulter.</p>
        <p>Tout d'abord, il faut sélectionner le menu "Suivre Dossier".</p>
        <p>Vous retrouverez donc un tableau avec l'ensemble de vos dossiers.</p>
        <p>Il est possible d'utiliser les filtres pour trouver le dossier plus facilement. Pour cela, il faut remplir les différents champs à vos souhaits et cliquer sur le bouton "Appliquer les filtres". Les dossiers qui respectent les critères que vous aurez remplie seront donc dans le tableau</p>
        <p>Une fois que vous avez trouvé le dossier à modifier, vous pouvez cliquer sur celui-ci.</p>
        <p>Vous serez donc rediriger sur une page avec tous les champs dans lesquels il y a les informations déjà enregistrées.</p>
        <p>Vous pouvez donc modifier les différentes informations, et valider en cliquant sur "Modifier le dossier"</p>
        <p>Les informations sont donc enregistrées et une pop-up s'affichera pour vous confirmez que la manipulation est un succès. Vous serez donc ensuite redirigé sur la même page avec les nouvelles informations.</p>
    </div>
    <div id="doc_rechercher_dossier" class="contenu_doc">
        <p>Vous pouvez consulter l'ensemble des dossiers enregistrés en base.</p> 
        <p>Pour cela, cliquez sur le menu "Rechercher Dossier".</p>
        <img src="images/doc/rechercher_dossier.jpg">
        <p>Dans cette page, vous pouvez filtrer les dossiers à afficher. Remplissez donc les quelques champs afin d'optimiser le temps de recherche du dossier désiré</p>
        <img src="images/doc/filtre_recherche.jpg" style="width : 90%;">
        <p>Lorsque le dossier désiré est affiché, vous pouvez cliquer sur la ligne le présentant. Vous serez ensuite redirigé vers la page où se trouve l'ensemble des informations concernant le dossier.</p>
    </div>
    <div id="doc_exporter_dossier" class="contenu_doc">CONTENU PAGE EXPORTER DOSSIER</div>
    
    <!--DOC RAPPORT ANNUEL-->
    <div id="doc_afficher_rapport" class="contenu_doc">CONTENU PAGE AFFICHER RAPPORT</div>
    <div id="doc_exporter_rapport" class="contenu_doc">CONTENU PAGE EXPORTER RAPPORT</div>
    
    
    
</div>