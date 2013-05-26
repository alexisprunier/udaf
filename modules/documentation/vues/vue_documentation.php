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
        <li class='titre_menu_doc'>Gerer les dossier</li>
        <ul class="ssmenu_doc">
            <li><a href="creer_dossier">Creer un nouveau dossier</a></li>
            <li><a href="suivi_dossier">Modifier les informations d'un de ses dossier</a></li>
            <li><a href="rechercher_dossier">Consulter les information d'un dossier</a></li>
            <li><a href="exporter_dossier">Exporter une fiche de dossier vierge</a></li>
            <li><a href="transferer_client">Transférer un dossier à un autre utilisateur</a></li>
        </ul>
        <li class='titre_menu_doc'>Gérer un client</li>
        <ul class="ssmenu_doc">
            <li><a href="modifier_client">Modifier un client</a></li>
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
            <li><a href="ajouter_fournisseur">Modifier fournisseur du dossier</a></li>
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
        <p>
        La modification d'un dossier est possible si et seulement si vous êtes proprietaire du dossier. Les dossiers dont vous êtes le propriétaire se trouve dans l'espace "Suivi Dossiers"
        .</p> 
        <p>Pour modifier un dossier cliquez sur l'élément du menu "Suivi Dossiers" :<br/>
            Vous pouvez dans cette page filtrer les dossier a afficher. Pour cela remplissez les quelques champs afin d'optimiser le temps de recherche du dossier désiré</p>
        <p>Lorsque le dossier désiré est affiché cliquez sur la ligne, vous êtes redirigé vers la page créer dossier ou toute les info sont remplient.</p>
        <p>Dans cet espace on trouve deux fonctionnement :<br>
        Le premier, les champs d'information client, fournisseur, theme, sous theme, problématique, l'espace cloture et l'espace proprietaire.<br>
        Cela signifie que lorsque l'une ou plusieurs de ces informations sont modifiées il faudra cliquer sur le bouton "Modifier dossier" afin que les données modifier soit enregistrées.<br>
        <br>
        Le deuxieme, les espace gestion fichiers, gestion sites et gestion des événements quant à eux ne necessite pas de cliquer sur le bouton "Modifier le dossier" en effet ces informations sont enregistrer lorsque l'on revient sur la page créer dossier.</p>
        <img src="">Image remplissage info client</img>
        
    </div>
   
    <div id="doc_transferer_client" class="contenu_doc">
        <p>
        La modification d'un dossier créé par un autre utilisateur n'est pas possible. Pour pouvoir le modifier il faut que le 
        proprietaire du dossier indique que le dossier appartient maintenant à un autre utilisateur.</p> 
        <p>Pour cela le proprietaire du dossier doit aller sur la page d'edition du dossier puis choisir l'utilisateur qu'il veut nommer 
            proprietaire.</p>        
        <img src="">Image remplissage info client</img>
        <p>Cliquer ensuite sur le bouton "Modifier dossier" pour enregistrer les modification apporté au dossier.</p>
        
    </div>
     <?php
            if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
            ?>
            <div id="doc_supprimer_client" class="contenu_doc">CONTENU SUPPRIMER UN CLIENT</div>
     <?php } ?>
     
     <!--DOC GERER FIHCIERS-->
    <div id="doc_stocker_fichier" class="contenu_doc">
        <p>L'application offre la possibilité de joindre des fichier (word, pdf, ...) au dossier.</p>
        <p>Pour cela rendez-vous sur le dossier ou vous voulez ajouter un fichier. Ensuite dans l'espace 
            "Gestion fichiers" cliquer sur le bouton "Ajouter fichier...", vous êtes redirigé vers une page 
            ou l'on vous demande de choisir un fichier. Cliquez sur le bouton "Choisir un fichier" puis 
            selectionner le fichier à ajouter se trouvant sur votre ordinateur.<br>
        Cliquez ensuite sur le bouton "Valider", vous êtes redirigé vers le dossier précédemment afficher où le fichier ajouté précédemment est affiché à présent.</p>
    </div>
    <div id="doc_supprimer_fichier" class="contenu_doc">
        <p>Vous pouvez supprimer les fichiers qui ont été joints par erreur.</p>
        <p>Pour cela rendez-vous sur le dossier ou un fichier à été ajouté. Ensuite dans l'espace 
            "Gestion fichiers" cliquer sur l'icone "sens-interdit" permettant de supprimer le fichier, 
            une fenêtre s'ouvre vous demandant de valider la suppression cliquer sur oui. La fenêtre disparait et le fichier est bien supprimé</p>
            
    </div>
    <div id="doc_telecharger_fichier" class="contenu_doc">
        <p>Vous pouvez télécharger les fichiers ajoutés au dossier.</p>
        <p>Pour cela rendez-vous sur le dossier ou un fichier à été ajouté. Ensuite dans l'espace 
            "Gestion fichiers" cliquer sur le nom du fichier afin de télécharger le fichier voulu</p>
            
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
        <p>Une pop-up s'affichera pour vous demander si vous confirmez cette création de dossier.</p>
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
    <div id="doc_rechercher_dossier" class="contenu_doc">CONTENU PAGE RECHERCHER DOSSIER</div>
    <div id="doc_exporter_dossier" class="contenu_doc">CONTENU PAGE EXPORTER DOSSIER</div>
    
    <!--DOC RAPPORT ANNUEL-->
    <div id="doc_afficher_rapport" class="contenu_doc">CONTENU PAGE AFFICHER RAPPORT</div>
    <div id="doc_exporter_rapport" class="contenu_doc">CONTENU PAGE EXPORTER RAPPORT</div>
    
    
    
</div>