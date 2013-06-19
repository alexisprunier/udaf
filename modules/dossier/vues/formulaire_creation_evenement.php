<div id="ajouter_evenement">
    <h3> Ajouter événement au dossier <?php echo $_SESSION['dossier_ref']; ?></h3>
    <form id="form_creer_dossier" action="accueil.php?module=dossier&action=creer_dossier&ajout=evenement&id=<?php echo $_SESSION['dossier_ref']; ?>&info=remplir" method="post" enctype="multipart/form-data">
        <fieldset class="ogconso">
            <label for="date"class="lab_txt" >Date du rendez-vous <span class="require">*</span> :</label> 
            <input type="text" name="date" class="datepicker inputfield" placeholder="Selectionner date" required id="date"/></input>

            <label for="mode" class="lab_txt">Mode de contact <span class="require">*</span> :</label>   
            
            <select id="mode" name="mode" class="inputfield" required title="Mode de contact">
                <option value="e-Mail">e-Mail</option>
                <option value="Rendez-vous">Rendez-vous</option>
                <option value="Téléphone">Téléphone</option>
            </select>
            <label for="liste_utilisateur" class="lab_txt">Utilisateur concerné(e) <span class="require">*</span> :</label> 
            
            <select id="liste_utilisateur" name="liste_utilisateur" class="inputfield" required>
                <option value=""></option> 
                <?php
                foreach ($tab_utilisateur as $key => $value) {
                    echo '<option value="' . $tab_utilisateur[$key]->user_id . '" >' . $tab_utilisateur[$key]->nom . ' ' . $tab_utilisateur[$key]->prenom . '</option>';
                }
                ?>
            </select>
            
            <label for="commentaire_event" class="lab_txt">Commentaire :</label>   
            <textarea id="commentaire_event" name="commentaire_event" title="Commentaire sur l'évènement"></textarea>
            <div id="bouton_ajouter_evenenement">
            <input type="button" value="Retour" onclick="location.href='/accueil.php?module=dossier&action=creer_dossier&id='+<?php echo $_SESSION['dossier_ref']; ?>+'&from=event'"/>
            <button type="submit">Valider</button>
            </div>
            
        </fieldset>
    </form>
</div>
