
<div id="accueil">
    <div id="gauche_accueil">		
        <fieldset class="ogconso">
            <legend>Information</legend>
            <p>Vous trouverez ici les information relative &agrave; l'UDAF ...</p>
        </fieldset>
    </div>

    <div id="droite_accueil">
        <fieldset class="ogconso">
            <legend>Vos alertes</legend>
            <div id="alertes_user" class="alertes">
                <table class="tab_alertes">
                    <tbody>
                        <?php foreach ($lignes_tableau as &$ligne) {
                            if ($ligne['id_utilisateur'] === $_SESSION['id']){
                            ?>
                            <tr>
                                <td><img src="/images/icon/gray_18/clock.png"/></td>
                                <td><?php echo $ligne['date_evenement']; ?></td>
                                <td><?php echo $ligne['mode_contact']; ?></td>
                                <td><?php echo $ligne['personne_nom']; ?></td>
                                <td><?php echo $ligne['personne_prenom']; ?></td>
                                <td width="19%"></td>
                            </tr>
                        <?php }} ?>
                    </tbody>
                </table>
            </div>
        </fieldset>

        <?php
        if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
            ?>
            <fieldset class="ogconso" id="all_alertes">
                <legend>Toutes les alertes</legend>
                <div id="alertes_admin" class="alertes">
                    <table class="tab_alertes">
                        <tbody>

                            <?php foreach ($lignes_tableau as &$ligne) {
                                ?>
                                    <tr>
                                        <td><img src="/images/icon/gray_18/clock.png"/></td>
                                        <td><?php echo $ligne['date_evenement']; ?></td>
                                        <td><?php echo $ligne['mode_contact']; ?></td>
                                        <td><?php echo $ligne['personne_nom']; ?></td>
                                        <td><?php echo $ligne['personne_prenom']; ?></td>
                                        <td><?php echo $ligne['utilisateur']; ?></td>
                                    </tr>
                            <?php } ?>                          

                        </tbody>
                    </table>
                </div>
            </fieldset>
        <?php } ?>
    </div>
</div>	
