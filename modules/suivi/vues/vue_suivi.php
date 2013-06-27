<div id="recherche">
    <div id="champs_recherche" class="recherche">
        <h3>Recherche des dossiers</h3>
        <form method="GET" action="accueil.php?module=suivi&action=suivi_dossier">
            <div id="col1" class="col">
                <input type="hidden" name="module" value="suivi"/>
                <input type="hidden" name="action" value="suivi_dossier"/>
                <label for="choix_numero_dossier" class="lab_txt" >N&deg; du dossier : </label>
                <input type="text" name="choix_numero_dossier" id="choix_numero_dossier" value="<?php echo $_GET['choix_numero_dossier']; ?>" list="numero_dossier" placeholder="ex : 20130001" class="inputfield"/>
                <datalist id="numero_dossier">
                    <?php
                    foreach ($datalist_dossier_ref as &$dossier_ref) {
                        ?>
                        <option value="<?php echo $dossier_ref; ?>"/>
                        <?php
                    }
                    ?>
                </datalist>

                <label for="choix_nom" class="lab_txt">Nom : </label>
                <input type="text" name="choix_nom" id="choix_nom" list="nom" placeholder="Nom du client" class="inputfield" 
                    value="<?php echo $_GET['choix_nom']; ?>"/>
                <datalist id="nom">
                    <?php
                    asort($datalist_nom);
                    foreach ($datalist_nom as $nom) {
                        ?>
                        <option value="<?php echo $nom; ?>"/>
                        <?php
                    } //boucle permettant d'afficher toute les noms des clients
                    ?>
                </datalist>

                <label for="choix_prenom" class="lab_txt">Pr&eacute;nom : </label>
                <input type="text" name="choix_prenom" id="choix_prenom" list="prenom" value="<?php echo $_GET['choix_prenom']; ?>" placeholder="Pr&eacute;nom du client" class="inputfield"/>
                <datalist id="prenom">
                    <?php
                    asort($datalist_prenom);
                    foreach ($datalist_prenom as $prenom) {
                        ?>
                        <option value="<?php echo $prenom; ?>"/>
                        <?php
                    } //boucle permettant d'afficher toute les noms des clients
                    ?>
                </datalist>
            </div>

            <div id="col2" class="col">
                <label for="telephone" class="lab_txt" >T&eacute;l&eacute;phone : </label>
                <input type="text" name="choix_telephone" list="tel" id="telephone"  value="<?php echo $_GET['choix_telephone']; ?>" placeholder="T&eacute;l&eacute;phone" maxlength="10" class="inputfield"/>
                <datalist id="tel">
                    <?php
                    asort($datalist_tel);
                    foreach ($datalist_tel as $tel) {
                        ?>
                        <option value="<?php echo $tel; ?>"/>
                        <?php
                    } //boucle permettant d'afficher toute les noms des clients
                    ?>
                </datalist>
                <label for="choix_mail" class="lab_txt">Adresse mail : </label>
                <input type="text" name="choix_mail" list="mail" id="choix_mail" value="<?php echo $_GET['choix_mail']; ?>" placeholder="e-Mail du client" class="inputfield"/>
                <datalist id="mail">
                    <?php
                    asort($datalist_mail);
                    foreach ($datalist_mail as $mail) {
                        ?>
                        <option value="<?php echo $mail; ?>"/>
                        <?php
                    } //boucle permettant d'afficher toute les mail des clients
                    ?>
                </datalist>

            </div>

            <div id="col3" class="col" >
                <label for="theme" class="lab_txt">Th&egrave;me : </label>
                <select class="inputfield_liste" id="choix_theme" name="choix_theme" title="Choisir un th&egrave;me">
                    <option value="<?php echo $_GET['choix_theme']; ?>"><?php echo $_GET['choix_theme'];   ?></option> 
                    <?php
                    asort($tab_theme);
                    foreach ($tab_theme as $key => $value) {
                        echo '<option value="' . $tab_theme[$key]->nom . '" >' . $tab_theme[$key]->nom . '</option>';
                    }
                    ?>
                </select>
                <label for="choix_fournisseur" class="lab_txt">Fournisseur : </label>
                <input type="text" name="choix_fournisseur" list="fournisseur"  value="<?php echo $_GET['choix_fournisseur']; ?>" placeholder="Nom ou Raison sociale" id="choix_fournisseur" class="inputfield"/>
                <datalist id="fournisseur">
                    <?php
                    asort($datalist_fournisseur);
                    foreach ($datalist_fournisseur as &$fournisseur) {
                        echo '<option value="'.$fournisseur.'" />';

                     }
                    ?>
                </datalist>
            </div>

            <div id="col4" class="col">
                <label for="date_debut" class="lab_txt" >De : </label>
                <input type="text" name="choix_date_debut" class="datepicker inputfield" value="<?php echo $_GET['choix_date_debut']; ?>" placeholder="Selectionner date" id="date-debut"/></input>

                <label for="date_fin"class="lab_txt" >&Agrave; : </label>
                <input type="text" name="choix_date_fin" class="datepicker inputfield" value="<?php echo $_GET['choix_date_fin'] ?>" placeholder="Selectionner date" id="date_fin"/></input>


                <input type="submit" id="btn_rechercher"  value="Appliquer filtres"/>
            </div>
        </form>
    </div>
    <div id="tab_recherche">
        <table class="scroll_tab">
            <thead >

                <tr class="head_tab" >
                    <th  align="center" >N&deg; dossier</th>
                    <th  align="left" 	>Nom</th>
                    <th  align="left" 	>Pr&eacute;nom</th>
                    <th  align="center" >T&eacute;l&eacute;phone</th>
                    <th  align="left" 	>e-Mail</th>
                    <th  align="left" >Th&egrave;me</th>
                    <th  align="left"  >Fournisseur</th>
                    <th  align="left"  >Utilisateur</th>
                    <th  align="center"  >Date de cr&eacute;ation</th>
                    <th align="center"></th>

                </tr>

            </thead>
            <tbody>

                <?php
                foreach ($lignes_tableau as $ligne) {
                    ?>
                
                    <tr class="
                    <?php
                    if ($ligne['cloture'] == 1) {
                        echo "ferme";
                    } else {
                        echo "ouvert";
                    }
                    ?>">
                        <td  class="cell_result cell_center" ><?php echo $ligne['n_dossier']; ?></td>
                        <td  class="cell_result" ><?php echo $ligne['nom']; ?></td>
                        <td  class="cell_result" ><?php echo $ligne['prenom']; ?></td>
                        <td  class="cell_result" align="center"><?php echo $ligne['telephone']; ?></td>
                        <td  class="cell_result" ><?php echo $ligne['mail']; ?></td>
                        <td  class="cell_result" ><?php echo $ligne['theme']; ?></td>
                        <td  class="cell_result" ><?php echo $ligne['fournisseur']; ?></td>
                        <td  class="cell_result" ><?php echo $ligne['user']; ?></td>
                        <td  class="cell_result" align="center"><?php echo $ligne['date']; ?></td>
                        <td align="center"><a href="accueil.php?module=dossier&amp;action=creer_dossier&id=<?php echo $ligne['n_dossier']; ?>" class="lien_dossier"></a></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
