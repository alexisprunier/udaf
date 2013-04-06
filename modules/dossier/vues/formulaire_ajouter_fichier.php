

<div id="ajouter_fichier">
  <h3> Ajouter fichier au dossier</h3>
  <form action="accueil.php?module=dossier&action=creer_dossier&ajout=fichiers" onsubmit="return verifier_form_fichier(this)" method="post" enctype="multipart/form-data">
    <fieldset class="ogconso">
        <input id="fichier" name="fichier" type="file" required onchange="verifier_fichier(this)"/><br />
        <button>Envoyer</button>
    </fieldset>
  </form>
</div>




