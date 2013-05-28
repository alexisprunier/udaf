<script text="text/javascript">
    $(document).ready( function () {
        $( ".dialog_admin" ).dialog({
            modal: true,
            buttons: {
              Ok: function() {
                $( this ).dialog( "close" );
              }
            }
        });
        var theHREF;
        $( "#dialog-confirm-admin" ).dialog({

            resizable: false,
            height:200,
            width:500,
            autoOpen: false,
            modal: true,
            buttons: {
                "Oui": function() {
                    $( this ).dialog( "close" );
                    window.location.href = theHREF;
                },
                "Annuler": function() {
                    $( this ).dialog( "close" );
                }
            }
        }); 
        $("a.supprimer_ligne").click(function(e) {
            e.preventDefault();
            theHREF = $(this).attr("href");            
            $("#dialog-confirm-admin").dialog("open");
        });
        
    });
</script>
<?php
/**
 * @file      vue_formulaire_admin.php
 * @author    Anthony HIVERT / Jocelyn SIMON
 * @version   1.0
 * @date      3 mars 2013
 * @brief     Definit l'IHM de la gestion admin.
 */

if (isset($_GET['erreur']) && $_GET['erreur'] == 'differentmdp') {
    ?>	
   <div class="dialog_admin" title="Attention!">
        <p>
          Les champs 'Mot de passe' et 'Confirmer le mot de passe' sont différents !
        </p>
    </div> 
   <?php
}
if (isset($_GET['ajout_utilisateur']) && $_GET['ajout_utilisateur'] == 'ok') {
    ?>	
    <div class="dialog_admin" title="Utilisateur créé">
        <p>
          Utilisateur créé avec succès !
        </p>
    </div>
    <?php
}
if (isset($_GET['sup_utilisateur']) && $_GET['sup_utilisateur'] == 'ok') {
    ?>	
    <div class="dialog_admin" title="Utilisateur supprimé">
        <p>
          Utilisateur supprimé avec succès !
        </p>
    </div>	
    <?php
}
if (isset($_GET['upd_user']) && $_GET['upd_user'] == 'ok') {
    ?>	
    <div class="dialog_admin" title="Utilisateur modifié">
        <p>
          Utilisateur modifié avec succès !
        </p>
    </div>
    <?php
}
if (isset($_GET['sup_personne']) && $_GET['sup_personne'] == 'ok') {
    ?>	
    <div class="dialog_admin" title="Client supprimé">
        <p>
          Client supprimé avec succès !
        </p>
    </div>
    <?php
}
if (isset($_GET['sup_dossier']) && $_GET['sup_dossier'] == 'ok') {
    ?>	
   <div class="dialog_admin" title="Dossier supprimé">
        <p>
          Dossier supprimé avec succès !
        </p>
    </div>
  
    <?php
}
if (isset($_GET['sup_fournisseur']) && $_GET['sup_fournisseur'] == 'ok') {
    ?>	
    <div class="dialog_admin" title="Fournisseur supprimé">
        <p>
          Fournisseur supprimé avec succès !
        </p>
    </div>
    <?php
}
?>

<div id="administration">
    <div id="dialog-confirm-admin"  title="Attention!">
    <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span>Vous allez supprimer une ligne. Etes vous sûr?</p>
</div>
    <div id="gestion_gauche">
        <fieldset class="ogconso">
            <h3>Gestion utilisateurs</h3>
            <div id="tab_users">
                <table class="scroll_tab"  id="tableau_users">
                    <thead>
                        <tr class="head_tab">
                            <th align="left" >Nom</th>
                            <th align="left">Pr&eacute;nom</th>
                            <th>Admin</th>
                            <th>Editer</th>
                            <th>Supprimer</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <?php
                            $i = 0;
                            foreach (array_reverse($liste_utilisateur, true) as $key => $value) {

                                if (($i % 2) == 0)
                                    echo "<tr class=\"even\">";
                                else
                                    echo "<tr class=\"odd\">";
                                $i += 1;

                                $user_ident = $liste_utilisateur[$key]->user_id;
                                ?>
                            <td><?php echo $liste_utilisateur[$key]->nom; ?></td>
                                <td><?php echo $liste_utilisateur[$key]->prenom; ?></td>
                                <td align="center"><?php
                            if ($liste_utilisateur[$key]->administrateur == 0)
                                echo 'non';
                            else
                                echo 'oui';
                                ?></td>
                                <td align="center"><a href="accueil.php?module=administration&amp;action=visualiser_utilisateur&id=<?php echo $user_ident; ?>" ><img src="images/icon/icon_edit.png"/></a></td>
                                <td align="center"><a class="supprimer_ligne" href="accueil.php?module=administration&amp;action=gestion_administration&amp;act=supp_user&id=<?php echo $user_ident; ?>"><img src="images/icon/icon_delete.png"/></a></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>                           
                </table>
            </div>

            <div id="modifier_utilisateur">
                <h3>Ajouter utilisateur</h3>

                <form id="form_creer_utililisateur" action="accueil.php?module=administration&amp;action=gestion_administration&amp;act=ajout_user" method="post" enctype="multipart/form-data">	  
                    <div class="form_user">
                        <label for="id" class="lab_txt" >Identifiant :</label>   
                        <input type="text" class="inputfield" id="id" name="id" required="required" maxlength="45" title="Saisir l'identifiant pour l'utilisateur"/>
                        <label for="nom" class="lab_txt">Nom :</label>   
                        <input type="text" class="inputfield" id="nom" name="nom" required="required" maxlength="45" title="Saisir le nom de l'utilisateur"/>
                        <label for="prenom" class="lab_txt">Pr&eacute;nom :</label>   
                        <input type="text" class="inputfield" id="prenom" name="prenom" required="required" maxlength="45" title="Saisir le pr&eacute;nom de l'utilisateur"/>
                        <label for="pass" class="lab_txt">Mot de passe :</label>   
                        <input type="password" class="inputfield" id="pass" name="pass" required="required" maxlength="45" title="Saisir un mot de passe pour l'utilisateur"/>
                        <label for="repass" class="lab_txt">Confirmer le mot de passe :</label>   
                        <input type="password" class="inputfield" id="repass" name="repass" required="required" maxlength="45" title="Saisir a nouveau le mot de passe"/>
                        <label for="administrator" class="lab_txt">Administrateur :</label>   
                        <input type="checkbox" class="inputfield" id="administrator" name="administrator"/>
                    </div>
                    <div class="btn_form_user">
                        <button id="valider_user" onClick="ajouter_user" type="submit">Ajouter l'utilisateur</button>
                    </div>
                </form>
            </div>
        </fieldset>
    </div>

    <div id="gestion_droite">	
        <fieldset class="ogconso" id="gestion_dossier">
            <!--Div gestion des clients (personnes)-->
            <div id="gestion_clients">
                <h3>Gestion des clients</h3>
                <div id="tab_clients">
                    <table class="scroll_tab"  id="head_clients">
                        <thead>
                            <tr class="head_tab">
                                <th align="left">Sexe</th>
                                <th align="left">Nom</th>
                                <th align="left">Pr&eacute;nom</th>
                                <th align="left">E-Mail</th>
                                <th >Supprimer</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <?php
                                $i = 0;
                                foreach (array_reverse($liste_personne, true) as $key => $value) {

                                    if (($i % 2) == 0)
                                        echo "<tr class=\"even\">";
                                    else
                                        echo "<tr class=\"odd\">";
                                    $i += 1;
                                    $id_personne = $liste_personne[$key]->personne_id;
                                    ?>
                                    <td><?php if ($liste_personne[$key]->sexe == 1) echo "Mr"; else echo "Mme" ?></td>
                                    <td><?php echo $liste_personne[$key]->nom; ?></td>
                                    <td><?php echo $liste_personne[$key]->prenom; ?></td>
                                    <td><?php echo $liste_personne[$key]->mail; ?></td>

                                    <td align="center"><a class="supprimer_ligne" href="accueil.php?module=administration&amp;action=gestion_administration&amp;act=supp_perso&id=<?php echo $id_personne; ?>"><img src="images/icon/icon_delete.png"/></a></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Div contenant la tableau des differents dossier, range dans l'ordre anti-date-->
            <div id="gestion_dossier">
                <h3>Gestion des dossiers</h3>
                <div id="tab_dossier" >
                    <table class="scroll_tab"  id="head_dossiers">
                        <thead>
                            <tr class="head_tab">
                                <th align="center">Date de cr&eacute;ation</th>
                                <th align="center">Num&eacute;ro de dossier</th>
                                <th align="left">Nom client</th>
                                <th >Supprimer</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <?php
                                $i = 0;
                                
                                foreach (array_reverse($lignes_tableau, true) as &$ligne) {

                                    if (($i % 2) == 0)
                                        echo "<tr class=\"even\">";
                                    else
                                        echo "<tr class=\"odd\">";
                                    $i += 1;
                                    
                                    ?>
                                    <td align ="center"><?php echo $ligne['date_creation']; ?></td>
                                    <td align="center"><?php echo $ligne['dossier_ref']; ?></td>
                                    <td><?php echo $ligne['personne_nom'] . " " . $ligne['personne_prenom']; ?></td>

                                    <td align="center"><a class="supprimer_ligne" href="accueil.php?module=administration&amp;action=gestion_administration&amp;act=supp_dossier&id=<?php echo $id_dossier; ?>"><img src="images/icon/icon_delete.png"/></a></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>


            <!-- Div contenant le tableau des differents fournisseur, range dans l'ordre anti-date (de cr�ation)-->
            <div id="gestion_fournisseur">
                <h3>Gestion des fournisseurs</h3>
                <div id="tab_fournisseur" class="tableNameinTab">
                    <table class="scroll_tab"  id="head_fournisseurs">
                        <thead>
                            <tr class="head_tab">
                                <th align="center">Date de cr&eacute;ation</th>
                                <th align="left">Nom (Raison sociale)</th>
                                <th >Supprimer</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <?php
                                $i = 0;
                                foreach (array_reverse($liste_fournisseur, true) as $key => $value) {

                                    if (($i % 2) == 0)
                                        echo "<tr class=\"even\">";
                                    else
                                        echo "<tr class=\"odd\">";
                                    $i += 1;
                                    $id_fournisseur = $liste_fournisseur[$key]->fournisseur_id;
                                    ?>
                                    <td align="center"><?php echo $liste_fournisseur[$key]->date_creation_f; ?></td>
                                    <td><?php
                                if ($liste_fournisseur[$key]->nom == null)
                                    echo $liste_fournisseur[$key]->raison_sociale;
                                else
                                    echo $liste_fournisseur[$key]->nom . " " . $liste_fournisseur[$key]->prenom;
                                    ?></td>
                                    <td align="center"><a class="supprimer_ligne" href="accueil.php?module=administration&amp;action=gestion_administration&amp;act=supp_fournisseur&id=<?php echo $id_fournisseur; ?>"><img src="images/icon/icon_delete.png"/></a></td>
                                </tr>
                            <?php } ?>
                                
                        </tbody>	
                    </table>
                </div>
            </div>
        </fieldset>
    </div>
</div>