
<script type="text/javascript">

</script>

<div id="ajouter_fichier">
  <h3> Ajouter fichier au dossier <?php echo $_SESSION['dossier_ref']; ?></h3>
  <form name = "form_fichier" action="accueil.php?module=dossier&action=creer_dossier&ajout=fichiers&id=<?php echo $_SESSION['dossier_ref']; ?>" onsubmit="return valider_nom(this)" method="post" enctype="multipart/form-data">
    <fieldset class="ogconso">
        <input type="hidden" name="MAX_FILE_SIZE" value="5000000"> <!-- 5Mo-->
        <input id="fichier" name="fichier" type="file" required onchange="verifier_fichier(this)"/><br />
        
        <button>Envoyer</button>
    </fieldset>
  </form>
</div>





