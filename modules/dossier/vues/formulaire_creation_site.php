
<div id="ajouter_site">
    <h3> Ajouter site web au dossier</h3>

        <form id="form_creer_dossier" action="accueil.php?module=dossier&action=creer_dossier&ajout=site" method="post" enctype="multipart/form-data">
            <fieldset class="ogconso">
                <label for="name" class="lab_txt">Nom du site : </label>
                <input type="text" class="inputfield" name="name" id="name" required title="Celui qui apparaitra dans le tableau" />
                <label for="url" class="lab_txt">URL du site : </label>
                <input type="url" class="inputfield" name="url" id="url" title="http://www.exemple.com" required />
                <input type="button" value="Retour" onclick="history.go(-1)"/>
                <button>Valider</button>
                
            </fieldset>
        </form>
</div>