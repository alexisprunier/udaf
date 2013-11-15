<script type="text/javascript">
  $(document).ready(function() {
     
      $(".contenu_doc").hide();
      $(".ssmenu_doc").hide();
      $("#doc_accueil").fadeIn(500);
      
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
      var page_demande= "#doc_accueil";
      $(".ssmenu_doc li").click(function(){
            $(page_demande).fadeOut(50);            
            $(".ssmenu_doc li").removeClass("select_sstitre");
            $(this).addClass("select_sstitre");
            page_demande = "#doc_" + $(this).attr("id");
            $(page_demande).fadeIn(500);
      });
      
      
   
});

</script>
<div id="div_menu_doc">
    <ul id="menu_doc">
        <li class='titre_menu_doc'>Gérer un dossier</li>
        <ul class="ssmenu_doc">
            <li id="nouveau_dossier">Créer un nouveau dossier</li>
        <?php
            if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
        ?>
            <li id="supprimer_dossier">Supprimer un dossier</li>
        <?php } ?>
            <li id="suivi_dossier">Modifier les informations d'un de ses dossier</li>
            <li id="rechercher_dossier">Consulter les informations d'un dossier</li>
            <li id="transferer_client">Transférer un dossier à un autre utilisateur</li>
            <li id="export_dossier">Exporter un dossier en PDF</li>
        </ul>
        <li class='titre_menu_doc'>Gérer les fichiers liés à un dossier</li>
        <ul class="ssmenu_doc">
            <li id="stocker_fichier">Stocker un fichier</li>
            <li id="supprimer_fichier">Supprimer un fichier</li>
            <li id="telecharger_fichier">Télécharger un fichier</li>
        </ul>
        <li class='titre_menu_doc'>Gérer les sites internet d'un dossier</li>
        <ul class="ssmenu_doc">
            <li id="ajouter_site">Ajouter un site internet</li>
            <li id="supprimer_site">Supprimer un site internet</li>
            <li id="visiter_site">Visiter un site internet du dossier</li>
        </ul>
        <li class='titre_menu_doc'>Gérer les événements d'un dossier</li>
        <ul class="ssmenu_doc">
            <li id="ajouter_evenement">Ajouter un événement</li>
        </ul>
        <li class='titre_menu_doc'>Générer un rapport annuel</li>
        <ul class="ssmenu_doc">
            <li id="afficher_rapport">Afficher le rapport annuel</li>
            <li id="exporter_rapport">Exporter le rapport annuel</li>
        </ul>
         <?php
            if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
            ?>
        <li class='titre_menu_doc'>Gérer les utilisateurs</li>
        <ul class="ssmenu_doc">
            <li id="ajouter_user">Ajouter un utilisateur</li>
            <li id="modifier_user">Modifier un utilisateur</li>
            <li id="supprimer_user">Supprimer un utilisateur</li>
        </ul>
            <?php } ?>
        <li class='titre_menu_doc'>Consulter le calendrier</li>
        <ul class="ssmenu_doc">
            <li id="calendrier">Consulter le calendrier</li>
        </ul>
        <li class='titre_menu_doc'>Exporter un PDF vierge de dossier</li>
        <ul class="ssmenu_doc">
            <li id="export_dossier_vide">Exporter un PDF vierge de dossier</li>
        </ul>
    </ul>
</div>
 
<div id="contenu_doc">
    <div id="doc_accueil" class="contenu_doc" style="margin:auto;width : 80%;margin-top: 200px;">
        <p>Pour consulter la documentation, veuillez choisir la catégorie qui vous intéresse.</p>
    </div>
    <!--DOC GERER EVENT-->
   <div id="doc_ajouter_evenement" class="contenu_doc">
        <p>L'application offre la possibilité d'ajouter des événement des un dossier dont on est le propriétaire</p> 
        <p>Pour Ajouter un événement vous devez vous rendre sur un de vos dossier, cliquez sur l'élément du menu "Suivi Dossier" :</p>
        <img src="images/doc/suivi_dossier.jpg">
        <p>Dans cette page, vous pouvez filtrer les dossiers à afficher. Pour cela, remplissez les quelques champs afin d'optimiser le temps de recherche du dossier désiré</p>
        <img src="images/doc/filtre_recherche.jpg" style="width : 90%;">
        <p>Lorsque le dossier désiré est affiché, vous pouvez cliquer sur la ligne le présentant. Vous serez ensuite redirigé vers la page où se trouve l'ensemble des informations concernant le dossier.</p>
        <p>Aller ensuite dans la partit événement puis cliquer sur le bouton "Ajouter un Rendez vous"</p>
        <img src="images/doc/ajouter_event.png">
        <p>Remplissez ensuite le formulaire puis cliquez sur "Valider</p>
        <img src="images/doc/valider_event.png">
        <p>Pour le passer à l'état en cours, cliquez dans la case à coché correpondant au rendez vous, cela est automatiquement sauvegardé. Cela vous est indiqué par la fenêtre qui s'ouvre vous informant que le changement d'état à bien été pris en compte</p>
        <img src="images/doc/maj_event.png">
   </div>
    <!--DOC GERER UN CLIENT-->
   <div id="doc_suivi_dossier" class="contenu_doc">
        <p>La modification d'un dossier est possible si et seulement si vous êtes proprietaire du dossier. Les dossiers dont vous êtes le propriétaire se trouve dans l'espace "Suivi Dossier".</p> 
        <p>Pour modifier un dossier cliquez sur l'élément du menu "Suivi Dossier" :</p>
        <img src="images/doc/suivi_dossier.jpg">
        <p>Dans cette page, vous pouvez filtrer les dossiers à afficher. Pour cela, remplissez les quelques champs afin d'optimiser le temps de recherche du dossier désiré</p>
        <img src="images/doc/filtre_recherche.jpg" style="width : 90%;">
        <p>Lorsque le dossier désiré est affiché, vous pouvez cliquer sur la ligne le présentant. Vous serez ensuite redirigé vers la page où se trouve l'ensemble des informations concernant le dossier.</p>
        <p>Vous êtes maintenant en mesure de modifier les champs à votre guise. Pour enregistrer les informations, il vous suffit de cliquer sur le bouton "Modifier le dossier"</p>
        <p>Seuls les modifications apportées au Client, fournisseur, theme, sous theme, problématique, cloture et propriétaire necessite l'appui sur le bouton</p>
        <img src="images/doc/modifier_dossier.jpg">
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
        <img src="images/doc/modifier_dossier.jpg">
    </div>
    <div id="doc_export_dossier" class="contenu_doc">
        <p>Il est possible d'exporter les informations d'un document dans un format pdf.</p> 
        <p>Il faut tout d'abord aller sur le dossier concerné. Pour cela, cliquez sur l'élément du menu "Rechercher Dossier" :</p>
        <img src="images/doc/rechercher_dossier.jpg">
        <p>Dans cette page, vous pouvez filtrer les dossiers à afficher. Pour cela, remplissez les quelques champs afin d'optimiser le temps de recherche du dossier désiré</p>
        <img src="images/doc/filtre_recherche.jpg" style="width : 90%;">
        <p>Lorsque le dossier désiré est affiché, vous pouvez cliquer sur la ligne le présentant. Vous serez ensuite redirigé vers la page où se trouve l'ensemble des informations concernant le dossier.</p>
        <p>A partir d'ici, il vous suffit de cliquer sur le bouton "Exporter au format PDF" et le fichier se trouvera sur votre ordinateur.</p>
        <img src="images/doc/exporter_dossier.jpg">

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
        <p>Pour cela rendez-vous sur la page du dossier auquel appartient le fichier. Ensuite dans l'espace 
            "Gestion fichiers", cliquez sur l'icône de suppression de couleur rouge permettant de supprimer le fichier.</p>
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
    <div id="doc_ajouter_fournisseur" class="contenu_doc">
        <p>L'ajout d'un fournisseur se fait lors de l'enregistrement d'un dossier</p>
        <p>ATTENTION un fournisseur est avant tout reconnu par son nom, prénom et raison sociale cela signifie que si vous ajouter un fournisseur qui à le même nom,prénom et raison sociale qu'un fournisseur existant cela modifiera alors le fournisseur existant</p>
    </div>
    <?php
            if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
            ?>
    <div id="doc_supprimer_fournisseur" class="contenu_doc">
        <p>L'espace administration offe la possibilité de supprimer un fournisseur créé par erreur par exemple.</p>
        <p>Pour cela allez dans l'espace administration : </p>
        <img src="images/doc/espace_admin.jpg">
        <p>Puis dans l'espace cliquer sur le sens interdit du fournisseur a supprimer</p>
        <img src="images/doc/espace_admin.jpg">
        <p>Une fenêtre vous demande de confirmer la suppression :</p>
        <img src="images/doc/suppression_ligne.jpg">
        <p>Si vous avez confirmer la suppression de la ligne alors une fenêtre vous informe que le fournisseur à bien été supprimée</p>
        <img src="images/doc/suppr_fournisseur_success.jpg">
        
    </div>
            <?php } ?>
    
    <!--DOC GERER SITE WEB-->
    <div id="doc_ajouter_site" class="contenu_doc">
        <p>L'application offre la possibilité de joindre un site web à un dossier.</p>
        <p>Pour cela rendez-vous sur le dossier auquel vous voulez ajouter ce site. Ensuite dans l'espace 
            "Site WEB", cliquez sur le bouton "Ajouter". </p>
        <img src="images/doc/ajouter_site.png">
            <p>Vous êtes redirigé sur une page avec un formulaire vous demandant le nom du site web et son lien.</p>
        <img src="images/doc/ajout_site.jpg">
        <p>Cliquez ensuite sur le bouton "Valider", vous êtes redirigé vers le dossier auquel le site a été ajouté.</p>
    </div>
    <div id="doc_supprimer_site" class="contenu_doc">
        <p>Vous pouvez supprimer un site web qui est lié à un dossier.</p>
        <p>Pour cela rendez-vous sur la page du dossier auquel appartient le site. Ensuite dans l'espace 
            "Site WEB", cliquez sur l'icône de suppression de couleur rouge permettant de supprimer le site.</p>
        <img src="images/doc/ajout_site_form.jpg" >  
        <p>Une fenêtre s'ouvre pour confirmer la suppression du site web.</p>
        <img src="images/doc/creation_site.jpg" >
        <p>Dans le cas ou vous validez, le site sera supprimé du dossier.</p>
    </div>
    <div id="doc_visiter_site" class="contenu_doc">
        <p>Pour visiter un site web précédemment ajouté au dossier, vous devez vous rendre sur le dossier en question.</p>
        <p>Une fois fait, vous devez cliquer sur le lien que vous souhaitez.</p>
        <img src="images/doc/clic_site.png">
        <p>La page web s'ouvre donc dans votre navigateur.</p>
    </div>
    <!--DOC GERER DOSSIER-->
    <div id="doc_nouveau_dossier" class="contenu_doc">
        <p>Pour créer un nouveau dossier, il vous suffit de cliquer sur le menu "Créer Dossier".</p>
        <img src="images/doc/creer_dossier.jpg" > 
        <p>Une pop-up s'affichera pour confirmer cette création de dossier.</p>
        <img src="images/doc/creation_dossier.jpg">
        <p>Dans le cas où vous confirmerez cette création, vous serez dirigé vers la page de création avec de multiples champs pour enregistrer les informations.</p>
        <p>Une fois les champs remplies, vous pouvez valider votre dossier en cliquant sur le bouton "Modifier le dossier". Les données sont alors enregistrées et vous vous retrouverez sur la page avec les informations du dossier que vous venez de modifier.</p>
    </div>
  
    <div id="doc_rechercher_dossier" class="contenu_doc">
        <p>Vous pouvez consulter l'ensemble des dossiers enregistrés en base.</p> 
        <p>Pour cela, cliquez sur le menu "Rechercher Dossier".</p>
        <img src="images/doc/rechercher_dossier.jpg">
        <p>Dans cette page, vous pouvez filtrer les dossiers à afficher. Remplissez donc les quelques champs afin d'optimiser le temps de recherche du dossier désiré</p>
        <img src="images/doc/filtre_recherche.jpg" style="width : 90%;">
        <p>Lorsque le dossier désiré est affiché, vous pouvez cliquer sur la ligne le présentant. Vous serez ensuite redirigé vers la page où se trouve l'ensemble des informations concernant le dossier.</p>
    </div>
    <div id="doc_supprimer_dossier" class="contenu_doc">
        <p><i>Note : Si le client du dossier supprimé appartient à aucun autre dossier alors le client sera supprimé aussi.</i></p>

        <p>Vous pouvez supprimer un dossier, créé par erreur par exemple.</p> 
        <p>Pour cela, allez dans l'espace administration puis dans la gestion des dossier cliquer sur le sens interdit du dossier a supprimer.</p>
        <img src="images/doc/supprimer_fournisseur.jpg">
        <p>Une fenêtre vous demande de confirmer la suppression</p>
        <img src="images/doc/suppression_ligne.jpg">
        <p>Une fenêtre vous informe ensuite que le dossier à bien été supprimé.</p>
        
    </div>
    <div id="doc_exporter_dossier" class="contenu_doc">CONTENU PAGE EXPORTER DOSSIER</div>
    
    <!--DOC RAPPORT ANNUEL-->
    <div id="doc_afficher_rapport" class="contenu_doc">
        <p>Vous pouvez consulter le rapport annuel des dossiers traité dans l'année courante.</p> 
        <p>Il suffit juste de cliquer sur l'élément du menu "Statistiques".</p>
        <img src="images/doc/statistiques.jpg">
    </div>
    <div id="doc_exporter_rapport" class="contenu_doc">
        <p>Le rapport annuel peut être exporter au format PDF.</p> 
        <p>Vous devez vous rendre sur la page du rapport annuel en cliquant sur l'élément "Statistiques" du menu.</p>
        <img src="images/doc/statistiques.jpg">
        <p>Ensuite, cliquez sur le bouton "Exporter au format PDF" et le fichier sera donc sur votre ordinateur.</p>
    </div>
    <!--DOC GESTION UTILISATEURS-->
    <div id="doc_ajouter_user" class="contenu_doc">
        <p>Les comptes ayant les droits administrateurs peuvent accéder a la gestion des utilisateurs de l'application, pour créer un utilisateur aller dans l'espace administration.</p>
        <img src="images/doc/espace_admin.jpg">
        <p>Remplissez ensuite les champs selon l'utilisateur à ajouter puis cliquez sur "Validez" : </p>
        <img src="images/doc/ajout_user.jpg">        
        <p>Une fenêtre vous informe que l'utilisateur a bien été créé puis vous le voyer ensuite dans le tableau des utilisateurs.</p>
        <img src="images/doc/create_user_success.jpg">
    </div>
    <div id="doc_modifier_user" class="contenu_doc">
        <p>Les comptes ayant les droits administrateurs peuvent accéder a la gestion des utilisateurs de l'application, pour modifier un utilisateur aller dans l'espace administration.</p>
        <img src="images/doc/espace_admin.jpg">
        <p>Cliquez ensuite sur le petit crayon de l'utilisateur voulu : </p>
        <img src="images/doc/edit_user.jpg">        
        <p>Vous êtes redirigé vers un formulaire prérempli modifier le a vos souhait puis valider : </p>
        <img src="images/doc/valider_edit_user.jpg">
        <p>Vous êtes ensuite rediriger vers la page d'administration où une fenêtre vous informe que la modification de l'utilisateur à bien été prise en compte :ous êtes ensuite rediriger vers la page d'administration où une fenêtre vous informe que la modification de l'utilisateur à bien été prise en compte :</p>
         <img src="images/doc/edit_user_success.jpg">
    </div>
    <div id="doc_supprimer_user" class="contenu_doc">
        <p>Les comptes ayant les droits administrateurs peuvent accéder a la gestion des utilisateurs de l'application, pour supprimer un utilisateur aller dans l'espace administration.</p>
        <img src="images/doc/espace_admin.jpg">
        <p>Cliquez ensuite sur le petit sens-interdit de l'utilisateur à supprimer : </p>
        <img src="images/doc/supprimer_user.jpg">        
        <p>Une fenêtre vous demande de confirmer la suppression</p>
        <img src="images/doc/suppression_ligne.jpg">
        <p>Une deuxieme fenêtre vous informe que l'utilisateur à bien été supprimé</p>
        <img src="images/doc/suppr_user_success.jpg">
    </div>
    <div id="doc_calendrier" class="contenu_doc">
        <p>Vous pouvez consulter l'ensemble des évènements enregistrés en base.</p>
        <p>Pour accéder à ce calendrier, vous devez cliquer sur l'élément du menu "Evénements".</p>
        <img src="images/doc/evenements.jpg">
    </div>
    
    <div id="doc_export_dossier_vide" class="contenu_doc">
        <p>Vous pouvez exporter un fichier pdf d'un dossier vide.</p>
        <p>Il suffit de cliquer sur l'élément du menu "Exporter dossier vierge".</p>
        <img src="images/doc/dossier_vierge.jpg">
        <p>Le fichier se trouvera ensuite sur votre ordinateur.</p>
    </div>
    
</div>