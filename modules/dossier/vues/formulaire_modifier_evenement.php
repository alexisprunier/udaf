<div id="ajouter_evenement">
    <h3> Modifier l'événement du dossier <?php echo $_SESSION['dossier_ref']; ?></h3>
    <form id="form_creer_dossier" action="accueil.php?module=dossier&action=creer_dossier&modifier=evenement&id=<?php echo $_SESSION['dossier_ref']; ?>&event=<?php echo $_GET['id']; ?>&info=remplir" method="post" enctype="multipart/form-data">
        <fieldset class="ogconso">
            <label for="date"class="lab_txt" >Date du rendez-vous <span class="require">*</span> :</label> 
            <input readonly type="text" name="date"  value="<?php echo $event['date_event'];?>" required id="date" style="text-align: center;"/></input>

            <label for="mode" class="lab_txt">Mode de contact <span class="require">*</span> :</label>   
            
            <select id="mode" name="mode" class="inputfield" required title="Mode de contact" >
                <option value="<?php echo $event['mode_contact'];?>"><?php echo $event['mode_contact'];?></option>
                              
            </select>
            <label for="liste_utilisateur" class="lab_txt">Utilisateur concerné(e) <span class="require">*</span> :</label> 
            
            <select id="liste_utilisateur" name="liste_utilisateur" class="inputfield" required>
                <option value="<?php echo $event['user_id'];?>"><?php echo $user['nom'] .  ' ' . $user["prenom"];?> </option> 
                <?php
                foreach ($tab_utilisateur as $key => $value) {
                    if($tab_utilisateur[$key]->user_id != $event['user_id'])
                    echo '<option value="' . $tab_utilisateur[$key]->user_id . '" >' . $tab_utilisateur[$key]->nom . ' ' . $tab_utilisateur[$key]->prenom . '</option>';
                }
                ?>
            </select>
            
            <label for="commentaire_event" class="lab_txt">Commentaire :</label>   
            <textarea id="commentaire_event" name="commentaire_event" title="Commentaire sur l'évènement"><?php echo stripslashes($event['comm_event']);?></textarea>
            <div id="bouton_form_ajouter">
                <input type="button" value="Retour" onclick="location.href='/accueil.php?module=dossier&action=creer_dossier&id='+<?php echo $_SESSION['dossier_ref']; ?>+'&from=event'"/>
                <button type="submit">Valider</button>
            </div>
            
        </fieldset>
    </form>
</div>
