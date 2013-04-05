<?php
/**
 * @file      vue_voir_utilisateur.php
 * @author    
 * @version   1.0
 * @date      11 mars 2013
 * @brief     Definit l'IHM de la page de la vue d'un utilisateur.
 */
?>
<div id="modifier_utilisateur">
    <fieldset class="ogconso">
        <div id="modifier_utilisateur">
            <h3>Fiche de <span style="text-decoration: underline;"><?php echo $id_select_utilisateur['ident']; ?></span></h3>
            <div id="form_modifier_utilisateur">
                <form id="form_creer_utililisateur" action="accueil.php?module=administration&amp;action=visualiser_utilisateur&amp;act=modif_user&amp;id=<?php echo $_GET['id']; ?>" method="post" enctype="multipart/form-data">	  
                    <label for="user_ident" class="lab_txt" >Identifiant :</label>   
                    <input type="text" class="inputfield" id="user_ident" name="user_ident" value="<?php echo $id_select_utilisateur['ident']; ?>" required="required" maxlength="45" title="Saisir l'identifiant pour l'utilisateur"/>

                    <label for="user_nom" class="lab_txt">Nom :</label>   
                    <input type="text" class="inputfield" id="user_nom" name="user_nom" value="<?php echo $id_select_utilisateur['nom']; ?>" required="required" maxlength="45" title="Saisir le nom de l'utilisateur"/>

                    <label for="user_prenom" class="lab_txt">Pr&eacute;nom :</label>   
                    <input type="text" class="inputfield" id="user_prenom" name="user_prenom" value="<?php echo $id_select_utilisateur['prenom']; ?>" required="required" maxlength="45" title="Saisir le pr&eacute;nom de l'utilisateur"/>

                    <label for="user_pass" class="lab_txt">Mot de passe :</label>   
                    <input type="password" class="inputfield" id="user_pass" name="user_pass" required="required" maxlength="65" title="Saisir un mot de passe pour l'utilisateur"/>

                    <label for="user_repass" class="lab_txt">Confirmer le mot de passe :</label>   
                    <input type="password" class="inputfield" id="user_repass" name="user_repass" required="required" maxlength="65" title="Saisir a nouveau le mot de passe"/>

                    <label for="administrator" class="lab_txt">Administrateur :</label>   
                    <input type="checkbox" class="inputfield" id="user_admin" name="user_admin" <?php if ($id_select_utilisateur['administrateur'] == 1) echo 'checked="checked"'; ?>/>
            </div>
            <div id="btn_modifier_user">
                <a class="btn_annuler" href="accueil.php?module=administration&amp;action=gestion_administration">Retour</a>
                <button id="modifier_user" onClick="modifier_user" type="submit">Modifier l'utilisateur</button>

            </div>
            </form>

        </div>
    </fieldset>	
</div>