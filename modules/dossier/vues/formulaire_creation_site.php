
<div id="ajouter_site">
    <h3> Ajouter site web au dossier <?php echo $_SESSION['dossier_ref']; ?></h3>

        <form id="form_creer_dossier" action="accueil.php?module=dossier&action=creer_dossier&ajout=site&id=<?php echo $_SESSION['dossier_ref']; ?>&info=remplir"  method="post" enctype="multipart/form-data">
            <fieldset class="ogconso">
                <label for="name" class="lab_txt">Nom du site : </label>
                <input type="text" class="inputfield" name="name" id="name" required title="Celui qui apparaitra dans le tableau" />
                <label for="url" class="lab_txt">URL du site : </label>
                <input type="url" class="inputfield" name="url" id="url" title="http://www.exemple.com" required />
               
                <div id="bouton_form_ajouter">
                    <input type="button" value="Retour" onclick="location.href='/accueil.php?module=dossier&action=creer_dossier&id='+<?php echo $_SESSION['dossier_ref']; ?>+'&from=event'"/>
                    <button type="submit">Valider</button>
                </div>
                
            </fieldset>
        </form>
</div>